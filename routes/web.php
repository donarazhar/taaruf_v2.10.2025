<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterInputanController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\TaarufContoller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ROUTE TAMU/PENGGUNA TANPA LOGIN
Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        $datapria = DB::table('karyawan')->where('jenkel', 'pria')->count();
        $datawanita = DB::table('karyawan')->where('jenkel', 'wanita')->count();
        $totalproses = DB::table('proses')->count();
        $totalprogress = DB::table('progress')->count();


        return view('auth.beranda', compact('datapria', 'datawanita', 'totalproses', 'totalprogress'));
    })->name('/');
    Route::get('/daftar', function () {
        return view('auth.daftar');
    })->name('daftar');
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/prosesdaftar', [AuthController::class, 'prosesdaftar']);
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
    Route::get('/masterkaryawan/verify/{token}', [MasterInputanController::class, 'verify'])->name('verify');
});
Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('authpanel.login');
    })->name('/panel');
    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

// ROUTE AUTH
Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/{email}/updateprofile', [DashboardController::class, 'updateprofile']);
    Route::post('/profile/{email}/updateprofile2', [DashboardController::class, 'updateprofile2']);
    Route::post('/profile/{email}/updateprofile3', [DashboardController::class, 'updateprofile3']);
    Route::post('/daftartanya/storetanya', [DashboardController::class, 'storetanya'])->name('storetanya');

    // Taaruf
    Route::get('/taaruf', [DashboardController::class, 'taaruf'])->name('taaruf');
    Route::get('/taaruf/{email}/lihatprofile', [TaarufContoller::class, 'lihatprofile']);
    Route::post('/taaruf/progressprofile', [TaarufContoller::class, 'progressprofile']);

    // Progress
    Route::get('/progress', [ProgressController::class, 'index'])->name('progress');
    Route::get('/like/{id}', [ProgressController::class, 'like'])->name('like');
    Route::get('/dislike/{id}', [ProgressController::class, 'dislike'])->name('dislike');

    // Chat
    Route::get('/chat/{id}', [ChatController::class, 'chat'])->name('chat');
    Route::post('/chat/{id}/store', [ChatController::class, 'store'])->name('store');
    // Realtime chat fetch (AJAX)
Route::get('/chat/{id}/fetch', [ChatController::class, 'fetch'])->name('chat.fetch');


    // berita
    Route::get('/masterberita/berita/1', [MasterInputanController::class, 'berita1'])->name('berita1');
    Route::get('/masterberita/berita/2', [MasterInputanController::class, 'berita2'])->name('berita2');
    Route::get('/masterberita/berita/3', [MasterInputanController::class, 'berita3'])->name('berita3');
    Route::get('/masterberita/berita/4', [MasterInputanController::class, 'berita4'])->name('berita4');
});


Route::middleware(['auth:user'])->group(function () {
    Route::get('/dashboardadmin', [DashboardAdminController::class, 'index'])->name('dashboardadmin');
    Route::get('/daftartanya', [DashboardAdminController::class, 'daftartanya'])->name('daftartanya');
    Route::get('/prosestaaruf', [DashboardAdminController::class, 'prosestaaruf'])->name('prosestaaruf');
    Route::get('/prosescetak/{id}', [DashboardAdminController::class, 'prosescetak'])->name('prosescetak');
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('/masterkaryawan', [MasterInputanController::class, 'masterkaryawan'])->name('masterkaryawan');
    Route::get('/masterkaryawan/{id_karyawan}/verifikasi', [MasterInputanController::class, 'verifikasi'])->name('verifikasi');
    Route::post('/masterkaryawan/viewkaryawan', [MasterInputanController::class, 'viewkaryawan'])->name('viewkaryawan');

    Route::get('/masterberita', [MasterInputanController::class, 'masterberita'])->name('masterberita');
    Route::post('/masterberita/editberita', [MasterInputanController::class, 'editberita'])->name('editberita');
    Route::post('/masterberita/{id}/updateberita', [MasterInputanController::class, 'updateberita'])->name('updateberita');

    Route::get('/historychat/{id}', [ChatController::class, 'historychat'])->name('historychat');

    Route::get('/masteryoutube', [MasterInputanController::class, 'masteryoutube'])->name('masteryoutube');
    Route::post('/masteryoutube/edityoutube', [MasterInputanController::class, 'edityoutube'])->name('edityoutube');
    Route::post('/masteryoutube/{id}/updateyoutube', [MasterInputanController::class, 'updateyoutube'])->name('updateyoutube');
});
