<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class MasterInputanController extends Controller
{
    public function masterkaryawan(Request $request)
    {
        // Mendapatkan AUTH
        $user = Auth::guard('user')->user()->email;
        // Mendapatkan data user berdasarkan email
        $datauser = DB::table('users')->where('email', $user)->first();
        
        $gender = $request->input('gender');
        $statusnikah = $request->input('statusnikah');
        
        $query = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->select('karyawan.*', 'biodata.statusnikah')
            ->orderBy('karyawan.status', 'asc')
            ->orderBy('karyawan.nama', 'asc');
        
        if ($gender && in_array($gender, ['pria', 'wanita'])) {
            $query->where('karyawan.jenkel', $gender);
        }

        if ($statusnikah == 'Lajang') {
            $query->where('biodata.statusnikah', 'Lajang');
        } elseif ($statusnikah == 'Duda/Janda') {
            if ($gender == 'pria') {
                $query->whereIn('biodata.statusnikah', ['Duda', 'Duda/Janda']);
            } elseif ($gender == 'wanita') {
                $query->whereIn('biodata.statusnikah', ['Janda', 'Duda/Janda']);
            } else {
                $query->whereIn('biodata.statusnikah', ['Duda', 'Janda', 'Duda/Janda']);
            }
        }
        
        $karyawan = $query->paginate(10); // 10 data per halaman
        
        $appends = [];
        if ($gender) $appends['gender'] = $gender;
        if ($statusnikah) $appends['statusnikah'] = $statusnikah;
        
        if (!empty($appends)) {
            $karyawan->appends($appends);
        }

        return view('dashboardadmin.masterinputan.karyawan', compact('datauser', 'karyawan', 'gender', 'statusnikah'));
    }


    public function verifikasi($id)
    {
        // Ambil data karyawan berdasarkan ID
        $karyawan = DB::table('karyawan')
            ->select(
                'karyawan.*'
            )
            ->where('karyawan.id', $id)
            ->first();

        // Pastikan karyawan ditemukan
        if (!$karyawan) {
            return redirect()->back()->with(['error' => 'Karyawan tidak ditemukan']);
        }

        // Generate token acak
        $token = Str::random(40); // Ubah panjang token sesuai kebutuhan

        // Simpan token ke dalam database karyawan
        DB::table('karyawan')->where('id', $id)->update(['email_verification_token' => $token]);

        // Render view Blade untuk mendapatkan link pesan HTML
        $emailContentHTML = View::make('dashboardadmin.masterinputan.aktivasi', ['activation_link' => url("/masterkaryawan/verify/{$token}")])->render();

        // Hapus tag HTML untuk mendapatkan konten teks
        $emailContentText = strip_tags($emailContentHTML);

        // Kirim email aktivasi kepada karyawan
        $user = [
            'email' => $karyawan->email,
            'activation_link' => url("/masterkaryawan/verify/{$token}")
        ];

        Mail::send('dashboardadmin.masterinputan.aktivasi', $user, function ($message) use ($user) {
            $message->from('no-reply@masjidagungalazhar.com', 'Aktivasi Akun');
            $message->to($user['email']);
            $message->cc('taarufonline2023@gmail.com');
            $message->subject('Aktivasi Akun | Aplikasi Taaruf Online');
        });

        // Redirect jika email berhasil dikirim
        return redirect()->back()->with(['success' => 'Email verifikasi telah dikirim kepada ' . $karyawan->email]);
    }



    public function verify($token)
    {

        // Temukan karyawan berdasarkan token
        $karyawan = DB::table('karyawan')->where('email_verification_token', $token)->first();

        // Pastikan karyawan ditemukan
        if (!$karyawan) {
            return redirect()->back()->with(['error' => 'Token verifikasi tidak valid']);
        }

        // Set status karyawan menjadi 1 (terverifikasi)
        DB::table('karyawan')->where('email_verification_token', $token)->update(['status' => 1]);

        // Redirect atau lakukan operasi lain sesuai kebutuhan
        return Redirect::route('/')->with(['success' => 'Sukses verifikasi !!!']);
    }

    public function viewkaryawan(Request $request)
    {
        $id = $request->id;
        $email = DB::table('karyawan')
            ->select('karyawan.email')
            ->where('id', $id)
            ->first();

        $datakaryawan = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->select('karyawan.email as emailkaryawan', 'karyawan.*', 'biodata.email as emailbiodata', 'biodata.*', 'kriteriapasangan.email as emailkriteria', 'kriteriapasangan.*')
            ->where('karyawan.email', $email->email)
            ->get();

        return view('dashboardadmin.masterinputan.viewkaryawan', compact('datakaryawan'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'new_password' => 'required|min:6'
        ]);

        try {
            DB::table('karyawan')->where('id', $request->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return redirect()->back()->with('success', 'Password pengguna berhasil direset!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mereset password.');
        }
    }

    public function deletekaryawan($id)
    {
        try {
            $karyawan = DB::table('karyawan')->where('id', $id)->first();
            if ($karyawan) {
                DB::table('biodata')->where('email', $karyawan->email)->delete();
                DB::table('kriteriapasangan')->where('email', $karyawan->email)->delete();
                DB::table('karyawan')->where('id', $id)->delete();
                
                return redirect()->back()->with('success', 'Data pengguna berhasil dihapus!');
            }
            return redirect()->back()->with('error', 'Data pengguna tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data pengguna.');
        }
    }


}
