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
        
        $query = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->select('karyawan.*', 'biodata.statusnikah')
            ->orderBy('karyawan.nama', 'asc');
        
        if ($gender && in_array($gender, ['L', 'P'])) {
            $query->where('karyawan.jenkel', $gender);
        }
        
        $karyawan = $query->paginate(10); // 10 data per halaman
        
        if ($gender) {
            $karyawan->appends(['gender' => $gender]);
        }

        return view('dashboardadmin.masterinputan.karyawan', compact('datauser', 'karyawan', 'gender'));
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

    public function masterberita()
    {
        // Mendapatkan AUTH
        $user = Auth::guard('user')->user()->email;
        // Mendapatkan data user berdasarkan email
        $datauser = DB::table('users')->where('email', $user)->first();
        $databerita = DB::table('berita')->get();

        return view('dashboardadmin.masterinputan.berita', compact('databerita', 'datauser'));
    }

    public function editberita(Request $request)
    {
        $id = $request->id;
        $user = Auth::guard('user')->user()->email;
        $datauser = DB::table('users')->where('email', $user)->first();
        $databerita = DB::table('berita')->where('id', $id)->first();

        return view('dashboardadmin.masterinputan.editberita', compact('databerita', 'datauser'));
    }

    public function updateberita($id, Request $request)
    {
        // Validasi input
        $request->validate([
            'fotoedit' => 'image|mimes:png,jpg|max:2024',
            'juduledit' => 'required',
            'subjuduledit' => 'required',
            'isiberitaedit' => 'required',
            'linkedit' => 'required',
        ]);

        try {
            // Mengambil data berita dari database
            $databerita = DB::table('berita')->where('id', $id)->first();

            // Foto lama
            $fotoFileLama = $request->file('fotoeditlama');
            $fotoLama = $databerita->foto;

            // Foto baru
            $fotoFile = $request->file('fotoedit');
            $foto = $fotoLama; // Default to the old photo

            // Proses Upload Foto baru
            if ($fotoFile) {
                // Menentukan nama file foto yang akan digunakan
                $extension = $fotoFile->getClientOriginalExtension();
                $filename = substr(Hash::make($fotoFile->getClientOriginalName()), 0, 10) . '.' . $extension;
                $foto = $filename;

                // Upload foto baru
                $fotoFile->storeAs('public/uploads/berita/', $filename);

                // Hapus foto lama jika berhasil mengunggah foto baru
                if ($fotoLama && Storage::exists('public/uploads/berita/' . $fotoLama)) {
                    Storage::delete('public/uploads/berita/' . $fotoLama);
                }
            }

            // Data yang akan diupdate
            $data = [
                'foto' => $foto,
                'judul' => $request->input('juduledit'),
                'subjudul' => $request->input('subjuduledit'),
                'isi' => $request->input('isiberitaedit'),
                'link' => $request->input('linkedit'),
            ];

            // Lakukan update
            DB::table('berita')->where('id', $id)->update($data);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Berita berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function berita1(Request $request)
    {
        $id = "1";
        $databerita = DB::table('berita')->where('id', $id)->first();
        return view('dashboardadmin.masterinputan.berita1', compact('databerita'));
    }
    public function berita2(Request $request)
    {
        $id = "2";
        $databerita = DB::table('berita')->where('id', $id)->first();
        return view('dashboardadmin.masterinputan.berita2', compact('databerita'));
    }
    public function berita3(Request $request)
    {
        $id = "3";
        $databerita = DB::table('berita')->where('id', $id)->first();
        return view('dashboardadmin.masterinputan.berita3', compact('databerita'));
    }
    public function berita4(Request $request)
    {
        $id = "4";
        $databerita = DB::table('berita')->where('id', $id)->first();
        return view('dashboardadmin.masterinputan.berita4', compact('databerita'));
    }


    public function masteryoutube()
    {
        // Mendapatkan AUTH
        $user = Auth::guard('user')->user()->email;
        // Mendapatkan data user berdasarkan email
        $datauser = DB::table('users')->where('email', $user)->first();
        $datayoutube = DB::table('youtube')->get();

        return view('dashboardadmin.masterinputan.youtube', compact('datayoutube', 'datauser'));
    }

    public function edityoutube(Request $request)
    {
        $id = $request->id;
        $user = Auth::guard('user')->user()->email;
        $datauser = DB::table('users')->where('email', $user)->first();
        $datayoutube = DB::table('youtube')->where('id', $id)->first();

        return view('dashboardadmin.masterinputan.edityoutube', compact('datayoutube', 'datauser'));
    }

    public function updateyoutube($id, Request $request)
    {
        // Validasi input
        $request->validate([
            'fotoedit' => 'image|mimes:png,jpg|max:2024',
            'linkedit' => 'required'
        ]);

        try {
            // Mengambil data berita dari database
            $datayoutube = DB::table('youtube')->where('id', $id)->first();

            // Foto lama
            $fotoFileLama = $request->file('fotoeditlama');
            $fotoLama = $datayoutube->gambar;

            // Foto baru
            $fotoFile = $request->file('fotoedit');
            $foto = $fotoLama; // Default to the old photo

            // Proses Upload Foto baru
            if ($fotoFile) {
                // Menentukan nama file foto yang akan digunakan
                $extension = $fotoFile->getClientOriginalExtension();
                $filename = substr(Hash::make($fotoFile->getClientOriginalName()), 0, 10) . '.' . $extension;
                $foto = $filename;

                // Upload foto baru
                $fotoFile->storeAs('public/uploads/youtube/', $filename);

                // Hapus foto lama jika berhasil mengunggah foto baru
                if ($fotoLama && Storage::exists('public/uploads/berita/' . $fotoLama)) {
                    Storage::delete('public/uploads/berita/' . $fotoLama);
                }
            }

            // Data yang akan diupdate
            $data = [
                'gambar' => $foto,
                'link' => $request->input('linkedit')
            ];

            // Lakukan update
            DB::table('youtube')->where('id', $id)->update($data);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Berita berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
