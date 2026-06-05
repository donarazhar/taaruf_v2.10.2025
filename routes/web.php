<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterInputanController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\TaarufContoller;
use App\Http\Controllers\MurobiController;
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
    Route::get('/daftar-email', function () {
        return view('auth.daftar_email');
    })->name('daftar.email');
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
    Route::get('/dashboard/berita/{slug}', [DashboardController::class, 'showBerita'])->name('dashboard.berita.show');
    Route::get('/dashboard/layanan/{slug}', [DashboardController::class, 'showLayanan'])->name('dashboard.layanan.show');

    // Notifications
    Route::get('/notifications/check', [DashboardController::class, 'checkNotifications'])->name('notifications.check');

    // Profile
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/{email}/updateprofile', [DashboardController::class, 'updateprofile']);
    Route::post('/profile/{email}/updateprofile2', [DashboardController::class, 'updateprofile2']);
    Route::post('/profile/{email}/updateprofile3', [DashboardController::class, 'updateprofile3']);
    Route::get('/profile/{email}/cetak-cv', [DashboardController::class, 'cetakCv'])->name('cetak.cv');
    Route::post('/daftartanya/storetanya', [DashboardController::class, 'storetanya'])->name('storetanya');
    Route::post('/dashboard/konsultasi', [DashboardController::class, 'storeKonsultasi'])->name('dashboard.konsultasi.store');

    // Menu Lain (Lainnya)
    Route::get('/lainnya', [DashboardController::class, 'lainnya'])->name('dashboard.lainnya');
    Route::get('/konsultasi', [DashboardController::class, 'konsultasi'])->name('dashboard.konsultasi');
    Route::get('/kandidat-harian', [DashboardController::class, 'kandidatHarian'])->name('dashboard.kandidat_harian');

    // Edukasi Pranikah
    Route::get('/edukasi', [DashboardController::class, 'edukasi'])->name('dashboard.edukasi');
    Route::post('/edukasi/{id}/daftar', [DashboardController::class, 'daftarEdukasi'])->name('dashboard.edukasi.daftar');

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



});


Route::middleware(['auth:user'])->group(function () {
    Route::get('/dashboardadmin', [DashboardAdminController::class, 'index'])->name('dashboardadmin');
    Route::get('/daftartanya', [DashboardAdminController::class, 'daftartanya'])->name('daftartanya');
    Route::get('/deletetanya/{id}', [DashboardAdminController::class, 'deletetanya'])->name('deletetanya');
    Route::get('/logchat', [DashboardAdminController::class, 'logchat'])->name('logchat');
    Route::get('/prosestaaruf', [DashboardAdminController::class, 'prosestaaruf'])->name('prosestaaruf');
    Route::get('/deleteprogress/{id}/{source}', [DashboardAdminController::class, 'deleteprogress'])->name('deleteprogress');
    Route::get('/prosescetak/{id}', [DashboardAdminController::class, 'prosescetak'])->name('prosescetak');
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('/masterkaryawan', [MasterInputanController::class, 'masterkaryawan'])->name('masterkaryawan');
    Route::get('/masterkaryawan/{id_karyawan}/verifikasi', [MasterInputanController::class, 'verifikasi'])->name('verifikasi');
    Route::post('/masterkaryawan/viewkaryawan', [MasterInputanController::class, 'viewkaryawan'])->name('viewkaryawan');
    Route::post('/masterkaryawan/resetpassword', [MasterInputanController::class, 'resetPassword'])->name('resetpassword');
    Route::get('/masterkaryawan/delete/{id}', [MasterInputanController::class, 'deletekaryawan'])->name('deletekaryawan');

    // Manajemen Admin
    Route::get('/masteradmin', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('masteradmin');
    Route::post('/masteradmin/store', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('masteradmin.store');
    Route::post('/masteradmin/update', [\App\Http\Controllers\AdminUserController::class, 'update'])->name('masteradmin.update');
    Route::get('/masteradmin/delete/{id}', [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('masteradmin.delete');
    
    Route::get('/historychat/{id}', [ChatController::class, 'historychat'])->name('historychat');
    Route::get('/deletehistorychat/{id}', [ChatController::class, 'deletehistorychat'])->name('deletehistorychat');

    // Murobi Routes
    Route::get('/murobi/taaruf', [MurobiController::class, 'taaruf'])->name('murobi.taaruf');
    Route::get('/murobi/taaruf/{email}/lihatprofile', [MurobiController::class, 'lihatprofile'])->name('murobi.lihatprofile');
    Route::get('/murobi/progress', [MurobiController::class, 'progress'])->name('murobi.progress');
    Route::post('/murobi/progress/store', [MurobiController::class, 'storeProgress'])->name('murobi.progress.store');
    
    // Murobi Konsultasi
    Route::get('/murobi/konsultasi', [MurobiController::class, 'konsultasi'])->name('murobi.konsultasi');
    Route::post('/murobi/konsultasi/update/{id}', [MurobiController::class, 'updateKonsultasi'])->name('murobi.konsultasi.update');

    // Murobi Edukasi
    Route::get('/murobi/edukasi', [MurobiController::class, 'edukasi'])->name('murobi.edukasi');
    Route::post('/murobi/edukasi/store', [MurobiController::class, 'storeEdukasi'])->name('murobi.edukasi.store');
    Route::post('/murobi/edukasi/update/{id}', [MurobiController::class, 'updateEdukasi'])->name('murobi.edukasi.update');
    Route::get('/murobi/edukasi/delete/{id}', [MurobiController::class, 'deleteEdukasi'])->name('murobi.edukasi.delete');

});

/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
|
| Redirect all unregistered routes to the root (/) page.
|
*/
Route::fallback(function () {
    return redirect('/');
});
