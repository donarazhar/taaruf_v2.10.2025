@extends('dashboard.dashlayouts.style')
@section('content')

    @push('styles')
    <style>
        /* ===== KONSULTASI PAGE STYLES ===== */

        /* --- Hero Section --- */
        .konsultasi-hero {
            position: relative;
            border-radius: var(--radius-xl);
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 50%, #001a4d 100%);
            padding: 2.5rem 2rem;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        .konsultasi-hero::before {
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

        .konsultasi-hero::after {
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

        .konsultasi-hero .hero-content {
            position: relative;
            z-index: 2;
        }

        .konsultasi-hero .hero-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7);
            margin-bottom: 1rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .konsultasi-hero .hero-breadcrumb:hover {
            color: #fff;
        }

        .konsultasi-hero h1 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .konsultasi-hero .hero-subtitle {
            font-size: 0.95rem;
            opacity: 0.85;
            font-weight: 400;
            max-width: 500px;
            line-height: 1.6;
        }

        .konsultasi-hero .hero-icon-deco {
            position: absolute;
            right: 2rem;
            bottom: 1.5rem;
            font-size: 6rem;
            opacity: 0.08;
            z-index: 1;
        }

        .konsultasi-hero .hero-stats {
            display: flex;
            gap: 1.5rem;
            margin-top: 1.25rem;
        }

        .konsultasi-hero .hero-stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.8);
        }

        .konsultasi-hero .hero-stat-item i {
            font-size: 1rem;
        }

        @media (max-width: 576px) {
            .konsultasi-hero {
                padding: 1.75rem 1.25rem;
                border-radius: var(--radius-lg);
            }
            .konsultasi-hero h1 {
                font-size: 1.35rem;
            }
            .konsultasi-hero .hero-subtitle {
                font-size: 0.85rem;
            }
            .konsultasi-hero .hero-icon-deco {
                font-size: 4rem;
                right: 1rem;
                bottom: 1rem;
            }
            .konsultasi-hero .hero-stats {
                gap: 1rem;
                flex-wrap: wrap;
            }
        }

        /* --- Alert Styles --- */
        .konsultasi-alert {
            border: none;
            border-radius: var(--radius-sm);
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.25rem;
            animation: konsultasiAlertSlideIn 0.4s ease-out;
        }

        @keyframes konsultasiAlertSlideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .konsultasi-alert.alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #065F46;
            border-left: 4px solid var(--success-color);
        }

        .konsultasi-alert.alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #991B1B;
            border-left: 4px solid var(--danger-color);
        }

        body.dark-mode .konsultasi-alert.alert-success {
            background: rgba(16, 185, 129, 0.15);
            color: #6EE7B7;
        }

        body.dark-mode .konsultasi-alert.alert-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #FCA5A5;
        }

        /* --- Layout Grid --- */
        .konsultasi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            align-items: start;
        }

        @media (max-width: 991px) {
            .konsultasi-grid {
                grid-template-columns: 1fr;
            }
        }

        /* --- Card Panel --- */
        .konsultasi-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        .konsultasi-card:hover {
            box-shadow: var(--shadow-md);
        }

        .konsultasi-card-accent {
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .konsultasi-card-body {
            padding: 1.75rem;
        }

        @media (max-width: 576px) {
            .konsultasi-card-body {
                padding: 1.25rem;
            }
        }

        /* --- Card Header --- */
        .konsultasi-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 0.5rem;
        }

        .konsultasi-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.2rem;
        }

        .konsultasi-card-icon.form-icon {
            background: rgba(0, 83, 197, 0.1);
            color: var(--primary-color);
        }

        .konsultasi-card-icon.history-icon {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .konsultasi-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0;
            line-height: 1.3;
        }

        .konsultasi-card-desc {
            font-size: 0.85rem;
            color: var(--gray-500);
            margin: 0 0 1.5rem 0;
            padding-left: 62px;
            line-height: 1.6;
        }

        @media (max-width: 576px) {
            .konsultasi-card-desc {
                padding-left: 0;
                margin-top: 0.5rem;
            }
        }

        /* --- Form Styles --- */
        .konsultasi-form .form-group {
            margin-bottom: 1.25rem;
        }

        .konsultasi-form .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--gray-700);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .konsultasi-form .form-select,
        .konsultasi-form .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--gray-200);
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: var(--gray-900);
            background: var(--white);
            transition: all 0.3s ease;
            outline: none;
        }

        .konsultasi-form .form-select:focus,
        .konsultasi-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(0, 83, 197, 0.08);
        }

        .konsultasi-form .form-control::placeholder {
            color: var(--gray-400);
        }

        .konsultasi-form textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .konsultasi-form .form-hint {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            color: var(--gray-400);
            margin-top: 6px;
        }

        .konsultasi-form .form-hint i {
            font-size: 0.8rem;
        }

        .konsultasi-btn-submit {
            width: 100%;
            padding: 14px 24px;
            border: none;
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: var(--primary-color);
            color: #fff;
            box-shadow: 0 4px 14px rgba(0, 83, 197, 0.25);
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .konsultasi-btn-submit:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 20px rgba(0, 83, 197, 0.35);
            transform: translateY(-2px);
        }

        .konsultasi-btn-submit:active {
            transform: translateY(0);
        }

        /* --- Tips Box --- */
        .konsultasi-tips {
            background: rgba(59, 130, 246, 0.06);
            border: 1px solid rgba(59, 130, 246, 0.12);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-top: 1.5rem;
        }

        .konsultasi-tips-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--info-color);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .konsultasi-tips ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .konsultasi-tips li {
            font-size: 0.8rem;
            color: var(--gray-600);
            padding: 3px 0;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            line-height: 1.5;
        }

        .konsultasi-tips li::before {
            content: '•';
            color: var(--info-color);
            font-weight: 700;
            flex-shrink: 0;
            margin-top: 1px;
        }

        body.dark-mode .konsultasi-tips {
            background: rgba(59, 130, 246, 0.08);
            border-color: rgba(59, 130, 246, 0.15);
        }

        /* --- History Section --- */
        .konsultasi-history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .konsultasi-history-count {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-500);
            background: var(--gray-100);
            padding: 4px 12px;
            border-radius: 20px;
        }

        .konsultasi-history-scroll {
            max-height: 520px;
            overflow-y: auto;
            padding-right: 6px;
        }

        .konsultasi-history-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .konsultasi-history-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .konsultasi-history-scroll::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 4px;
        }

        .konsultasi-history-scroll::-webkit-scrollbar-thumb:hover {
            background: var(--gray-400);
        }

        /* --- History Item --- */
        .konsultasi-item {
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            padding: 1.25rem;
            margin-bottom: 0.75rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .konsultasi-item:hover {
            border-color: rgba(0, 83, 197, 0.15);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .konsultasi-item:last-child {
            margin-bottom: 0;
        }

        .konsultasi-item-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 8px;
        }

        .konsultasi-item-topik {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0;
            line-height: 1.4;
        }

        .konsultasi-item-pesan {
            font-size: 0.83rem;
            color: var(--gray-600);
            line-height: 1.6;
            margin: 0 0 10px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .konsultasi-item-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .konsultasi-item-date {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.78rem;
            color: var(--gray-500);
            font-weight: 500;
        }

        .konsultasi-item-date i {
            font-size: 0.8rem;
            color: var(--gray-400);
        }

        /* --- Status Badges --- */
        .konsultasi-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: capitalize;
            letter-spacing: 0.02em;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .konsultasi-badge.badge-menunggu {
            background: rgba(245, 158, 11, 0.12);
            color: #B45309;
        }

        .konsultasi-badge.badge-dijadwalkan {
            background: rgba(0, 83, 197, 0.1);
            color: var(--primary-color);
        }

        .konsultasi-badge.badge-selesai {
            background: rgba(16, 185, 129, 0.1);
            color: #047857;
        }

        body.dark-mode .konsultasi-badge.badge-menunggu {
            background: rgba(245, 158, 11, 0.18);
            color: #FCD34D;
        }

        body.dark-mode .konsultasi-badge.badge-dijadwalkan {
            background: rgba(59, 130, 246, 0.18);
            color: #93C5FD;
        }

        body.dark-mode .konsultasi-badge.badge-selesai {
            background: rgba(16, 185, 129, 0.18);
            color: #6EE7B7;
        }

        /* --- Murobi Reply --- */
        .konsultasi-reply {
            margin-top: 10px;
            padding: 12px 14px;
            background: rgba(16, 185, 129, 0.06);
            border: 1px solid rgba(16, 185, 129, 0.12);
            border-radius: 10px;
            position: relative;
        }

        .konsultasi-reply::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--success-color);
            border-radius: 3px 0 0 3px;
        }

        .konsultasi-reply-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--success-color);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .konsultasi-reply-text {
            font-size: 0.83rem;
            color: var(--gray-700);
            line-height: 1.6;
            margin: 0;
        }

        body.dark-mode .konsultasi-reply {
            background: rgba(16, 185, 129, 0.08);
            border-color: rgba(16, 185, 129, 0.15);
        }

        /* --- Empty State --- */
        .konsultasi-empty {
            text-align: center;
            padding: 3rem 1.5rem;
        }

        .konsultasi-empty-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
        }

        .konsultasi-empty-icon i {
            font-size: 2rem;
            color: var(--gray-400);
        }

        .konsultasi-empty h6 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .konsultasi-empty p {
            font-size: 0.85rem;
            color: var(--gray-500);
            margin: 0 auto;
            max-width: 280px;
            line-height: 1.6;
        }

        /* --- Stagger Animation --- */
        .konsultasi-stagger > * {
            opacity: 0;
            transform: translateY(20px);
            animation: konsultasiStaggerIn 0.5s ease-out forwards;
        }

        .konsultasi-stagger > *:nth-child(1) { animation-delay: 0.05s; }
        .konsultasi-stagger > *:nth-child(2) { animation-delay: 0.1s; }
        .konsultasi-stagger > *:nth-child(3) { animation-delay: 0.15s; }
        .konsultasi-stagger > *:nth-child(4) { animation-delay: 0.2s; }
        .konsultasi-stagger > *:nth-child(5) { animation-delay: 0.25s; }
        .konsultasi-stagger > *:nth-child(6) { animation-delay: 0.3s; }
        .konsultasi-stagger > *:nth-child(7) { animation-delay: 0.35s; }
        .konsultasi-stagger > *:nth-child(8) { animation-delay: 0.4s; }

        @keyframes konsultasiStaggerIn {
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Fade-in for grid panels --- */
        .konsultasi-grid > * {
            opacity: 0;
            animation: konsultasiGridIn 0.6s ease-out forwards;
        }

        .konsultasi-grid > *:nth-child(1) { animation-delay: 0.1s; }
        .konsultasi-grid > *:nth-child(2) { animation-delay: 0.25s; }

        @keyframes konsultasiGridIn {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @endpush

    <div class="container pt-4 pb-5">

        <!-- Hero Section -->
        <div class="konsultasi-hero">
            <div class="hero-content">
                <a href="{{ route('dashboard.lainnya') }}" class="hero-breadcrumb">
                    <i class="bi bi-arrow-left"></i> Kembali ke Menu
                </a>
                <h1>Konsultasi Murobbi</h1>
                <p class="hero-subtitle">Diskusikan persiapan, kriteria pasangan, atau hal lain seputar ta'aruf dengan bimbingan Murobbi yang berpengalaman.</p>

                <div class="hero-stats">
                    <div class="hero-stat-item">
                        <i class="bi bi-chat-dots-fill"></i>
                        <span>Konsultasi Pribadi</span>
                    </div>
                    <div class="hero-stat-item">
                        <i class="bi bi-shield-check"></i>
                        <span>Terjaga Kerahasiaannya</span>
                    </div>
                </div>
            </div>
            <i class="bi bi-chat-heart-fill hero-icon-deco"></i>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="konsultasi-alert alert-success" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="konsultasi-alert alert-danger" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- Main Grid -->
        <div class="konsultasi-grid">

            <!-- Form Panel -->
            <div class="konsultasi-card">
                <div class="konsultasi-card-accent"></div>
                <div class="konsultasi-card-body">
                    <div class="konsultasi-card-header">
                        <div class="konsultasi-card-icon form-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h5 class="konsultasi-card-title">Ajukan Konsultasi</h5>
                    </div>
                    <p class="konsultasi-card-desc">Sampaikan topik dan pesan Anda, Murobbi akan merespons pengajuan ini.</p>

                    <form action="{{ route('dashboard.konsultasi.store') }}" method="POST" class="konsultasi-form">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Topik Konsultasi</label>
                            <select name="topik_konsultasi" class="form-select" required>
                                <option value="">Pilih Topik...</option>
                                <option value="Saran Pemilihan Calon">Saran Pemilihan Calon</option>
                                <option value="Persiapan Ta'aruf">Persiapan Ta'aruf</option>
                                <option value="Diskusi Kriteria">Diskusi Kriteria Pasangan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Pesan Tambahan</label>
                            <textarea name="pesan" rows="5" class="form-control" placeholder="Jelaskan secara singkat apa yang ingin didiskusikan..." required></textarea>
                            <div class="form-hint">
                                <i class="bi bi-info-circle"></i>
                                <span>Tulis pesan Anda sejelas mungkin agar Murobbi lebih mudah memahami.</span>
                            </div>
                        </div>

                        <button type="submit" class="konsultasi-btn-submit">
                            <i class="bi bi-send-fill"></i>
                            Kirim Pengajuan Konsultasi
                        </button>
                    </form>

                    <!-- Tips Box -->
                    <div class="konsultasi-tips">
                        <div class="konsultasi-tips-title">
                            <i class="bi bi-lightbulb-fill"></i> Tips Konsultasi
                        </div>
                        <ul>
                            <li>Pilih topik yang paling sesuai dengan kebutuhan Anda</li>
                            <li>Jelaskan situasi Anda secara ringkas namun jelas</li>
                            <li>Murobbi akan membalas melalui pesan balasan di riwayat</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- History Panel -->
            <div class="konsultasi-card">
                <div class="konsultasi-card-accent" style="background: linear-gradient(90deg, var(--warning-color), #FBBF24);"></div>
                <div class="konsultasi-card-body">
                    <div class="konsultasi-card-header">
                        <div class="konsultasi-card-icon history-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h5 class="konsultasi-card-title">Riwayat Konsultasi</h5>
                    </div>

                    @if(isset($riwayatKonsultasi) && $riwayatKonsultasi->count() > 0)
                        <div class="konsultasi-history-header">
                            <span class="konsultasi-item-date" style="font-size: 0.82rem; color: var(--gray-600);">
                                <i class="bi bi-journal-text"></i> Semua pengajuan Anda
                            </span>
                            <span class="konsultasi-history-count">{{ $riwayatKonsultasi->count() }} pengajuan</span>
                        </div>

                        <div class="konsultasi-history-scroll konsultasi-stagger">
                            @foreach($riwayatKonsultasi as $konsultasi)
                                <div class="konsultasi-item">
                                    <div class="konsultasi-item-header">
                                        <h6 class="konsultasi-item-topik">{{ $konsultasi->topik_konsultasi }}</h6>
                                        @php
                                            $badgeClass = match($konsultasi->status) {
                                                'menunggu' => 'badge-menunggu',
                                                'dijadwalkan' => 'badge-dijadwalkan',
                                                default => 'badge-selesai',
                                            };
                                            $badgeIcon = match($konsultasi->status) {
                                                'menunggu' => 'bi-hourglass-split',
                                                'dijadwalkan' => 'bi-calendar-check',
                                                default => 'bi-check-circle-fill',
                                            };
                                        @endphp
                                        <span class="konsultasi-badge {{ $badgeClass }}">
                                            <i class="bi {{ $badgeIcon }}"></i>
                                            {{ ucfirst($konsultasi->status) }}
                                        </span>
                                    </div>

                                    @if(!empty($konsultasi->pesan))
                                    <p class="konsultasi-item-pesan">{{ $konsultasi->pesan }}</p>
                                    @endif

                                    <div class="konsultasi-item-meta">
                                        <span class="konsultasi-item-date">
                                            <i class="bi bi-calendar3"></i>
                                            {{ \Carbon\Carbon::parse($konsultasi->created_at)->format('d M Y') }}
                                        </span>
                                        <span class="konsultasi-item-date">
                                            <i class="bi bi-clock"></i>
                                            {{ \Carbon\Carbon::parse($konsultasi->created_at)->format('H:i') }} WIB
                                        </span>
                                    </div>

                                    @if($konsultasi->pesan_balasan_murobbi)
                                    <div class="konsultasi-reply">
                                        <div class="konsultasi-reply-label">
                                            <i class="bi bi-reply-fill"></i> Balasan Murobbi
                                        </div>
                                        <p class="konsultasi-reply-text">{{ $konsultasi->pesan_balasan_murobbi }}</p>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="konsultasi-empty">
                            <div class="konsultasi-empty-icon">
                                <i class="bi bi-chat-square-text"></i>
                            </div>
                            <h6>Belum Ada Riwayat</h6>
                            <p>Anda belum pernah mengajukan konsultasi. Mulai ajukan konsultasi pertama Anda.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection
