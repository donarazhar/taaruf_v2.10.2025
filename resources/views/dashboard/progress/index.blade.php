@extends('dashboard.dashlayouts.style')
@section('content')

    @push('styles')
    <style>
        /* ===== PROGRESS PAGE STYLES ===== */

        /* --- Hero Section --- */
        .progress-hero {
            position: relative;
            border-radius: var(--radius-xl);
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 50%, #001a4d 100%);
            padding: 2.5rem 2rem;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        .progress-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .progress-hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .progress-hero .hero-content {
            position: relative;
            z-index: 2;
        }

        .progress-hero .hero-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7);
            margin-bottom: 1rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .progress-hero .hero-breadcrumb:hover {
            color: #fff;
        }

        .progress-hero h1 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .progress-hero .hero-subtitle {
            font-size: 0.95rem;
            opacity: 0.85;
            font-weight: 400;
            max-width: 500px;
            line-height: 1.6;
        }

        .progress-hero .hero-icon-deco {
            position: absolute;
            right: 2rem;
            bottom: 1.5rem;
            font-size: 6rem;
            opacity: 0.08;
            z-index: 1;
        }

        .progress-hero .hero-stats {
            display: flex;
            gap: 1.5rem;
            margin-top: 1.25rem;
        }

        .progress-hero .hero-stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.8);
        }

        .progress-hero .hero-stat-item i {
            font-size: 1rem;
        }

        @media (max-width: 576px) {
            .progress-hero {
                padding: 1.75rem 1.25rem;
                border-radius: var(--radius-lg);
            }
            .progress-hero h1 {
                font-size: 1.35rem;
            }
            .progress-hero .hero-subtitle {
                font-size: 0.85rem;
            }
            .progress-hero .hero-icon-deco {
                font-size: 4rem;
                right: 1rem;
                bottom: 1rem;
            }
            .progress-hero .hero-stats {
                gap: 1rem;
                flex-wrap: wrap;
            }
        }

        /* --- Alert Styles --- */
        .progress-alert {
            border: none;
            border-radius: var(--radius-sm);
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.25rem;
            animation: progressAlertSlide 0.4s ease-out;
        }

        @keyframes progressAlertSlide {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .progress-alert.alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #065F46;
            border-left: 4px solid var(--success-color);
        }

        .progress-alert.alert-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #92400E;
            border-left: 4px solid var(--warning-color);
        }

        body.dark-mode .progress-alert.alert-success {
            background: rgba(16, 185, 129, 0.15);
            color: #6EE7B7;
        }

        body.dark-mode .progress-alert.alert-warning {
            background: rgba(245, 158, 11, 0.15);
            color: #FCD34D;
        }

        /* --- Match Card --- */
        .progress-match-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            margin-bottom: 1.25rem;
            transition: box-shadow 0.3s ease;
        }

        .progress-match-card:hover {
            box-shadow: var(--shadow-md);
        }

        /* --- Match Status Header --- */
        .progress-match-header {
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .progress-match-header i {
            font-size: 1.1rem;
        }

        .progress-match-header.status-matched {
            background: rgba(16, 185, 129, 0.08);
            color: #047857;
            border-bottom: 3px solid var(--success-color);
        }

        .progress-match-header.status-rejected {
            background: rgba(239, 68, 68, 0.08);
            color: #991B1B;
            border-bottom: 3px solid var(--danger-color);
        }

        .progress-match-header.status-waiting {
            background: rgba(245, 158, 11, 0.08);
            color: #92400E;
            border-bottom: 3px solid var(--warning-color);
        }

        body.dark-mode .progress-match-header.status-matched {
            background: rgba(16, 185, 129, 0.12);
            color: #6EE7B7;
        }

        body.dark-mode .progress-match-header.status-rejected {
            background: rgba(239, 68, 68, 0.12);
            color: #FCA5A5;
        }

        body.dark-mode .progress-match-header.status-waiting {
            background: rgba(245, 158, 11, 0.12);
            color: #FCD34D;
        }

        /* --- Profiles Section --- */
        .progress-profiles {
            padding: 2rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
        }

        @media (max-width: 768px) {
            .progress-profiles {
                flex-direction: column;
                padding: 1.5rem 1.25rem;
                gap: 1rem;
            }
        }

        /* --- Profile Card --- */
        .progress-profile {
            text-align: center;
            flex: 1;
            max-width: 280px;
        }

        .progress-profile-label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 1rem;
        }

        .progress-profile-label.label-you {
            background: rgba(0, 83, 197, 0.08);
            color: var(--primary-color);
        }

        .progress-profile-label.label-partner {
            background: rgba(236, 72, 153, 0.08);
            color: #DB2777;
        }

        .progress-avatar-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 0.75rem;
        }

        .progress-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .progress-match-card:hover .progress-avatar {
            border-color: var(--primary-color);
            transform: scale(1.03);
        }

        .progress-profile-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0 0 4px 0;
        }

        .progress-profile-nip {
            font-size: 0.78rem;
            color: var(--gray-500);
            font-weight: 500;
            margin: 0 0 10px 0;
        }

        /* --- Status Badge --- */
        .progress-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .progress-status-badge.badge-liked {
            background: rgba(16, 185, 129, 0.1);
            color: #047857;
        }

        .progress-status-badge.badge-disliked {
            background: rgba(239, 68, 68, 0.1);
            color: #991B1B;
        }

        .progress-status-badge.badge-pending {
            background: var(--gray-100);
            color: var(--gray-600);
        }

        body.dark-mode .progress-status-badge.badge-liked {
            background: rgba(16, 185, 129, 0.15);
            color: #6EE7B7;
        }

        body.dark-mode .progress-status-badge.badge-disliked {
            background: rgba(239, 68, 68, 0.15);
            color: #FCA5A5;
        }

        /* --- VS Divider --- */
        .progress-vs-divider {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--white);
            border: 2px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
            z-index: 2;
        }

        .progress-vs-divider i {
            font-size: 1.4rem;
            color: #EF4444;
            animation: progressHeartPulse 2s infinite;
        }

        @keyframes progressHeartPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        /* --- Action Buttons --- */
        .progress-actions {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--gray-200);
            background: var(--gray-50);
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        body.dark-mode .progress-actions {
            background: var(--gray-100);
        }

        .progress-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .progress-btn.btn-like {
            background: var(--success-color);
            color: #fff;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.25);
        }

        .progress-btn.btn-like:hover:not(.btn-disabled) {
            background: #059669;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
            transform: translateY(-1px);
            color: #fff;
        }

        .progress-btn.btn-dislike {
            background: var(--danger-color);
            color: #fff;
            box-shadow: 0 4px 14px rgba(239, 68, 68, 0.25);
        }

        .progress-btn.btn-dislike:hover:not(.btn-disabled) {
            background: #DC2626;
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.35);
            transform: translateY(-1px);
            color: #fff;
        }

        .progress-btn.btn-chat {
            background: var(--primary-color);
            color: #fff;
            box-shadow: 0 4px 14px rgba(0, 83, 197, 0.25);
        }

        .progress-btn.btn-chat:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 20px rgba(0, 83, 197, 0.35);
            transform: translateY(-1px);
            color: #fff;
            text-decoration: none;
        }

        .progress-btn.btn-disabled {
            opacity: 0.45;
            cursor: not-allowed;
            background: var(--gray-300) !important;
            color: var(--gray-600) !important;
            box-shadow: none !important;
            pointer-events: none;
        }

        .progress-btn i,
        .progress-btn svg {
            font-size: 1rem;
        }

        .progress-btn svg {
            width: 16px;
            height: 16px;
        }

        @media (max-width: 576px) {
            .progress-actions {
                flex-direction: column;
                padding: 1rem 1.25rem;
            }
            .progress-btn {
                width: 100%;
                justify-content: center;
                padding: 12px;
            }
        }

        /* --- Empty State --- */
        .progress-empty {
            text-align: center;
            padding: 3.5rem 1.5rem;
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 2px dashed var(--gray-200);
        }

        .progress-empty-icon {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .progress-empty-icon i {
            font-size: 2.2rem;
            color: var(--gray-400);
        }

        .progress-empty h5 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .progress-empty p {
            font-size: 0.875rem;
            color: var(--gray-500);
            margin: 0 auto 1.5rem;
            max-width: 380px;
            line-height: 1.6;
        }

        .progress-btn-taaruf {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border: none;
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            color: #fff;
            background: var(--primary-color);
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(0, 83, 197, 0.25);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .progress-btn-taaruf:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 20px rgba(0, 83, 197, 0.35);
            transform: translateY(-2px);
            color: #fff;
            text-decoration: none;
        }

        /* --- Stagger Animation --- */
        .progress-stagger > * {
            opacity: 0;
            transform: translateY(20px);
            animation: progressStaggerIn 0.5s ease-out forwards;
        }

        .progress-stagger > *:nth-child(1) { animation-delay: 0.05s; }
        .progress-stagger > *:nth-child(2) { animation-delay: 0.15s; }
        .progress-stagger > *:nth-child(3) { animation-delay: 0.25s; }
        .progress-stagger > *:nth-child(4) { animation-delay: 0.35s; }
        .progress-stagger > *:nth-child(5) { animation-delay: 0.45s; }

        @keyframes progressStaggerIn {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @endpush

    <div class="container pt-4 pb-5">

        <!-- Hero Section -->
        <div class="progress-hero">
            <div class="hero-content">
                <a href="{{ route('taaruf') }}" class="hero-breadcrumb">
                    <i class="bi bi-arrow-left"></i> Kembali ke Ta'aruf
                </a>
                <h1>Status Progress Ta'aruf</h1>
                <p class="hero-subtitle">Pantau perkembangan proses ta'aruf Anda. Lihat status kecocokan dan mulai komunikasi dengan pasangan.</p>

                <div class="hero-stats">
                    <div class="hero-stat-item">
                        <i class="bi bi-heart-fill"></i>
                        <span>{{ $dataprogress->count() }} Progress Aktif</span>
                    </div>
                    <div class="hero-stat-item">
                        <i class="bi bi-person-check-fill"></i>
                        <span>{{ $karyawan->nama }}</span>
                    </div>
                </div>
            </div>
            <i class="bi bi-hearts hero-icon-deco"></i>
        </div>

        <!-- Alerts -->
        @if (Session::get('success'))
            <div class="progress-alert alert-success" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ Session::get('success') }}</span>
            </div>
        @endif

        @if (Session::get('warning'))
            <div class="progress-alert alert-warning" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ Session::get('warning') }}</span>
            </div>
        @endif

        <!-- Match Cards -->
        <div class="progress-stagger">
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
            <div class="progress-match-card">
                <!-- Match Status Header -->
                @if($bothLiked)
                    <div class="progress-match-header status-matched">
                        <i class="bi bi-heart-fill"></i>
                        <span>Selamat! Kalian Saling Cocok!</span>
                    </div>
                @elseif($anyDislike)
                    <div class="progress-match-header status-rejected">
                        <i class="bi bi-heartbreak-fill"></i>
                        <span>Mohon Maaf, Tidak Ada Kecocokan</span>
                    </div>
                @else
                    <div class="progress-match-header status-waiting">
                        <i class="bi bi-hourglass-split"></i>
                        <span>Menunggu Respon Pasangan</span>
                    </div>
                @endif

                <!-- Profiles -->
                <div class="progress-profiles">
                    <!-- Your Profile -->
                    <div class="progress-profile">
                        <span class="progress-profile-label label-you">
                            <i class="bi bi-person-fill"></i> Profil Anda
                        </span>
                        <div class="progress-avatar-wrapper">
                            <img class="progress-avatar"
                                 src="{{ !empty($pathAuth) ? url($pathAuth) : $defaultAvatarAuth }}"
                                 alt="{{ isset($dataAuth) ? $dataAuth->nama : 'Avatar' }}">
                        </div>
                        <h5 class="progress-profile-name">{{ isset($dataAuth) ? $dataAuth->nama : '-' }}</h5>
                        <p class="progress-profile-nip">NIP: {{ isset($dataAuth) ? $dataAuth->nip : '-' }}</p>
                        <span class="progress-status-badge
                            @if(isset($dataAuth->status) && $dataAuth->status == 1) badge-liked
                            @elseif(isset($dataAuth->status) && $dataAuth->status === 0) badge-disliked
                            @else badge-pending @endif">
                            @if(isset($dataAuth->status) && $dataAuth->status == 1)
                                <i class="bi bi-check-circle-fill"></i> Sudah Cocok
                            @elseif(isset($dataAuth->status) && $dataAuth->status === 0)
                                <i class="bi bi-x-circle-fill"></i> Tidak Cocok
                            @else
                                <i class="bi bi-clock"></i> On Progress
                            @endif
                        </span>
                    </div>

                    <!-- VS Divider -->
                    <div class="progress-vs-divider">
                        <i class="bi bi-heart-fill"></i>
                    </div>

                    <!-- Partner Profile -->
                    <div class="progress-profile">
                        <span class="progress-profile-label label-partner">
                            <i class="bi bi-heart-fill"></i> Profil Pasangan
                        </span>
                        <div class="progress-avatar-wrapper">
                            <img class="progress-avatar"
                                 src="{{ !empty($pathProfile) ? url($pathProfile) : $defaultAvatarProfile }}"
                                 alt="{{ isset($dataProfile) ? $dataProfile->nama : 'Avatar' }}">
                        </div>
                        <h5 class="progress-profile-name">{{ isset($dataProfile) ? $dataProfile->nama : '-' }}</h5>
                        <p class="progress-profile-nip">NIP: {{ isset($dataProfile) ? $dataProfile->nip : '-' }}</p>
                        <span class="progress-status-badge
                            @if(isset($dataProfile->status) && $dataProfile->status == 1) badge-liked
                            @elseif(isset($dataProfile->status) && $dataProfile->status === 0) badge-disliked
                            @else badge-pending @endif">
                            @if(isset($dataProfile->status) && $dataProfile->status == 1)
                                <i class="bi bi-check-circle-fill"></i> Merasa Cocok
                            @elseif(isset($dataProfile->status) && $dataProfile->status === 0)
                                <i class="bi bi-x-circle-fill"></i> Tidak Cocok
                            @else
                                <i class="bi bi-clock"></i> On Progress
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="progress-actions">
                    <form action="{{ route('like', ['id' => isset($d->id) ? $d->id : 0]) }}" method="POST" style="flex: 1; display: flex;">
                        @csrf
                        <button type="submit" class="progress-btn btn-like {{ $likedislikeStatus && $likedislikeStatus->status == 1 ? 'btn-disabled' : '' }}" style="width: 100%; border: none;">
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                            <span>{{ $likedislikeStatus && $likedislikeStatus->status == 1 ? 'Sudah Menyukai' : 'Saya Cocok' }}</span>
                        </button>
                    </form>

                    <form action="{{ route('dislike', ['id' => isset($d->id) ? $d->id : 0]) }}" method="POST" style="flex: 1; display: flex;">
                        @csrf
                        <button type="submit" class="progress-btn btn-dislike {{ $likedislikeStatus && $likedislikeStatus->status == 0 ? 'btn-disabled' : '' }}" style="width: 100%; border: none;">
                            <i class="bi bi-heartbreak-fill"></i>
                            <span>{{ $likedislikeStatus && $likedislikeStatus->status == 0 ? 'Sudah Tidak Menyukai' : 'Tidak Cocok' }}</span>
                        </button>
                    </form>

                    <a class="progress-btn btn-chat"
                       href="{{ route('chat', ['id' => isset($d->id) ? $d->id : 0]) }}">
                        <i class="bi bi-chat-dots-fill"></i>
                        <span>Mulai Chat</span>
                    </a>
                </div>
            </div>

        @empty
            <!-- Empty State -->
            <div class="progress-empty">
                <div class="progress-empty-icon">
                    <i class="bi bi-heart"></i>
                </div>
                <h5>Belum Ada Progress</h5>
                <p>Anda belum memiliki progress ta'aruf saat ini. Silakan ajukan progress dari halaman pencarian ta'aruf.</p>
                <a href="{{ route('taaruf') }}" class="progress-btn-taaruf">
                    <i class="bi bi-search-heart"></i>
                    Cari Pasangan di Ta'aruf
                </a>
            </div>
        @endforelse
        </div>

    </div>

@endsection