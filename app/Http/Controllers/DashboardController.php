<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

use App\Services\MaaApiService;
use App\Services\ProfileService;
use App\Http\Requests\UpdateBasicProfileRequest;
use App\Http\Requests\UpdateBiodataRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use App\Http\Requests\StoreKonsultasiRequest;

class DashboardController extends Controller
{
    protected $maaApi;
    protected $profileService;

    public function __construct(MaaApiService $maaApi, ProfileService $profileService)
    {
        $this->maaApi = $maaApi;
        $this->profileService = $profileService;
    }

    public function edukasi()
    {
        $email = Auth::guard('karyawan')->user()->email;

        $listVideo = DB::table('edukasi')->where('status', 'aktif')->where('jenis', 'video')->orderBy('created_at', 'desc')->get();
        $listArtikel = DB::table('edukasi')->where('status', 'aktif')->where('jenis', 'artikel')->orderBy('created_at', 'desc')->get();
        $listKelas = DB::table('edukasi')->where('status', 'aktif')->where('jenis', 'kelas')->orderBy('created_at', 'desc')->get();

        $riwayatDaftar = DB::table('pendaftaran_edukasi')
            ->where('karyawan_email', $email)
            ->pluck('status_pendaftaran', 'edukasi_id')
            ->toArray();

        return view('dashboard.edukasi.index', compact('listVideo', 'listArtikel', 'listKelas', 'riwayatDaftar'));
    }

    public function daftarEdukasi(Request $request, $id)
    {
        $email = Auth::guard('karyawan')->user()->email;
        
        $cekDaftar = DB::table('pendaftaran_edukasi')
            ->where('edukasi_id', $id)
            ->where('karyawan_email', $email)
            ->first();

        if ($cekDaftar) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar di kelas ini.');
        }

