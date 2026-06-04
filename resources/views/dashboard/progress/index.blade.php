@extends('dashboard.dashlayouts.topbarprogress')

<style>
    /* ===== COLOR VARIABLES ===== */
    :root {
        --primary-color: #0053C5;
        --primary-light: #0066FF;
        --primary-dark: #003D91;
        --success-color: #10B981;
        --danger-color: #EF4444;
        --warning-color: #F59E0B;
        --gray-100: #F8F9FA;
        --gray-200: #E9ECEF;
        --gray-300: #DEE2E6;
        --gray-600: #6C757D;
        --gray-700: #495057;
        --gray-800: #343A40;
        --white: #FFFFFF;
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    /* ===== GLOBAL STYLES ===== */
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    /* ===== HEADER SECTION ===== */
    .section.bg-info {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%) !important;
        padding: 1.5rem 0 1rem;
        margin-bottom: 0.5rem;
    }

    /* ===== PAGE CONTENT ===== */
    .page-content-wrapper {
        padding-top: 0.5rem !important;
        padding-bottom: 100px !important;
    }

    /* ===== ALERT MESSAGES ===== */
    .alert {
        border: none;
        border-radius: var(--radius-md);
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        animation: slideDown 0.3s ease;
    }

    .alert-light {
        background: rgba(16, 185, 129, 0.1);
        color: #065f46;
        border-left: 4px solid var(--success-color);
    }

    .alert-warning {
        background: rgba(245, 158, 11, 0.1);
        color: #92400e;
        border-left: 4px solid var(--warning-color);
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== NEW MATCH CARD STYLES ===== */
    .match-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        margin-bottom: 2.5rem;
        transition: transform 0.3s ease;
        border: 1px solid var(--gray-200);
    }
    
    .match-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    /* ===== HEADER MATCH INDICATOR ===== */
    .match-header {
        padding: 1rem 1.5rem;
        text-align: center;
        border-bottom: 1px solid var(--gray-200);
    }

    .match-header.success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        border-bottom: 2px solid var(--success-color);
    }

    .match-header.danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
        border-bottom: 2px solid var(--danger-color);
    }

    .match-header.warning {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.1) 100%);
        border-bottom: 2px solid var(--warning-color);
    }

    /* ===== PROFILE IMAGE ===== */
    .profile-image-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .profile-avatar {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--white);
        box-shadow: var(--shadow-md);
        transition: transform 0.3s ease;
    }

    .profile-card:hover .profile-avatar {
        transform: scale(1.05);
    }

    /* ===== STATUS BADGES ===== */
    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
        margin: 0.75rem 0;
        box-shadow: var(--shadow-sm);
        color: var(--white);
    }

    .badge-success { background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%); }
    .badge-primary { background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%); }
    .badge-secondary { background: linear-gradient(135deg, var(--gray-600) 0%, var(--gray-700) 100%); }
    .badge-danger { background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%); }
    .badge-pink { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); color: white; }

    /* ===== PROFILE NAME ===== */
    .profile-name {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--gray-800);
        margin: 0.75rem 0 0.5rem;
    }

    /* ===== ACTION BUTTONS ===== */
    .match-actions {
        padding: 1.5rem;
        background: var(--gray-50);
        border-top: 1px solid var(--gray-200);
    }

    .btn-action {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
        text-decoration: none;
    }

    .btn-action svg { width: 20px; height: 20px; }

    .btn-action.btn-success {
        background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
        color: var(--white);
    }

    .btn-action.btn-success:hover:not(.disabled) {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: var(--white);
    }

    .btn-action.btn-danger {
        background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
        color: var(--white);
    }

    .btn-action.btn-danger:hover:not(.disabled) {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: var(--white);
    }

    .btn-action.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: var(--gray-300) !important;
        color: var(--gray-600) !important;
        pointer-events: none;
    }

    /* ===== CHAT BUTTON ===== */
    .btn-chat {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
    }

    .btn-chat:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 83, 197, 0.3);
        color: var(--white);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .profile-avatar { width: 100px; height: 100px; }
        .profile-name { font-size: 1.1rem; }
        .btn-action { padding: 0.75rem 1rem; font-size: 0.95rem; width: 100%; justify-content: center; margin-bottom: 0.5rem; }
        .match-actions { display: flex; flex-direction: column; }
        .section.bg-info { margin-bottom: 0; padding: 1rem 0 0.5rem; }
        .match-header { padding: 0.75rem; }
        .match-header h4 { font-size: 1.1rem; }
        .match-card { margin-bottom: 1.5rem; }
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-md);
        margin: 2rem 0;
    }
</style>

