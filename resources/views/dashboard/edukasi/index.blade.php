@extends('dashboard.dashlayouts.style')
@section('content')

    @push('styles')
    <style>
        /* ===== EDUKASI PAGE STYLES ===== */

        /* --- Hero Section --- */
        .edukasi-hero {
            position: relative;
            border-radius: var(--radius-xl);
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 50%, #001a4d 100%);
            padding: 2.5rem 2rem;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        .edukasi-hero::before {
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

        .edukasi-hero::after {
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

        .edukasi-hero .hero-content {
            position: relative;
            z-index: 2;
        }

        .edukasi-hero .hero-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7);
            margin-bottom: 1rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .edukasi-hero .hero-breadcrumb:hover {
            color: #fff;
        }

        .edukasi-hero h1 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .edukasi-hero .hero-subtitle {
            font-size: 0.95rem;
            opacity: 0.85;
            font-weight: 400;
            max-width: 500px;
            line-height: 1.6;
        }

        .edukasi-hero .hero-icon-deco {
            position: absolute;
            right: 2rem;
            bottom: 1.5rem;
            font-size: 6rem;
            opacity: 0.08;
            z-index: 1;
        }

        .edukasi-hero .hero-stats {
            display: flex;
            gap: 1.5rem;
            margin-top: 1.25rem;
        }

        .edukasi-hero .hero-stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.8);
        }

        .edukasi-hero .hero-stat-item i {
            font-size: 1rem;
        }

        @media (max-width: 576px) {
            .edukasi-hero {
                padding: 1.75rem 1.25rem;
                border-radius: var(--radius-lg);
            }
            .edukasi-hero h1 {
                font-size: 1.35rem;
            }
            .edukasi-hero .hero-subtitle {
                font-size: 0.85rem;
            }
            .edukasi-hero .hero-icon-deco {
                font-size: 4rem;
                right: 1rem;
                bottom: 1rem;
            }
            .edukasi-hero .hero-stats {
                gap: 1rem;
                flex-wrap: wrap;
            }
        }

        /* --- Alert Styles --- */
        .edukasi-alert {
            border: none;
            border-radius: var(--radius-sm);
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
            animation: alertSlideIn 0.4s ease-out;
        }

        @keyframes alertSlideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .edukasi-alert.alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #065F46;
            border-left: 4px solid var(--success-color);
        }

        .edukasi-alert.alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #991B1B;
            border-left: 4px solid var(--danger-color);
        }

        body.dark-mode .edukasi-alert.alert-success {
            background: rgba(16, 185, 129, 0.15);
            color: #6EE7B7;
        }

        body.dark-mode .edukasi-alert.alert-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #FCA5A5;
        }

        /* --- Tab Navigation --- */
        .edukasi-tabs {
            display: flex;
            gap: 6px;
            background: var(--white);
            padding: 6px;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.75rem;
            border: 1px solid var(--gray-200);
        }

        .edukasi-tab-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            border: none;
            background: transparent;
            color: var(--gray-600);
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            white-space: nowrap;
        }

        .edukasi-tab-btn:hover {
            color: var(--primary-color);
            background: rgba(0, 83, 197, 0.06);
        }

        .edukasi-tab-btn.active {
            background: var(--primary-color);
            color: #fff;
            box-shadow: 0 4px 14px rgba(0, 83, 197, 0.3);
        }

        .edukasi-tab-btn .tab-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 700;
            background: var(--gray-200);
            color: var(--gray-600);
            transition: all 0.3s ease;
        }

        .edukasi-tab-btn.active .tab-count {
            background: rgba(255,255,255,0.25);
            color: #fff;
        }

        @media (max-width: 576px) {
            .edukasi-tab-btn {
                padding: 10px 8px;
                font-size: 0.78rem;
                gap: 5px;
            }
            .edukasi-tab-btn i {
                font-size: 0.85rem;
            }
            .edukasi-tab-btn .tab-count {
                display: none;
            }
        }

        /* --- Tab Content Panels --- */
        .edukasi-panel {
            display: none;
            animation: panelFadeIn 0.4s ease-out;
        }

        .edukasi-panel.active {
            display: block;
        }

        @keyframes panelFadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Video Cards --- */
        .video-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .video-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .video-card .video-thumbnail {
            position: relative;
            aspect-ratio: 16 / 9;
            background: var(--gray-100);
            overflow: hidden;
        }

        .video-card .video-thumbnail iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .video-card .video-thumbnail .video-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--gray-200) 0%, var(--gray-100) 100%);
            color: var(--gray-500);
        }

        .video-card .video-thumbnail .video-placeholder i {
            font-size: 2.5rem;
        }

        .video-card .video-thumbnail .video-placeholder span {
            font-size: 0.8rem;
            font-weight: 500;
        }

        .video-card .video-body {
            padding: 1rem 1.25rem 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .video-card .video-body h5 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1.4;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .video-card .video-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            background: rgba(239, 68, 68, 0.1);
            color: #DC2626;
            margin-top: auto;
            width: fit-content;
            margin-top: 10px;
        }

        /* --- Article Cards --- */
        .artikel-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 1rem;
        }

        .artikel-card:hover {
            box-shadow: var(--shadow-md);
            border-color: rgba(0, 83, 197, 0.15);
        }

        .artikel-card .artikel-body {
            padding: 1.5rem;
        }

        .artikel-card .artikel-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .artikel-card .artikel-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1.4;
            margin: 0;
            transition: color 0.3s;
        }

        .artikel-card:hover .artikel-title {
            color: var(--primary-color);
        }

        .artikel-card .artikel-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .artikel-card .artikel-meta-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: var(--gray-500);
            font-weight: 500;
        }

        .artikel-card .artikel-meta-item i {
            font-size: 0.85rem;
            color: var(--gray-400);
        }

        .artikel-card .artikel-content {
            font-size: 0.9rem;
            color: var(--gray-600);
            line-height: 1.8;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .artikel-card .artikel-content.expanded {
            -webkit-line-clamp: unset;
            display: block;
        }

        .artikel-card .artikel-read-more {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--primary-color);
            cursor: pointer;
            margin-top: 0.75rem;
            border: none;
            background: none;
            padding: 0;
            transition: gap 0.3s;
        }

        .artikel-card .artikel-read-more:hover {
            gap: 8px;
        }

        .artikel-card .artikel-divider {
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
            border-radius: 3px;
            margin-bottom: 1rem;
        }

        @media (max-width: 576px) {
            .artikel-card .artikel-body {
                padding: 1.25rem;
            }
            .artikel-card .artikel-title {
                font-size: 1rem;
            }
        }

        /* --- Kelas Cards --- */
        .kelas-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .kelas-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .kelas-card .kelas-accent {
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .kelas-card .kelas-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .kelas-card .kelas-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .kelas-card .kelas-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1.4;
            margin: 0;
        }

        .kelas-card .kelas-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            white-space: nowrap;
            flex-shrink: 0;
            background: rgba(0, 83, 197, 0.08);
            color: var(--primary-color);
        }

        .kelas-card .kelas-info-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 1rem;
        }

        .kelas-card .kelas-info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--gray-700);
        }

        .kelas-card .kelas-info-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 0.85rem;
        }

        .kelas-card .kelas-info-icon.date {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .kelas-card .kelas-description {
            font-size: 0.875rem;
            color: var(--gray-600);
            line-height: 1.7;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .kelas-card .kelas-footer {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .kelas-card .kelas-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .kelas-card .kelas-btn.btn-daftar {
            background: var(--primary-color);
            color: #fff;
            box-shadow: 0 4px 14px rgba(0, 83, 197, 0.25);
        }

        .kelas-card .kelas-btn.btn-daftar:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 20px rgba(0, 83, 197, 0.35);
            transform: translateY(-1px);
        }

        .kelas-card .kelas-btn.btn-menunggu {
            background: rgba(245, 158, 11, 0.1);
            color: #D97706;
            cursor: default;
        }

        .kelas-card .kelas-btn.btn-diterima {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            cursor: default;
        }

        .kelas-card .kelas-btn.btn-ditolak {
            background: rgba(239, 68, 68, 0.1);
            color: #DC2626;
            cursor: default;
        }

        @media (max-width: 576px) {
            .kelas-card .kelas-body {
                padding: 1.25rem;
            }
        }

        /* --- Empty State --- */
        .edukasi-empty {
            text-align: center;
            padding: 3.5rem 1.5rem;
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 2px dashed var(--gray-200);
        }

        .edukasi-empty .empty-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
        }

        .edukasi-empty .empty-icon i {
            font-size: 2rem;
            color: var(--gray-400);
        }

        .edukasi-empty h6 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .edukasi-empty p {
            font-size: 0.875rem;
            color: var(--gray-500);
            margin: 0;
            max-width: 320px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* --- Stagger Animation for Cards --- */
        .edukasi-stagger > * {
            opacity: 0;
            transform: translateY(20px);
            animation: staggerIn 0.5s ease-out forwards;
        }

        .edukasi-stagger > *:nth-child(1) { animation-delay: 0.05s; }
        .edukasi-stagger > *:nth-child(2) { animation-delay: 0.1s; }
        .edukasi-stagger > *:nth-child(3) { animation-delay: 0.15s; }
        .edukasi-stagger > *:nth-child(4) { animation-delay: 0.2s; }
        .edukasi-stagger > *:nth-child(5) { animation-delay: 0.25s; }
        .edukasi-stagger > *:nth-child(6) { animation-delay: 0.3s; }
        .edukasi-stagger > *:nth-child(7) { animation-delay: 0.35s; }
        .edukasi-stagger > *:nth-child(8) { animation-delay: 0.4s; }
        .edukasi-stagger > *:nth-child(9) { animation-delay: 0.45s; }

        @keyframes staggerIn {
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Section Header --- */
        .edukasi-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }

        .edukasi-section-header h5 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--gray-700);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .edukasi-section-header .section-count {
            font-size: 0.8rem;
            color: var(--gray-500);
            font-weight: 500;
        }
    </style>
    @endpush

    <div class="container pt-4 pb-5">

        <!-- Hero Section -->
        <div class="edukasi-hero">
            <div class="hero-content">
                <a href="{{ route('dashboard.lainnya') }}" class="hero-breadcrumb">
                    <i class="bi bi-arrow-left"></i> Kembali ke Menu
                </a>
                <h1>Edukasi Pranikah</h1>
                <p class="hero-subtitle">Persiapkan bekal ilmu untuk membangun keluarga sakinah, mawaddah, warahmah melalui video, artikel, dan kelas pranikah.</p>

                <div class="hero-stats">
                    <div class="hero-stat-item">
                        <i class="bi bi-play-circle-fill"></i>
                        <span>{{ $listVideo->count() }} Video</span>
                    </div>
                    <div class="hero-stat-item">
                        <i class="bi bi-journal-text"></i>
                        <span>{{ $listArtikel->count() }} Artikel</span>
                    </div>
                    <div class="hero-stat-item">
                        <i class="bi bi-mortarboard-fill"></i>
                        <span>{{ $listKelas->count() }} Kelas</span>
                    </div>
                </div>
            </div>
            <i class="bi bi-book-half hero-icon-deco"></i>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="edukasi-alert alert-success" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="edukasi-alert alert-danger" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- Tab Navigation -->
        <div class="edukasi-tabs" role="tablist">
            <button class="edukasi-tab-btn active" data-tab="video" role="tab" aria-selected="true">
                <i class="bi bi-play-circle"></i>
                <span>Video Kajian</span>
                <span class="tab-count">{{ $listVideo->count() }}</span>
            </button>
            <button class="edukasi-tab-btn" data-tab="artikel" role="tab" aria-selected="false">
                <i class="bi bi-journal-richtext"></i>
                <span>Artikel</span>
                <span class="tab-count">{{ $listArtikel->count() }}</span>
            </button>
            <button class="edukasi-tab-btn" data-tab="kelas" role="tab" aria-selected="false">
                <i class="bi bi-mortarboard"></i>
                <span>Kelas Pranikah</span>
                <span class="tab-count">{{ $listKelas->count() }}</span>
            </button>
        </div>

        <!-- Tab Panels -->

        <!-- VIDEO PANEL -->
        <div class="edukasi-panel active" id="panel-video" role="tabpanel">
            @if($listVideo->count() > 0)
                <div class="edukasi-section-header">
                    <h5><i class="bi bi-collection-play"></i> Daftar Video</h5>
                    <span class="section-count">{{ $listVideo->count() }} video tersedia</span>
                </div>
                <div class="row edukasi-stagger">
                    @foreach($listVideo as $video)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="video-card">
                            @php
                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $video->konten, $match);
                                $ytId = $match[1] ?? '';
                            @endphp
                            <div class="video-thumbnail">
                                @if($ytId)
                                    <iframe src="https://www.youtube.com/embed/{{ $ytId }}" 
                                            title="{{ $video->judul }}"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen
                                            loading="lazy"></iframe>
                                @else
                                    <div class="video-placeholder">
                                        <i class="bi bi-camera-video"></i>
                                        <span>Video tidak tersedia</span>
                                    </div>
                                @endif
                            </div>
                            <div class="video-body">
                                <h5>{{ $video->judul }}</h5>
                                <div class="video-badge">
                                    <i class="bi bi-play-fill"></i> Video Kajian
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="edukasi-empty">
                    <div class="empty-icon">
                        <i class="bi bi-camera-video-off"></i>
                    </div>
                    <h6>Belum Ada Video</h6>
                    <p>Video kajian pranikah akan segera ditambahkan. Pantau terus halaman ini untuk update terbaru.</p>
                </div>
            @endif
        </div>

        <!-- ARTIKEL PANEL -->
        <div class="edukasi-panel" id="panel-artikel" role="tabpanel">
            @if($listArtikel->count() > 0)
                <div class="edukasi-section-header">
                    <h5><i class="bi bi-journal-richtext"></i> Daftar Artikel</h5>
                    <span class="section-count">{{ $listArtikel->count() }} artikel tersedia</span>
                </div>
                <div class="edukasi-stagger">
                    @foreach($listArtikel as $artikel)
                    <div class="artikel-card">
                        <div class="artikel-body">
                            <div class="artikel-divider"></div>
                            <h4 class="artikel-title">{{ $artikel->judul }}</h4>
                            <div class="artikel-meta">
                                <span class="artikel-meta-item">
                                    <i class="bi bi-calendar3"></i>
                                    {{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y') }}
                                </span>
                                <span class="artikel-meta-item">
                                    <i class="bi bi-clock"></i>
                                    {{ \Carbon\Carbon::parse($artikel->created_at)->diffForHumans() }}
                                </span>
                            </div>
                            <div class="artikel-content" id="artikel-content-{{ $artikel->id }}">
                                {!! nl2br(e($artikel->konten)) !!}
                            </div>
                            <button class="artikel-read-more" onclick="toggleArtikel({{ $artikel->id }})" id="artikel-toggle-{{ $artikel->id }}">
                                Baca selengkapnya <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="edukasi-empty">
                    <div class="empty-icon">
                        <i class="bi bi-journal-x"></i>
                    </div>
                    <h6>Belum Ada Artikel</h6>
                    <p>Artikel edukasi pranikah akan segera tersedia. Silakan cek kembali nanti.</p>
                </div>
            @endif
        </div>

        <!-- KELAS PANEL -->
        <div class="edukasi-panel" id="panel-kelas" role="tabpanel">
            @if($listKelas->count() > 0)
                <div class="edukasi-section-header">
                    <h5><i class="bi bi-mortarboard"></i> Kelas Tersedia</h5>
                    <span class="section-count">{{ $listKelas->count() }} kelas tersedia</span>
                </div>
                <div class="row edukasi-stagger">
                    @foreach($listKelas as $kelas)
                    <div class="col-12 col-md-6 mb-4">
                        <div class="kelas-card">
                            <div class="kelas-accent"></div>
                            <div class="kelas-body">
                                <div class="kelas-header">
                                    <h5 class="kelas-title">{{ $kelas->judul }}</h5>
                                    <span class="kelas-badge">
                                        <i class="bi bi-people-fill"></i> {{ $kelas->kuota ?? '∞' }}
                                    </span>
                                </div>

                                <div class="kelas-info-list">
                                    <div class="kelas-info-item">
                                        <div class="kelas-info-icon date">
                                            <i class="bi bi-calendar-event"></i>
                                        </div>
                                        <div>
                                            <div style="font-weight: 600; color: var(--gray-800);">
                                                {{ \Carbon\Carbon::parse($kelas->tanggal_kegiatan)->translatedFormat('l, d F Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="kelas-description">{{ $kelas->konten }}</p>

                                @php
                                    $statusDaftar = $riwayatDaftar[$kelas->id] ?? null;
                                @endphp

                                <div class="kelas-footer">
                                    @if($statusDaftar == 'menunggu')
                                        <button class="kelas-btn btn-menunggu" disabled>
                                            <i class="bi bi-hourglass-split"></i> Menunggu Konfirmasi
                                        </button>
                                    @elseif($statusDaftar == 'diterima')
                                        <button class="kelas-btn btn-diterima" disabled>
                                            <i class="bi bi-check-circle-fill"></i> Pendaftaran Diterima
                                        </button>
                                    @elseif($statusDaftar == 'ditolak')
                                        <button class="kelas-btn btn-ditolak" disabled>
                                            <i class="bi bi-x-circle-fill"></i> Pendaftaran Ditolak
                                        </button>
                                    @else
                                        <form action="{{ route('dashboard.edukasi.daftar', $kelas->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="kelas-btn btn-daftar" onclick="return confirm('Anda yakin ingin mendaftar kelas ini?')">
                                                Daftar Sekarang <i class="bi bi-arrow-right"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="edukasi-empty">
                    <div class="empty-icon">
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <h6>Belum Ada Jadwal Kelas</h6>
                    <p>Belum ada jadwal kelas pranikah dalam waktu dekat. Pantau terus informasi terbaru.</p>
                </div>
            @endif
        </div>

    </div>

    @push('myscript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching logic
            const tabBtns = document.querySelectorAll('.edukasi-tab-btn');
            const panels = document.querySelectorAll('.edukasi-panel');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const tabName = this.dataset.tab;

                    // Update buttons
                    tabBtns.forEach(b => {
                        b.classList.remove('active');
                        b.setAttribute('aria-selected', 'false');
                    });
                    this.classList.add('active');
                    this.setAttribute('aria-selected', 'true');

                    // Update panels
                    panels.forEach(p => p.classList.remove('active'));
                    const targetPanel = document.getElementById('panel-' + tabName);
                    if (targetPanel) {
                        targetPanel.classList.add('active');

                        // Re-trigger stagger animation
                        const staggerItems = targetPanel.querySelectorAll('.edukasi-stagger > *');
                        staggerItems.forEach(item => {
                            item.style.animation = 'none';
                            item.offsetHeight; // Force reflow
                            item.style.animation = '';
                        });
                    }
                });
            });
        });

        // Toggle article expand/collapse
        function toggleArtikel(id) {
            const content = document.getElementById('artikel-content-' + id);
            const toggle = document.getElementById('artikel-toggle-' + id);

            if (content && toggle) {
                content.classList.toggle('expanded');
                if (content.classList.contains('expanded')) {
                    toggle.innerHTML = 'Tutup <i class="bi bi-arrow-up"></i>';
                } else {
                    toggle.innerHTML = 'Baca selengkapnya <i class="bi bi-arrow-right"></i>';
                }
            }
        }
    </script>
    @endpush

@endsection