        DB::table('pendaftaran_edukasi')->insert([
            'edukasi_id' => $id,
            'karyawan_email' => $email,
            'status_pendaftaran' => 'menunggu',
            'created_at' => now()
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar kelas! Silakan tunggu konfirmasi.');
    }

    public function index()
    {
        $databerita = $this->maaApi->getPosts();
        $datalayanan = $this->maaApi->getPrograms();
        $datayoutube = $this->maaApi->getYoutubeVideos();
        $dataslider = $this->maaApi->getSliders();

        return view('dashboard.index', compact('databerita', 'datayoutube', 'datalayanan', 'dataslider'));
    }

    public function lainnya()
    {
        return view('dashboard.lainnya.index');
    }

    public function konsultasi()
    {
        $email = Auth::guard('karyawan')->user()->email;
        $riwayatKonsultasi = DB::table('konsultasi')
            ->where('karyawan_email', $email)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('dashboard.konsultasi.index', compact('riwayatKonsultasi'));
    }

    public function kandidatHarian()
    {
        $user = Auth::guard('karyawan')->user();
        $email = $user->email;
        $oppositeGender = $user->jenkel == 'pria' ? 'wanita' : 'pria';
        
        $myCriteria = DB::table('kriteriapasangan')->where('email', $email)->first();

        $kandidatHarian = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->select('karyawan.*', 'biodata.pendidikan', 'biodata.suku', 'biodata.tgllahir', 'biodata.tinggi', 'biodata.berat')
            ->where('karyawan.jenkel', $oppositeGender)
            ->where('karyawan.status', '1')
            ->inRandomOrder(date('Ymd')) // Random stabil per hari
            ->limit(2)
            ->get();
            
        $kandidatHarian->transform(function($u) use ($myCriteria) {
            $u->match_percentage = $this->calculateMatchPercentage($u, $myCriteria);
            return $u;
        });

        return view('dashboard.kandidat_harian.index', compact('kandidatHarian'));
    }

    public function showBerita($slug)
    {
        $berita = $this->maaApi->getPost($slug);
        
        if (!$berita) {
            return abort(404);
        }

        return view('dashboard.berita.show', compact('berita'));
    }

    public function showLayanan($slug)
    {
        $layanan = $this->maaApi->getProgram($slug);
        
        if (!$layanan) {
            return abort(404);
        }

        return view('dashboard.layanan.show', compact('layanan'));
    }

    public function profile()
    {
        $email = Auth::guard('karyawan')->user()->email;
        $userModel = \App\Models\Karyawan::with(['biodata', 'kriteriapasangan'])->find($email);

        // Memetakan ke struktur yang diharapkan oleh view agar tidak perlu merubah view besar-besaran
        $dataprofilelengkap = (object) [
            'nohp' => $userModel->biodata->nohp ?? '',
            'tempatlahir' => $userModel->biodata->tempatlahir ?? '',
            'tgllahir' => $userModel->biodata->tgllahir ?? '',
            'alamat' => $userModel->biodata->alamat ?? '',
            'goldar' => $userModel->biodata->goldar ?? '',
            'tinggi' => $userModel->biodata->tinggi ?? '',
            'berat' => $userModel->biodata->berat ?? '',
            'statusnikah' => $userModel->biodata->statusnikah ?? '',
            'pekerjaan' => $userModel->biodata->pekerjaan ?? '',
            'suku' => $userModel->biodata->suku ?? '',
            'pendidikan' => $userModel->biodata->pendidikan ?? '',
            'hobi' => $userModel->biodata->hobi ?? '',
            'motto' => $userModel->biodata->motto ?? '',
            'video' => $userModel->biodata->video ?? '',
            'kriteriaumur' => $userModel->kriteriapasangan->kriteriaumur ?? '',
            'kriteriatinggi' => $userModel->kriteriapasangan->kriteriatinggi ?? '',
            'kriteriaberat' => $userModel->kriteriapasangan->kriteriaberat ?? '',
            'kriteriasuku' => $userModel->kriteriapasangan->kriteriasuku ?? '',
            'kriteriaumum' => $userModel->kriteriapasangan->kriteriaumum ?? '',
        ];

        return view('dashboard.profile.index', compact('dataprofilelengkap'));
    }

    public function checkNotifications()
    {
        $emailAuth = Auth::guard('karyawan')->user()->email;

        // Get latest chat received by user
        $latestChat = DB::table('chat')
            ->join('progress', 'progress.id', '=', 'chat.id_progress')
            ->leftJoin('karyawan', 'karyawan.email', '=', 'chat.email_sender')
            ->where(function ($query) use ($emailAuth) {
                $query->where('progress.email_auth', $emailAuth)
                      ->orWhere('progress.email_profile', $emailAuth);
            })
            ->where('chat.email_sender', '!=', $emailAuth)
            ->select('chat.id', 'chat.pesan', 'karyawan.nama')
            ->orderBy('chat.id', 'desc')
            ->first();

        // Get latest progress involving user
        $latestProgress = DB::table('progress')
            ->leftJoin('karyawan', 'karyawan.email', '=', 'progress.email_auth')
            ->where('progress.email_profile', $emailAuth)
            ->select('progress.id', 'karyawan.nama')
            ->orderBy('progress.id', 'desc')
            ->first();

        return response()->json([
            'chat' => $latestChat ? [
                'id' => $latestChat->id,
                'title' => 'Pesan Baru dari ' . $latestChat->nama,
                'body' => \Illuminate\Support\Str::limit($latestChat->pesan, 30)
            ] : null,
            'progress' => $latestProgress ? [
                'id' => $latestProgress->id,
                'title' => 'Kandidat Baru',
                'body' => $latestProgress->nama . ' telah menjadikan Anda kandidat pasangannya.'
            ] : null
        ]);
    }

    public function taaruf(Request $request)
    {
        $user = Auth::guard('karyawan')->user();
        $email = $user->email;
        $oppositeGender = $user->jenkel == 'pria' ? 'wanita' : 'pria';
        
        // Setup query utama dengan join ke tabel biodata untuk keperluan filter
        $query = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->select('karyawan.*', 'biodata.pendidikan', 'biodata.suku', 'biodata.tgllahir', 'biodata.tinggi', 'biodata.berat')
            ->where('karyawan.jenkel', $oppositeGender)
            ->where('karyawan.status', '1');

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('karyawan.nama', 'like', "%{$search}%")
                  ->orWhere('karyawan.nip', 'like', "%{$search}%");
            });
        }

        // Fitur Filter Lanjutan
        if ($request->has('pendidikan') && $request->pendidikan != '') {
            $query->where('biodata.pendidikan', $request->pendidikan);
        }

        if ($request->has('suku') && $request->suku != '') {
            $query->where('biodata.suku', $request->suku);
        }
        
        if ($request->has('usia') && $request->usia != '') {
            $usiaRange = explode('-', $request->usia);
            if(count($usiaRange) == 2) {
                $minAge = (int)$usiaRange[0];
                $maxAge = (int)$usiaRange[1];
                $maxDate = \Carbon\Carbon::now()->subYears($minAge)->format('Y-m-d');
                $minDate = \Carbon\Carbon::now()->subYears($maxAge + 1)->format('Y-m-d');
                $query->whereBetween('biodata.tgllahir', [$minDate, $maxDate]);
            } else if ($request->usia == '40+') {
                $maxDate = \Carbon\Carbon::now()->subYears(40)->format('Y-m-d');
                $query->where('biodata.tgllahir', '<=', $maxDate);
            }
        }

        // Pagination per 12 data
        $users = $query->paginate(12)->appends($request->all());

        // Hitung Match Percentage
        $myCriteria = DB::table('kriteriapasangan')->where('email', $email)->first();
        $users->getCollection()->transform(function($user) use ($myCriteria) {
            $user->match_percentage = $this->calculateMatchPercentage($user, $myCriteria);
            return $user;
        });

        return view('dashboard.taaruf.index', compact('users'));
    }

    public function updateprofile(UpdateBasicProfileRequest $request)
    {
        $user = Auth::guard('karyawan')->user();

        try {
            $this->profileService->updateBasicProfile($user, $request);
            return Redirect::back()->with(['success' => 'Berhasil diupdate']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }

    public function updateprofile2(UpdateBiodataRequest $request)
    {
        $user = Auth::guard('karyawan')->user();

        try {
            $this->profileService->updateBiodata($user, $request);
            return Redirect::back()->with(['success' => 'Berhasil diupdate']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }

    public function updateprofile3(UpdateKriteriaRequest $request)
    {
        $user = Auth::guard('karyawan')->user();

        try {
            $this->profileService->updateKriteria($user, $request);
            return Redirect::back()->with(['success' => 'Berhasil diupdate']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }

    public function storetanya(Request $request)
    {
        $email = $request->email;
        $pertanyaan = $request->pertanyaan;
        $tgl = now();


        try {
            $data = [
                'email' => $email,
                'pertanyaan' => $pertanyaan,
                'tgl_tanya' => $tgl

            ];

            $simpan = DB::table('pertanyaan')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Berhasil !!!, Kami akan membalas email anda secepatnya.']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }

    public function storeKonsultasi(StoreKonsultasiRequest $request)
    {
        DB::table('konsultasi')->insert([
            'karyawan_email' => Auth::guard('karyawan')->user()->email,
            'topik_konsultasi' => $request->topik_konsultasi,
            'pesan' => $request->pesan,
            'status' => 'menunggu',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return Redirect::back()->with('success', 'Permintaan konsultasi berhasil dikirim!');
    }

    public function cetakCv($email)
    {
        // Pastikan hanya bisa cetak CV milik sendiri
        $authEmail = Auth::guard('karyawan')->user()->email;
        if ($authEmail != $email) {
            return Redirect::back()->with('warning', 'Anda tidak diizinkan mencetak CV orang lain.');
        }

        $user = DB::table('karyawan')->where('email', $email)->first();
        $biodata = DB::table('biodata')->where('email', $email)->first();
        $kriteria = DB::table('kriteriapasangan')->where('email', $email)->first();

        if (!$user) {
            return Redirect::back()->with('warning', 'Data tidak ditemukan.');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dashboard.profile.cv_pdf', compact('user', 'biodata', 'kriteria'));
        return $pdf->download('CV_Taaruf_' . str_replace(' ', '_', $user->nama) . '.pdf');
    }

    private function calculateMatchPercentage($user, $myCriteria)
    {
        $score = 20; // Base score (opposite gender)
        
        if ($myCriteria) {
            // Usia
            if (!empty($myCriteria->kriteriaumur) && !empty($user->tgllahir) && $myCriteria->kriteriaumur != 'Bebas' && $myCriteria->kriteriaumur != 'Tidak ada kriteria khusus') {
                $age = \Carbon\Carbon::parse($user->tgllahir)->age;
                $range = explode('-', $myCriteria->kriteriaumur);
                if (count($range) == 2 && $age >= (int)$range[0] && $age <= (int)$range[1]) {
                    $score += 20;
                } else if ($myCriteria->kriteriaumur == '40+' && $age >= 40) {
                    $score += 20;
                }
            } else if ($myCriteria->kriteriaumur == 'Bebas' || empty($myCriteria->kriteriaumur) || $myCriteria->kriteriaumur == 'Tidak ada kriteria khusus') {
                $score += 20;
            }

            // Tinggi
            if (!empty($myCriteria->kriteriatinggi) && !empty($user->tinggi) && $myCriteria->kriteriatinggi != 'Bebas' && $myCriteria->kriteriatinggi != 'Tidak ada kriteria khusus') {
                $range = explode('-', $myCriteria->kriteriatinggi);
                if (count($range) == 2 && $user->tinggi >= (int)$range[0] && $user->tinggi <= (int)$range[1]) {
                    $score += 20;
                }
            } else if ($myCriteria->kriteriatinggi == 'Bebas' || empty($myCriteria->kriteriatinggi) || $myCriteria->kriteriatinggi == 'Tidak ada kriteria khusus') {
                $score += 20;
            }

            // Berat
            if (!empty($myCriteria->kriteriaberat) && !empty($user->berat) && $myCriteria->kriteriaberat != 'Bebas' && $myCriteria->kriteriaberat != 'Tidak ada kriteria khusus') {
                $range = explode('-', $myCriteria->kriteriaberat);
                if (count($range) == 2 && $user->berat >= (int)$range[0] && $user->berat <= (int)$range[1]) {
                    $score += 20;
                }
            } else if ($myCriteria->kriteriaberat == 'Bebas' || empty($myCriteria->kriteriaberat) || $myCriteria->kriteriaberat == 'Tidak ada kriteria khusus') {
                $score += 20;
            }

            // Suku
            if (!empty($myCriteria->kriteriasuku) && !empty($user->suku) && $myCriteria->kriteriasuku != 'Bebas' && $myCriteria->kriteriasuku != 'Tidak ada kriteria khusus') {
                if (strtolower($myCriteria->kriteriasuku) == strtolower($user->suku)) {
                    $score += 20;
                }
            } else if ($myCriteria->kriteriasuku == 'Bebas' || empty($myCriteria->kriteriasuku) || $myCriteria->kriteriasuku == 'Tidak ada kriteria khusus') {
                $score += 20;
            }
        }
        
        return min(100, $score);
    }
}