<div class="section bg-info">
    <div class="container">
        <div class="row mt-5 pt-4 pt-md-0">
            <div class="col-12 text-center">
                <h2 style="color: white; font-weight: 800; margin: 0 0 0.5rem 0;">
                    💑 Status Progress Ta'aruf
                </h2>
                <p style="color: rgba(255,255,255,0.9); margin: 0;">
                    Lihat status perkembangan ta'aruf Anda
                </p>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container">
        
        <!-- Alert Messages -->
        @if (Session::get('success'))
            <div class="alert alert-light">
                <i class="fa fa-check-circle"></i>
                {{ Session::get('success') }}
            </div>
        @endif
        
        @if (Session::get('warning'))
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-triangle"></i>
                {{ Session::get('warning') }}
            </div>
        @endif

        @forelse ($dataprogress as $d)
            @php
                // Data berdasarkan email_auth (User Sendiri)
                $dataAuth = DB::table('karyawan')
                    ->leftJoin('progress', 'karyawan.email', '=', 'progress.email_auth')
                    ->leftJoin('likedislike', 'progress.email_auth', '=', 'likedislike.emailact')
                    ->where('progress.email_auth', $d->email_auth)
                    ->select('likedislike.status', 'karyawan.nama', 'karyawan.nip', 'karyawan.jenkel', 'karyawan.foto')
                    ->first();

                $pathAuth = isset($dataAuth) && !empty($dataAuth->foto) ? Storage::url('uploads/karyawan/img/' . $dataAuth->foto) : '';
                $defaultAvatarAuth = 'https://ui-avatars.com/api/?name=' . urlencode(isset($dataAuth) ? $dataAuth->nama : 'User') . '&background=random&color=fff&size=200';

                // Data berdasarkan email_profile (Pasangan)
                $dataProfile = DB::table('karyawan')
                    ->leftJoin('progress', 'karyawan.email', '=', 'progress.email_profile')
                    ->leftJoin('likedislike', 'progress.email_profile', '=', 'likedislike.emailact')
                    ->where('progress.email_profile', $d->email_profile)
                    ->select('likedislike.status', 'karyawan.nama', 'karyawan.nip', 'karyawan.jenkel', 'karyawan.foto', 'progress.id as progress_id')
                    ->first();

                $pathProfile = isset($dataProfile) && !empty($dataProfile->foto) ? Storage::url('uploads/karyawan/img/' . $dataProfile->foto) : '';
                $defaultAvatarProfile = 'https://ui-avatars.com/api/?name=' . urlencode(isset($dataProfile) ? $dataProfile->nama : 'User') . '&background=random&color=fff&size=200';

                // Status dari likedislike
                $likedislikeStatus = $likedislike
                    ->where('id_progress', $d->id)
                    ->where('emailact', Auth::guard('karyawan')->user()->email)
                    ->first();

                // Determine match status
                $bothLiked = (isset($dataAuth->status) && $dataAuth->status == 1) && 
                             (isset($dataProfile->status) && $dataProfile->status == 1);
                $anyDislike = (isset($dataAuth->status) && $dataAuth->status == 0) || 
                              (isset($dataProfile->status) && $dataProfile->status == 0);
            @endphp

            <!-- Match Card -->
            <div class="match-card">
                <!-- Match Indicator Header -->
                @if($bothLiked)
                    <div class="match-header success">
                        <h4 class="mb-0 fw-bold text-success"><i class="fa fa-heart"></i> Selamat! Kalian Saling Cocok!</h4>
                    </div>
                @elseif($anyDislike)
                    <div class="match-header danger">
                        <h4 class="mb-0 fw-bold text-danger"><i class="fa fa-heart-broken"></i> Mohon Maaf, Tidak Ada Kecocokan</h4>
                    </div>
                @else
                    <div class="match-header warning">
                        <h4 class="mb-0 fw-bold text-warning"><i class="fa fa-hourglass-half"></i> Menunggu Respon Pasangan</h4>
                    </div>
                @endif
                
                <div class="match-body d-flex flex-column flex-md-row align-items-center justify-content-around">
                    
                    <!-- Profil Anda -->
                    <div class="profile-card text-center w-100" style="max-width: 300px; z-index: 2;">
                        <span class="status-badge badge-primary px-3 py-2 mb-3 shadow-sm" style="border-radius: 30px;">👤 Profil Anda</span>
                        <div class="profile-image-wrapper mx-auto">
                            <img class="profile-avatar"
                                 src="{{ !empty($pathAuth) ? url($pathAuth) : $defaultAvatarAuth }}"
                                 alt="{{ isset($dataAuth) ? $dataAuth->nama : 'Avatar' }}">
                        </div>
                        
                        <h5 class="profile-name">{{ isset($dataAuth) ? $dataAuth->nama : '-' }}</h5>
                        <p class="text-muted small mb-2 fw-bold">NIP: {{ isset($dataAuth) ? $dataAuth->nip : '-' }}</p>
                        
                        <span class="status-badge  
                            @if(isset($dataAuth->status) && $dataAuth->status == 1) badge-success
                            @elseif(isset($dataAuth->status) && $dataAuth->status === 0) badge-danger
                            @else badge-secondary @endif">
                            @if(isset($dataAuth->status) && $dataAuth->status == 1)
                                <i class="fa fa-check"></i> Sudah Cocok
                            @elseif(isset($dataAuth->status) && $dataAuth->status === 0)
                                <i class="fa fa-times"></i> Tidak Cocok
                            @else
                                <i class="fa fa-clock-o"></i> On Progress
                            @endif
                        </span>
                    </div>
                    
                    <!-- VS Divider Icon -->
                    <div class="vs-divider my-4 my-md-0 shadow-sm flex-shrink-0 z-10">
                        <i class="fa fa-heart text-danger" style="font-size: 1.8rem; animation: pulse 2s infinite;"></i>
                    </div>

                    <!-- Profil Pasangan -->
                    <div class="profile-card text-center w-100" style="max-width: 300px; z-index: 2;">
                        <span class="status-badge badge-pink px-3 py-2 mb-3 shadow-sm" style="border-radius: 30px;">💕 Profil Pasangan</span>
                        <div class="profile-image-wrapper mx-auto">
                            <img class="profile-avatar"
                                 src="{{ !empty($pathProfile) ? url($pathProfile) : $defaultAvatarProfile }}"
                                 alt="{{ isset($dataProfile) ? $dataProfile->nama : 'Avatar' }}">
                        </div>
                        
                        <h5 class="profile-name">{{ isset($dataProfile) ? $dataProfile->nama : '-' }}</h5>
                        <p class="text-muted small mb-2 fw-bold">NIP: {{ isset($dataProfile) ? $dataProfile->nip : '-' }}</p>
                        
                        <span class="status-badge 
                            @if(isset($dataProfile->status) && $dataProfile->status == 1) badge-success
                            @elseif(isset($dataProfile->status) && $dataProfile->status === 0) badge-danger
                            @else badge-secondary @endif">
                            @if(isset($dataProfile->status) && $dataProfile->status == 1)
                                <i class="fa fa-check"></i> Merasa Cocok
                            @elseif(isset($dataProfile->status) && $dataProfile->status === 0)
                                <i class="fa fa-times"></i> Tidak Cocok
                            @else
                                <i class="fa fa-clock-o"></i> On Progress
                            @endif
                        </span>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="match-actions d-flex flex-wrap justify-content-center gap-3">
                    <a class="btn-action btn-success {{ $likedislikeStatus && $likedislikeStatus->status == 1 ? 'disabled' : '' }}"
                       href="{{ route('like', ['id' => isset($d->id) ? $d->id : 0]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
                        </svg>
                        <span>{{ $likedislikeStatus && $likedislikeStatus->status == 1 ? 'Sudah Menyukai' : 'Saya Cocok' }}</span>
                    </a>

                    <a class="btn-action btn-danger {{ $likedislikeStatus && $likedislikeStatus->status == 0 ? 'disabled' : '' }}"
                       href="{{ route('dislike', ['id' => isset($d->id) ? $d->id : 0]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heartbreak-fill" viewBox="0 0 16 16">
                            <path d="M8.931.586 7 3l1.5 4-2 3L8 15C22.534 5.396 13.757-2.21 8.931.586M7.358.77 5.5 3 7 7l-1.5 3 1.815 4.537C-6.533 4.96 2.685-2.467 7.358.77" />
                        </svg>
                        <span>{{ $likedislikeStatus && $likedislikeStatus->status == 0 ? 'Sudah Tidak Menyukai' : 'Tidak Cocok' }}</span>
                    </a>

                    <a class="btn-action btn-chat"
                       href="{{ route('chat', ['id' => isset($d->id) ? $d->id : 0]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-chat-left-dots-fill" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg>
                        <span>Mulai Chat</span>
                    </a>
                </div>
            </div>

        @empty
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fa fa-heart-broken text-danger" style="opacity: 0.5;"></i>
                </div>
                <h3>Belum Ada Progress</h3>
                <p>Anda belum memiliki progress ta'aruf saat ini.<br>Silakan ajukan progress dari halaman pencarian ta'aruf.</p>
            </div>
        @endforelse

    </div>
</div>

@extends('dashboard.dashlayouts.footer')
@extends('dashboard.dashlayouts.script')
@extends('dashboard.dashlayouts.header')