<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    public function hitungdataapp()
    {
        $result = DB::table('karyawan')
            ->select('jenkel', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('jenkel')
            ->get();

        return $result;
    }

    public function prosesdaftar(Request $request)
    {
        $nip = $request->nip;
        $nama = $request->nama;
        $jenkel = $request->jenkel;
        $referensi = $request->referensi;
        $referensiDetail = $request->referensiDetail;
        $email = $request->email;
        $password = $request->password;

        try {
            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'jenkel' => $jenkel,
                'referensi' => $referensi,
                'referensi_detail' => $referensiDetail,
                'email' => $email,
                'password' => Hash::make($password)
            ];

            $simpan = DB::table('karyawan')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Berhasil Mendaftar !!!, Mohon menunggu email konfirmasi untuk LOGIN.']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }

    // Login karyawam
    public function proseslogin(Request $request)
    {

        if (Auth::guard('karyawan')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => '1'])) {
            return redirect('/dashboard');
        } else {
            $user = Karyawan::where('email', $request->email)->first();

            if ($user && $user->status === null) {
                return redirect('/login')->with(['warning' => 'Anda belum klik tautan link verifikasi| Cek email sekarang !']);
            } else {
                return redirect('/login')->with(['warning' => 'Email atau password salah']);
            }
        }
    }

    public function proseslogout()
    {
        // logout karyawan
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }


    // Login Admin
    public function prosesloginadmin(Request $request)
    {
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboardadmin');
        } else {
            return redirect('/panel')->with(['warning' => 'Username / Password Salah']);
        }
    }

    public function proseslogoutadmin()
    {
        // logout admin
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }
}
