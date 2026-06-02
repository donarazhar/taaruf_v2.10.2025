<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $karyawan = DB::table('karyawan')
            ->select('karyawan.*', 'biodata.*', 'kriteriapasangan.*')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->where('karyawan.email', '=', $user) // Tambahkan tanda kutip di sekitar $email
            ->first();
        // Melakukan LEFT JOIN ke tabel karyawan untuk mendapatkan data dari tabel karyawan
        $dataprogress = DB::table('progress')
            ->leftJoin('karyawan', 'karyawan.email', '=', 'progress.email_auth')
            ->where(function ($query) use ($user) {
                $query->where('progress.email_auth', $user)
                    ->orWhere('progress.email_profile', $user);
            })
            ->where('progress.status', 1)
            ->select('progress.*', 'karyawan.nama')
            ->get();
        $likedislike = DB::table('likedislike')->get();

        $cekemail = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->select('karyawan.email', 'biodata.email as biodata_email', 'kriteriapasangan.email as kriteriapasangan_email')
            ->where('karyawan.email', $user)
            ->first();

        if ($cekemail) {
            // Jika email ditemukan di tabel karyawan
            if (
                $cekemail->biodata_email !== null && $cekemail->kriteriapasangan_email !== null
            ) {
                // Lakukan sesuatu jika email ditemukan di kedua tabel biodata dan kriteriapasangan
                // Misalnya, aktifkan menu
                $menuAktif = true;
            } else {
                // Lakukan sesuatu jika email tidak ditemukan di salah satu atau kedua tabel
                // Misalnya, nonaktifkan menu
                $menuAktif = false;
            }
        } else {
            // Lakukan sesuatu jika email tidak ditemukan di tabel karyawan
            // Misalnya, nonaktifkan menu
            $menuAktif = false;
        }


        return view('dashboard.progress.index', compact('dataprogress', 'karyawan', 'likedislike', 'menuAktif'));
    }

    public function like($id)
    {
        // Mendapatkan email auth
        $emailAuth = Auth::guard('karyawan')->user()->email;

        // Proses update atau insert
        DB::table('likedislike')->updateOrInsert(
            ['id_progress' => $id, 'emailAct' => $emailAuth],
            ['status' => 1]
        );

        // Redirect atau lakukan operasi lain sesuai kebutuhan
        return Redirect::back()->with(['success' => 'Terima kasih anda sudah melakukan pilihan !!!']);
    }

    public function dislike($id)
    {
        // Mendapatkan email auth
        $emailAuth = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data progress yang akan dipindahkan
        $progressData = DB::table('progress')
            ->leftJoin('likedislike', 'progress.id', '=', 'likedislike.id_progress')
            ->select('progress.*', 'likedislike.*', 'likedislike.id as likedislike_id')
            ->where('progress.id', $id)
            ->first();

        if ($progressData) {
            // Proses insert ke tabel progress_shadow
            DB::table('progress_shadow')->insert([
                'id' => $progressData->id,
                'email_auth' => $progressData->email_auth,
                'email_profile' => $progressData->email_profile,
                'progress_tgl' => $progressData->progress_tgl,
                'status' => $progressData->status,
            ]);

            // Proses insert ke tabel likedislike_shadow
            DB::table('likedislike_shadow')->insert([
                'id' => $progressData->likedislike_id,
                'id_progress' => $progressData->id,
                'emailact' => $emailAuth,
                'status' => 0,
            ]);

            // Proses pindah semua data dari tabel chat ke chat_shadow
            $chatData = DB::table('chat')->where('id_progress', $id)->get();

            foreach ($chatData as $chatRow) {
                DB::table('chat_shadow')->insert([
                    'id' => $chatRow->id,
                    'id_progress' => $chatRow->id_progress,
                    'pesan' => $chatRow->pesan,
                    'email_sender' => $chatRow->email_sender,
                    'tgl_pesan' => $chatRow->tgl_pesan,
                ]);
            }

            // Proses hapus data dari tabel progress
            DB::table('progress')->where('id', $id)->delete();
            // Proses hapus data dari tabel likedislike
            DB::table('likedislike')->where('id_progress', $id)->delete();
            // Proses hapus semua data dari tabel chat
            DB::table('chat')->where('id_progress', $id)->delete();

            // Redirect atau lakukan operasi lain sesuai kebutuhan
            return Redirect::back()->with(['success' => 'Terima kasih, sistem akan permintaan anda !!!']);
        } else {
            // Data progress tidak ditemukan, mungkin ada penanganan khusus yang perlu dilakukan
            return Redirect::back()->with(['error' => 'Data progress tidak ditemukan.']);
        }
    }
}
