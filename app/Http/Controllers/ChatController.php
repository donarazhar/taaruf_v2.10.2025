<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreChatRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewChatNotification;

class ChatController extends Controller
{
    public function chat($id)
    {
        // Mendapatkan email auth
        $emailAuth = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $karyawan = DB::table('karyawan')
            ->select('karyawan.*', 'biodata.*', 'kriteriapasangan.*')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin(
                'kriteriapasangan',
                'karyawan.email',
                '=',
                'kriteriapasangan.email'
            )
            ->where(
                'karyawan.email',
                '=',
                $emailAuth
            ) // Tambahkan tanda kutip di sekitar $email
            ->first();

        $dataprogress = DB::table('progress')
            ->leftJoin('karyawan', 'karyawan.email', '=', 'progress.email_auth')
            ->where(function ($query) use ($emailAuth) {
                $query->where('progress.email_auth', $emailAuth)
                    ->orWhere('progress.email_profile', $emailAuth);
            })
            ->where('progress.status', 1)
            ->select('progress.*', 'karyawan.nama')
            ->get();

        // Melakukan LEFT JOIN ke tabel karyawan untuk mendapatkan data dari tabel karyawan
        $datachat = DB::table('chat')
            ->join(
                'progress',
                'progress.id',
                '=',
                'chat.id_progress'
            )
            ->leftJoin('karyawan', 'karyawan.email', '=', 'chat.email_sender')
            ->where(function ($query) use ($emailAuth) {
                $query->where('progress.email_auth', $emailAuth)
                    ->orWhere('progress.email_profile', $emailAuth);
            })
            ->where('progress.status', 1)
            ->select('chat.id', 'progress.id as id_progress', 'chat.email_sender', 'chat.pesan', 'chat.tgl_pesan', 'karyawan.nama', 'karyawan.foto', 'karyawan.jenkel')
            ->orderBy('chat.tgl_pesan', 'asc')
            ->get();

        return view('dashboard.progress.chat', compact('karyawan', 'datachat', 'dataprogress'));
    }

    public function store($id, StoreChatRequest $request)
    {
        $emailAuth = Auth::guard('karyawan')->user()->email;
        $pesan = $request->pesan;

        // Cek authorization
        $progress = DB::table('progress')
            ->where('id', $id)
            ->where(function ($query) use ($emailAuth) {
                $query->where('email_auth', $emailAuth)
                    ->orWhere('email_profile', $emailAuth);
            })
            ->first();

        if (!$progress) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $data = [
                'pesan' => $pesan,
                'id_progress' => $id,
                'email_sender' => $emailAuth,
                'tgl_pesan' => now()->format('Y-m-d H:i:s')
            ];

            $simpan = DB::table('chat')->insert($data);
            if ($simpan) {
                // Tentukan penerima email (lawan bicara)
                $recipientEmail = ($progress->email_auth === $emailAuth) ? $progress->email_profile : $progress->email_auth;
                
                // Ambil nama pengirim
                $senderName = Auth::guard('karyawan')->user()->nama;
                
                // Generate URL ke halaman chat
                $chatUrl = url('/chat/' . $id);
                
                // Kirim email (menggunakan queue)
                Mail::to($recipientEmail)->send(new NewChatNotification($senderName, $pesan, $chatUrl));

                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Gagal mengirim pesan']);
        }
    }
    
    public function fetch($id)
{
    $emailAuth = Auth::guard('karyawan')->user()->email;

    $datachat = DB::table('chat')
        ->join('progress', 'progress.id', '=', 'chat.id_progress')
        ->leftJoin('karyawan', 'karyawan.email', '=', 'chat.email_sender')
        ->where('progress.id', $id)
        ->where(function ($query) use ($emailAuth) {
            $query->where('progress.email_auth', $emailAuth)
                ->orWhere('progress.email_profile', $emailAuth);
        })
        ->where('progress.status', 1)
        ->select(
            'chat.id',
            'progress.id as id_progress',
            'chat.email_sender',
            'chat.pesan',
            'chat.tgl_pesan',
            'karyawan.nama',
            'karyawan.foto',
            'karyawan.jenkel'
        )
        ->orderBy('chat.tgl_pesan', 'asc')
        ->get();

    return response()->json($datachat);
}


