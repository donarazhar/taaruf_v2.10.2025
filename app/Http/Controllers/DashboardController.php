<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan AUTH
        $email = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        try {
            $response = \Illuminate\Support\Facades\Http::timeout(5)->get(env('MAA_WEB_URL', 'http://localhost:8001') . '/api/posts');
            if ($response->successful() && isset($response->json()['data']['data'])) {
                $databerita = collect(json_decode(json_encode($response->json()['data']['data'])))->map(function($item) {
                    return (object)[
                        'slug' => $item->slug,
                        'judul' => $item->title,
                        'subjudul' => $item->excerpt,
                        'foto' => $item->featured_image ? env('MAA_WEB_URL', 'http://localhost:8001') . '/storage/' . $item->featured_image : null
                    ];
                });
            } else {
                $databerita = collect([]);
            }
        } catch (\Exception $e) {
            $databerita = collect([]);
        }

        // Get Data Layanan
        $datalayanan = collect();
        try {
            $responseLayanan = \Illuminate\Support\Facades\Http::timeout(5)->get(env('MAA_WEB_URL', 'http://localhost:8001') . '/api/programs');
            if ($responseLayanan->successful() && isset($responseLayanan->json()['data'])) {
                $datalayanan = collect($responseLayanan->json()['data']);
            }
        } catch (\Exception $e) {
            // Ignore error
        }

        // Get Data Youtube
        $datayoutube = collect();
        try {
            $responseYt = \Illuminate\Support\Facades\Http::timeout(5)->get(env('MAA_WEB_URL', 'http://localhost:8001') . '/api/youtube');
            if ($responseYt->successful() && isset($responseYt->json()['data'])) {
                $datayoutube = collect(json_decode(json_encode($responseYt->json()['data'])));
            }
        } catch (\Exception $e) {
            // Ignore error
        }

        // Get Data Slider
        $dataslider = collect();
        try {
            $responseSlider = \Illuminate\Support\Facades\Http::timeout(5)->get(env('MAA_WEB_URL', 'http://localhost:8001') . '/api/sliders');
            if ($responseSlider->successful() && isset($responseSlider->json()['data'])) {
                $dataslider = collect(json_decode(json_encode($responseSlider->json()['data'])));
            }
        } catch (\Exception $e) {
            // Ignore error
        }

        $cekemail = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->select('karyawan.email', 'biodata.email as biodata_email', 'kriteriapasangan.email as kriteriapasangan_email')
            ->where('karyawan.email', $email)
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

        // --- Kandidat Pilihan Hari Ini (Daily Recommendation) ---
        $oppositeGender = $dataprofile->jenkel == 'pria' ? 'wanita' : 'pria';
        $myCriteria = DB::table('kriteriapasangan')->where('email', $email)->first();

        $kandidatHarian = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->select('karyawan.*', 'biodata.pendidikan', 'biodata.suku', 'biodata.tgllahir', 'biodata.tinggi', 'biodata.berat')
            ->where('karyawan.jenkel', $oppositeGender)
            ->where('karyawan.status', '1')
            ->inRandomOrder(date('Ymd')) // Random stabil per hari
            ->limit(2)
            ->get();
            
        $kandidatHarian->transform(function($user) use ($myCriteria) {
            $user->match_percentage = $this->calculateMatchPercentage($user, $myCriteria);
            return $user;
        });

        // --- Riwayat Konsultasi ---
        $riwayatKonsultasi = DB::table('konsultasi')
            ->where('karyawan_email', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.index', compact('dataprofile', 'databerita', 'datayoutube', 'menuAktif', 'datalayanan', 'dataslider', 'kandidatHarian', 'riwayatKonsultasi'));
    }

    public function showBerita($slug)
    {
        $email = Auth::guard('karyawan')->user()->email;
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();

        $cekemail = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->select('karyawan.email', 'biodata.email as biodata_email', 'kriteriapasangan.email as kriteriapasangan_email')
            ->where('karyawan.email', $email)
            ->first();

        if ($cekemail) {
            if ($cekemail->biodata_email !== null && $cekemail->kriteriapasangan_email !== null) {
                $menuAktif = true;
            } else {
                $menuAktif = false;
            }
        } else {
            $menuAktif = false;
        }

        try {
            $response = \Illuminate\Support\Facades\Http::timeout(5)->get(env('MAA_WEB_URL', 'http://localhost:8001') . '/api/posts/' . $slug);
            if ($response->successful() && isset($response->json()['data'])) {
                $berita = (object) $response->json()['data'];
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            return abort(404);
        }

        return view('dashboard.berita.show', compact('dataprofile', 'berita', 'menuAktif'));
    }

    public function showLayanan($slug)
    {
        $email = Auth::guard('karyawan')->user()->email;
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();

        $cekemail = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->select('karyawan.email', 'biodata.email as biodata_email', 'kriteriapasangan.email as kriteriapasangan_email')
            ->where('karyawan.email', $email)
            ->first();

        if ($cekemail) {
            if ($cekemail->biodata_email !== null && $cekemail->kriteriapasangan_email !== null) {
                $menuAktif = true;
            } else {
                $menuAktif = false;
            }
        } else {
            $menuAktif = false;
        }

        try {
            $response = \Illuminate\Support\Facades\Http::timeout(5)->get(env('MAA_WEB_URL', 'http://localhost:8001') . '/api/programs/' . $slug);
            if ($response->successful() && isset($response->json()['data'])) {
                $layanan = (object) $response->json()['data'];
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            return abort(404);
        }

        return view('dashboard.layanan.show', compact('dataprofile', 'layanan', 'menuAktif'));
    }

    public function profile()
    {
        // Mendapatkan AUTH
        $email = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        $dataprofilelengkap = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->where('karyawan.email', $email)
            ->first();

        $cekemail = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->select('karyawan.email', 'biodata.email as biodata_email', 'kriteriapasangan.email as kriteriapasangan_email')
            ->where('karyawan.email', $email)
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


        return view('dashboard.profile.index', compact('dataprofile', 'dataprofilelengkap', 'menuAktif'));
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
        // Mendapatkan AUTH
        $email = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        
        // Membaca jenis kelamin dari data profile (pria/wanita), lalu cari lawan jenis
        $oppositeGender = $dataprofile->jenkel == 'pria' ? 'wanita' : 'pria';
        
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

        $cekemail = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->select('karyawan.email', 'biodata.email as biodata_email', 'kriteriapasangan.email as kriteriapasangan_email')
            ->where('karyawan.email', $email)
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


        return view('dashboard.taaruf.index', compact('dataprofile', 'users', 'menuAktif'));
    }

    public function progress()
    {
        // Mendapatkan AUTH
        $email = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();



        return view('dashboard.progress.index', compact('dataprofile'));
    }

    public function updateprofile(Request $request)
    {
        $user = Auth::guard('karyawan')->user();
        $email = $user->email;
        $nama = $request->nama;
        $password = $request->password;

        // Validasi untuk file yang diupload
        $request->validate([
            'foto' => 'image|mimes:png,jpg|max:2024'
        ]);

        try {
            // Proses Upload Foto
            $foto = $user->foto;
            if ($request->hasFile('foto')) {
                $foto = $email . '.' . $request->file('foto')->getClientOriginalExtension();
                $request->file('foto')->storeAs('public/uploads/karyawan/img/', $foto);
            }

            // Data untuk diupdate
            $data = [
                'nama' => $nama,
                'foto' => $foto,
            ];

            // Jika password diisi, update password
            if (!empty($password)) {
                $data['password'] = Hash::make($password);
            }

            // Lakukan update data karyawan
            DB::table('karyawan')->where('email', $email)->update($data);

            return Redirect::back()->with(['success' => 'Berhasil diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }

    public function updateprofile2(Request $request)
    {
        $user = Auth::guard('karyawan')->user();
        $email = $user->email;
        $nohp = $request->nohp;
        $tempatlahir = $request->tempatlahir;
        $tgllahir = $request->tgllahir;
        $tinggi = $request->tinggi;
        $berat = $request->berat;
        $goldar = $request->goldar;
        $statusnikah = $request->statusnikah;
        $pekerjaan = $request->pekerjaan;
        $suku = $request->suku;
        $pendidikan = $request->pendidikan;
        $hobi = $request->hobi;
        $motto = $request->motto;
        $alamat = $request->alamat;
        $video = $request->video;

        // Validasi untuk file yang diupload
        $request->validate([
            'video' => 'mimetypes:video/mp4,video/x-msvideo,video/mpeg,video/quicktime|max:8024',
        ]);

        try {
            // Pemeriksaan apakah biodata dengan email tersebut sudah ada
            $adaData = DB::table('biodata')->where('email', $email)->first();

            // Proses Upload Foto
            $video = $user->video;
            if ($request->hasFile('video')) {
                $video = $email . '.' . $request->file('video')->getClientOriginalExtension();
                $request->file('video')->storeAs('public/uploads/karyawan/video/', $video);
            }

            // Data untuk diupdate
            $data = [
                'email' => $email,
                'nohp' => $nohp,
                'tempatlahir' => $tempatlahir,
                'tgllahir' => $tgllahir,
                'tinggi' => $tinggi,
                'berat' => $berat,
                'goldar' => $goldar,
                'statusnikah' => $statusnikah,
                'pekerjaan' => $pekerjaan,
                'suku' => $suku,
                'pendidikan' => $pendidikan,
                'hobi' => $hobi,
                'motto' => $motto,
                'alamat' => $alamat,
                'video' => $video,
            ];

            // Lakukan insert jika belum ada data, atau update jika sudah ada
            if ($adaData) {
                DB::table('biodata')->where('email', $email)->update($data);
            } else {
                DB::table('biodata')->insert($data);
            }
            return Redirect::back()->with(['success' => 'Berhasil diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }

    public function updateprofile3(Request $request)
    {
        $user = Auth::guard('karyawan')->user();
        $email = $user->email;
        $umurRange = $request->umurRange;
        $beratRange = $request->beratRange;
        $tinggiRange = $request->tinggiRange;
        $sukupilihan = $request->sukupilihan;
        $kriteriaumum = $request->kriteriaumum;

        try {
            // Pemeriksaan apakah biodata dengan email tersebut sudah ada
            $adaData = DB::table('kriteriapasangan')->where('email', $email)->first();

            // Data untuk diupdate
            $data = [
                'email' => $email,
                'kriteriaumur' => $umurRange,
                'kriteriatinggi' => $tinggiRange,
                'kriteriaberat' => $beratRange,
                'kriteriasuku' => $sukupilihan,
                'kriteriaumum' => $kriteriaumum,

            ];
            // Lakukan insert jika belum ada data, atau update jika sudah ada
            if ($adaData) {
                DB::table('kriteriapasangan')->where('email', $email)->update($data);
            } else {
                DB::table('kriteriapasangan')->insert($data);
            }

            return Redirect::back()->with(['success' => 'Berhasil diupdate']);
        } catch (\Exception $e) {
            dd($e);
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

    public function storeKonsultasi(Request $request)
    {
        $request->validate([
            'topik_konsultasi' => 'required',
            'pesan' => 'required',
        ]);

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
