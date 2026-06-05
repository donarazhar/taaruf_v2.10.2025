<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MurobiController extends Controller
{
    /**
     * Halaman Taaruf Murobi - Menampilkan semua profil dipisah Pria & Wanita
     */
    public function taaruf(Request $request)
    {
        $email = Auth::guard('user')->user()->email;
        $datauser = DB::table('users')->where('email', $email)->first();

        // Query Pria
        $queryPria = DB::table('karyawan')
            ->where('jenkel', 'pria')
            ->where('status', '1');

        // Query Wanita
        $queryWanita = DB::table('karyawan')
            ->where('jenkel', 'wanita')
            ->where('status', '1');

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $queryPria->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
            $queryWanita->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        // Filter gender tab
        $activeTab = $request->get('tab', 'pria');

        $pria = $queryPria->paginate(10, ['*'], 'pria_page')->appends($request->all());
        $wanita = $queryWanita->paginate(10, ['*'], 'wanita_page')->appends($request->all());

        // Count totals
        $totalPria = DB::table('karyawan')->where('jenkel', 'pria')->where('status', '1')->count();
        $totalWanita = DB::table('karyawan')->where('jenkel', 'wanita')->where('status', '1')->count();

        // Get all emails in progress or progress_shadow
        $progressAuth = DB::table('progress')->pluck('email_auth')->toArray();
        $progressProfile = DB::table('progress')->pluck('email_profile')->toArray();
        $shadowAuth = DB::table('progress_shadow')->pluck('email_auth')->toArray();
        $shadowProfile = DB::table('progress_shadow')->pluck('email_profile')->toArray();

        $inProgressEmails = array_unique(array_merge($progressAuth, $progressProfile, $shadowAuth, $shadowProfile));

        return view('dashboardadmin.murobi.taaruf', compact(
            'datauser',
            'pria',
            'wanita',
            'totalPria',
            'totalWanita',
            'activeTab',
            'inProgressEmails'
        ));
    }

    /**
     * Lihat Profile Detail - Untuk Murobi melihat biodata lengkap
     */
    public function lihatprofile($email)
    {
        $adminEmail = Auth::guard('user')->user()->email;
        $datauser = DB::table('users')->where('email', $adminEmail)->first();

        $karyawan = DB::table('karyawan')
            ->select('karyawan.*', 'biodata.*', 'kriteriapasangan.*')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->where('karyawan.email', '=', $email)
            ->first();

        if (!$karyawan) {
            return redirect()->route('murobi.taaruf')->with('error', 'Data karyawan tidak ditemukan.');
        }

        $emailprofile = $email;

        return view('dashboardadmin.murobi.lihatprofile', compact('datauser', 'karyawan', 'emailprofile'));
    }

    /**
     * Halaman Progress Murobi - Form untuk memasangkan Pria & Wanita
     */
    public function progress()
    {
        $email = Auth::guard('user')->user()->email;
        $datauser = DB::table('users')->where('email', $email)->first();

        // Get all emails in progress or progress_shadow
        $progressAuth = DB::table('progress')->pluck('email_auth')->toArray();
        $progressProfile = DB::table('progress')->pluck('email_profile')->toArray();
        $shadowAuth = DB::table('progress_shadow')->pluck('email_auth')->toArray();
        $shadowProfile = DB::table('progress_shadow')->pluck('email_profile')->toArray();

        $inProgressEmails = array_unique(array_merge($progressAuth, $progressProfile, $shadowAuth, $shadowProfile));

        // Ambil semua Pria terverifikasi
        $listPria = DB::table('karyawan')
            ->where('jenkel', 'pria')
            ->where('status', '1')
            ->orderBy('nama', 'asc')
            ->get();

        // Ambil semua Wanita terverifikasi
        $listWanita = DB::table('karyawan')
            ->where('jenkel', 'wanita')
            ->where('status', '1')
            ->orderBy('nama', 'asc')
            ->get();

        // Ambil daftar pasangan yang sudah dipasangkan
        $existingPairs = DB::table('progress')
            ->leftJoin('karyawan as pria', 'progress.email_auth', '=', 'pria.email')
            ->leftJoin('karyawan as wanita', 'progress.email_profile', '=', 'wanita.email')
            ->select(
                'progress.id',
                'progress.progress_tgl',
                'progress.status',
                'pria.nama as nama_pria',
                'pria.foto as foto_pria',
                'pria.nip as nip_pria',
                'wanita.nama as nama_wanita',
                'wanita.foto as foto_wanita',
                'wanita.nip as nip_wanita'
            )
            ->orderBy('progress.progress_tgl', 'desc')
            ->get();

        return view('dashboardadmin.murobi.progress', compact(
            'datauser',
            'listPria',
            'listWanita',
            'existingPairs',
            'inProgressEmails'
        ));
    }

    /**
     * Store Progress - Memasangkan Pria dengan Wanita
     */
    public function storeProgress(Request $request)
    {
        $request->validate([
            'email_pria' => 'required|email|exists:karyawan,email',
            'email_wanita' => 'required|email|exists:karyawan,email',
        ], [
            'email_pria.required' => 'Silakan pilih karyawan pria.',
            'email_pria.exists' => 'Data karyawan pria tidak ditemukan.',
            'email_wanita.required' => 'Silakan pilih karyawan wanita.',
            'email_wanita.exists' => 'Data karyawan wanita tidak ditemukan.',
        ]);

        $emailPria = $request->email_pria;
        $emailWanita = $request->email_wanita;

        // Cek apakah sudah ada progress aktif antara keduanya
        $existing = DB::table('progress')
            ->where(function ($query) use ($emailPria, $emailWanita) {
                $query->where('email_auth', $emailPria)
                    ->where('email_profile', $emailWanita);
            })
            ->orWhere(function ($query) use ($emailPria, $emailWanita) {
                $query->where('email_auth', $emailWanita)
                    ->where('email_profile', $emailPria);
            })
            ->first();

        if ($existing) {
            return Redirect::back()->with('error', 'Pasangan ini sudah ada dalam progress ta\'aruf.');
        }

        try {
            $data = [
                'email_auth' => $emailPria,
                'email_profile' => $emailWanita,
                'progress_tgl' => now(),
                'status' => 1
            ];

            DB::table('progress')->insert($data);

            return Redirect::back()->with('success', 'Berhasil memasangkan pasangan ta\'aruf!');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Terjadi kesalahan saat memasangkan: ' . $e->getMessage());
        }
    }

    public function rekomendasi()
    {
        $email = Auth::guard('user')->user()->email;
        $datauser = DB::table('users')->where('email', $email)->first();

        // Ambil semua Pria terverifikasi
        $listPria = DB::table('karyawan')
            ->where('jenkel', 'pria')
            ->where('status', '1')
            ->orderBy('nama', 'asc')
            ->get();

        // Ambil semua Wanita terverifikasi
        $listWanita = DB::table('karyawan')
            ->where('jenkel', 'wanita')
            ->where('status', '1')
            ->orderBy('nama', 'asc')
            ->get();

        $recommendations = DB::table('murobbi_recommendations')
            ->join('users', 'murobbi_recommendations.murobbi_id', '=', 'users.id')
            ->leftJoin('karyawan as pria', 'murobbi_recommendations.karyawan_pria_email', '=', 'pria.email')
            ->leftJoin('karyawan as wanita', 'murobbi_recommendations.karyawan_wanita_email', '=', 'wanita.email')
            ->select(
                'murobbi_recommendations.*',
                'users.name as murobbi_name',
                'pria.nama as nama_pria',
                'wanita.nama as nama_wanita'
            )
            ->orderBy('murobbi_recommendations.created_at', 'desc')
            ->get();

        return view('dashboardadmin.murobi.rekomendasi', compact('datauser', 'listPria', 'listWanita', 'recommendations'));
    }

    public function storeRekomendasi(Request $request)
    {
        $request->validate([
            'email_pria' => 'required|email',
            'email_wanita' => 'required|email',
        ]);

        $murobbiId = Auth::guard('user')->user()->id;

        DB::table('murobbi_recommendations')->insert([
            'murobbi_id' => $murobbiId,
            'karyawan_pria_email' => $request->email_pria,
            'karyawan_wanita_email' => $request->email_wanita,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return Redirect::back()->with('success', 'Rekomendasi berhasil dikirim ke peserta terkait!');
    }

    public function konsultasi()
    {
        $email = Auth::guard('user')->user()->email;
        $datauser = DB::table('users')->where('email', $email)->first();

        $listKonsultasi = DB::table('konsultasi')
            ->join('karyawan', 'konsultasi.karyawan_email', '=', 'karyawan.email')
            ->select('konsultasi.*', 'karyawan.nama', 'karyawan.jenkel')
            ->orderBy('konsultasi.created_at', 'desc')
            ->get();

        return view('dashboardadmin.murobi.konsultasi', compact('datauser', 'listKonsultasi'));
    }

    public function updateKonsultasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        DB::table('konsultasi')->where('id', $id)->update([
            'status' => $request->status,
            'pesan_balasan_murobbi' => $request->pesan_balasan_murobbi,
            'updated_at' => now()
        ]);

        return Redirect::back()->with('success', 'Konsultasi berhasil diupdate!');
    }
}