    public function historychat($id)
    {
        // Mendapatkan data dari tabel 'chat_shadow' berdasarkan id_progress
        $chatData = DB::table('chat')
            ->join('progress', 'chat.id_progress', '=', 'progress.id')
            ->leftJoin('karyawan as senderKaryawan', 'chat.email_sender', '=', 'senderKaryawan.email')
            ->leftJoin('karyawan as profileKaryawan', 'progress.email_profile', '=', 'profileKaryawan.email')
            ->where('progress.id', $id)
            ->select(
                'progress.id as id_progress',
                'progress.email_auth',
                'progress.email_profile',
                'senderKaryawan.nama as nama_sender',
                'profileKaryawan.nama as nama_profile',
                'senderKaryawan.foto as foto_sender',
                'profileKaryawan.foto as foto_profile',
                'chat.pesan as pesan_sender',
                'chat.pesan as pesan_profile',
                'chat.tgl_pesan as tgl_pesan_sender',
                'chat.tgl_pesan as tgl_pesan_profile',
                DB::raw('CASE WHEN chat.email_sender = progress.email_auth THEN chat.pesan ELSE NULL END as pesan_sender'),
                DB::raw('CASE WHEN chat.email_sender = progress.email_profile THEN chat.pesan ELSE NULL END as pesan_profile'),
                DB::raw('CASE WHEN chat.email_sender = progress.email_auth THEN chat.tgl_pesan ELSE NULL END as tgl_pesan_sender'),
                DB::raw('CASE WHEN chat.email_sender = progress.email_profile THEN chat.tgl_pesan ELSE NULL END as tgl_pesan_profile')
            )
            ->get();

        // Mendapatkan data dari tabel 'chat_shadow' berdasarkan id_progress
        $chatShadowData = DB::table('chat_shadow')
            ->join('progress_shadow', 'chat_shadow.id_progress', '=', 'progress_shadow.id')
            ->leftJoin('karyawan as senderKaryawan', 'chat_shadow.email_sender', '=', 'senderKaryawan.email')
            ->leftJoin('karyawan as profileKaryawan', 'progress_shadow.email_profile', '=', 'profileKaryawan.email')
            ->where('progress_shadow.id', $id)
            ->select(
                'progress_shadow.id as id_progress',
                'progress_shadow.email_auth',
                'progress_shadow.email_profile',
                'senderKaryawan.nama as nama_sender',
                'profileKaryawan.nama as nama_profile',
                'senderKaryawan.foto as foto_sender',
                'profileKaryawan.foto as foto_profile',
                'chat_shadow.pesan as pesan_sender',
                'chat_shadow.pesan as pesan_profile',
                'chat_shadow.tgl_pesan as tgl_pesan_sender',
                'chat_shadow.tgl_pesan as tgl_pesan_profile',
                DB::raw('CASE WHEN chat_shadow.email_sender = progress_shadow.email_auth THEN chat_shadow.pesan ELSE NULL END as pesan_sender'),
                DB::raw('CASE WHEN chat_shadow.email_sender = progress_shadow.email_profile THEN chat_shadow.pesan ELSE NULL END as pesan_profile'),
                DB::raw('CASE WHEN chat_shadow.email_sender = progress_shadow.email_auth THEN chat_shadow.email_sender ELSE NULL END as tgl_pesan_sender'),
                DB::raw('CASE WHEN chat_shadow.email_sender = progress_shadow.email_profile THEN chat_shadow.tgl_pesan ELSE NULL END as tgl_pesan_profile')
            )
            ->get();
        // Menggabungkan data dari 'chat' dan 'chat_shadow'
        $allChats = $chatData->merge($chatShadowData);

        // Tampilkan view meskipun data kosong (view sudah memiliki empty state)
        return view('dashboardadmin.chathistory.history', compact('allChats'));
    }

    public function deletehistorychat($id)
    {
        try {
            DB::table('chat')->where('id_progress', $id)->delete();
            DB::table('chat_shadow')->where('id_progress', $id)->delete();
            return redirect()->back()->with('success', 'History chat berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus history chat');
        }
    }
}
