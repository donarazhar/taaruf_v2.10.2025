@extends('dashboard.dashlayouts.style')
@section('content')

    @push('styles')
    <style>
        /* ===== KANDIDAT HARIAN PAGE STYLES ===== */

        /* --- Hero Section --- */
        .kandidat-hero {
            position: relative;
            border-radius: var(--radius-xl);
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 50%, #001a4d 100%);
            padding: 2.5rem 2rem;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        .kandidat-hero::before {
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

        .kandidat-hero::after {
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

        .kandidat-hero .hero-content {
            position: relative;
            z-index: 2;
        }

        .kandidat-hero .hero-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7);
            margin-bottom: 1rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .kandidat-hero .hero-breadcrumb:hover {
            color: #fff;
        }

        .kandidat-hero h1 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .kandidat-hero .hero-subtitle {
            font-size: 0.95rem;
            opacity: 0.85;
            font-weight: 400;
            max-width: 520px;
            line-height: 1.6;
        }

        .kandidat-hero .hero-icon-deco {
            position: absolute;
            right: 2rem;
            bottom: 1.5rem;
            font-size: 6rem;
            opacity: 0.08;
            z-index: 1;
        }

        .kandidat-hero .hero-stats {
            display: flex;
            gap: 1.5rem;
            margin-top: 1.25rem;
        }

        .kandidat-hero .hero-stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.8);
        }

        .kandidat-hero .hero-stat-item i {
            font-size: 1rem;
        }

        @media (max-width: 576px) {
            .kandidat-hero {
                padding: 1.75rem 1.25rem;
                border-radius: var(--radius-lg);
            }
            .kandidat-hero h1 {
                font-size: 1.35rem;
            }
            .kandidat-hero .hero-subtitle {
                font-size: 0.85rem;
            }
            .kandidat-hero .hero-icon-deco {
                font-size: 4rem;
                right: 1rem;
                bottom: 1rem;
            }
            .kandidat-hero .hero-stats {
                gap: 1rem;
                flex-wrap: wrap;
            }
        }

        /* --- Section Header --- */
        .kandidat-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }

        .kandidat-section-header h5 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--gray-700);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .kandidat-section-header .section-note {
            font-size: 0.78rem;
            color: var(--gray-500);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .kandidat-section-header .section-note i {
            font-size: 0.85rem;
        }

        /* --- Candidate Card Grid --- */
        .kandidat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .kandidat-grid {
                grid-template-columns: 1fr;
            }
        }

        /* --- Candidate Card --- */
        .kandidat-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .kandidat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .kandidat-card-accent {
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .kandidat-card-body {
            padding: 1.75rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 576px) {
            .kandidat-card-body {
                padding: 1.25rem;
            }
        }

        /* --- Avatar Section --- */
        .kandidat-avatar-section {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .kandidat-avatar-wrapper {
            position: relative;
            flex-shrink: 0;
        }

        .kandidat-avatar {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--gray-200);
            transition: border-color 0.3s ease;
        }

        .kandidat-card:hover .kandidat-avatar {
            border-color: var(--primary-color);
        }

        .kandidat-match-badge {
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%);
            display: inline-flex;
            align-items: center;
            gap: 3px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            white-space: nowrap;
            border: 2px solid var(--white);
        }

        .kandidat-match-badge.match-high {
            background: var(--success-color);
            color: #fff;
        }

        .kandidat-match-badge.match-medium {
            background: var(--primary-color);
            color: #fff;
        }

        .kandidat-match-badge.match-low {
            background: var(--warning-color);
            color: #fff;
        }

        .kandidat-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0 0 4px 0;
            line-height: 1.3;
        }

        .kandidat-nip {
            font-size: 0.78rem;
            color: var(--gray-500);
            font-weight: 500;
            margin: 0;
        }

        /* --- Info List --- */
        .kandidat-info-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 1.25rem;
        }

        .kandidat-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.85rem;
            color: var(--gray-700);
        }

        .kandidat-info-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 0.85rem;
        }

        .kandidat-info-icon.education {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .kandidat-info-icon.ethnicity {
            background: rgba(168, 85, 247, 0.1);
            color: #8B5CF6;
        }

        .kandidat-info-icon.age {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .kandidat-info-icon.height {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .kandidat-info-icon.weight {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .kandidat-info-label {
            font-size: 0.72rem;
            color: var(--gray-500);
            display: block;
            line-height: 1;
            margin-bottom: 2px;
        }

        .kandidat-info-value {
            font-weight: 600;
            color: var(--gray-800);
            display: block;
            line-height: 1.3;
        }

        /* --- Match Bar --- */
        .kandidat-match-section {
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.25rem;
        }

        body.dark-mode .kandidat-match-section {
            background: var(--gray-100);
            border-color: var(--gray-200);
        }

        .kandidat-match-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .kandidat-match-label span:first-child {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--gray-600);
        }

        .kandidat-match-label span:last-child {
            font-size: 0.9rem;
            font-weight: 800;
        }

        .kandidat-match-label .match-high-text { color: var(--success-color); }
        .kandidat-match-label .match-medium-text { color: var(--primary-color); }
        .kandidat-match-label .match-low-text { color: var(--warning-color); }

        .kandidat-match-bar {
            width: 100%;
            height: 8px;
            background: var(--gray-200);
            border-radius: 8px;
            overflow: hidden;
        }

        .kandidat-match-fill {
            height: 100%;
            border-radius: 8px;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .kandidat-match-fill.fill-high {
            background: linear-gradient(90deg, #10B981, #34D399);
        }

        .kandidat-match-fill.fill-medium {
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .kandidat-match-fill.fill-low {
            background: linear-gradient(90deg, #F59E0B, #FBBF24);
        }

        /* --- Card CTA --- */
        .kandidat-card-footer {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .kandidat-btn-profile {
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
            background: var(--primary-color);
            color: #fff;
            box-shadow: 0 4px 14px rgba(0, 83, 197, 0.25);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .kandidat-btn-profile:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 20px rgba(0, 83, 197, 0.35);
            transform: translateY(-1px);
            color: #fff;
            text-decoration: none;
        }

        /* --- Explore All CTA --- */
        .kandidat-explore {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            padding: 2rem;
            text-align: center;
            transition: box-shadow 0.3s ease;
        }

        .kandidat-explore:hover {
            box-shadow: var(--shadow-md);
        }

        .kandidat-explore-text {
            font-size: 0.9rem;
            color: var(--gray-600);
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .kandidat-btn-explore {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border: 2px solid var(--primary-color);
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--primary-color);
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .kandidat-btn-explore:hover {
            background: var(--primary-color);
            color: #fff;
            box-shadow: 0 4px 14px rgba(0, 83, 197, 0.25);
            transform: translateY(-2px);
            text-decoration: none;
        }

        /* --- Info Note --- */
        .kandidat-note {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(59, 130, 246, 0.06);
            border: 1px solid rgba(59, 130, 246, 0.12);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.25rem;
            font-size: 0.82rem;
            color: var(--gray-600);
            line-height: 1.5;
        }

        .kandidat-note i {
            font-size: 1.1rem;
            color: var(--info-color);
            flex-shrink: 0;
        }

        body.dark-mode .kandidat-note {
            background: rgba(59, 130, 246, 0.08);
            border-color: rgba(59, 130, 246, 0.15);
        }

        /* --- Empty State --- */
        .kandidat-empty {
            text-align: center;
            padding: 3.5rem 1.5rem;
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 2px dashed var(--gray-200);
        }

        .kandidat-empty-icon {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .kandidat-empty-icon i {
            font-size: 2.2rem;
            color: var(--gray-400);
        }

        .kandidat-empty h5 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .kandidat-empty p {
            font-size: 0.875rem;
            color: var(--gray-500);
            margin: 0 auto 1.5rem;
            max-width: 380px;
            line-height: 1.6;
        }

        .kandidat-btn-criteria {
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

        .kandidat-btn-criteria:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 20px rgba(0, 83, 197, 0.35);
            transform: translateY(-2px);
            color: #fff;
            text-decoration: none;
        }

        /* --- Stagger Animation --- */
        .kandidat-stagger > * {
            opacity: 0;
            transform: translateY(20px);
            animation: kandidatStaggerIn 0.5s ease-out forwards;
        }

        .kandidat-stagger > *:nth-child(1) { animation-delay: 0.1s; }
        .kandidat-stagger > *:nth-child(2) { animation-delay: 0.25s; }

        @keyframes kandidatStaggerIn {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @endpush

    <div class="container pt-4 pb-5">

        <!-- Hero Section -->
        <div class="kandidat-hero">
            <div class="hero-content">
                <a href="{{ route('dashboard.lainnya') }}" class="hero-breadcrumb">
                    <i class="bi bi-arrow-left"></i> Kembali ke Menu
                </a>
                <h1>Kandidat Pilihan Hari Ini</h1>
                <p class="hero-subtitle">Rekomendasi profil terbaik yang dipilih berdasarkan kriteria pasangan Anda. Diperbarui setiap hari.</p>

                <div class="hero-stats">
                    <div class="hero-stat-item">
                        <i class="bi bi-stars"></i>
                        <span>{{ isset($kandidatHarian) ? $kandidatHarian->count() : 0 }} Rekomendasi</span>
                    </div>
                    <div class="hero-stat-item">
                        <i class="bi bi-arrow-repeat"></i>
                        <span>Diperbarui Harian</span>
                    </div>
                </div>
            </div>
            <i class="bi bi-star-fill hero-icon-deco"></i>
        </div>

        @if(isset($kandidatHarian) && $kandidatHarian->count() > 0)

            <!-- Info Note -->
            <div class="kandidat-note">
                <i class="bi bi-info-circle-fill"></i>
                <span>Kandidat dipilih secara acak setiap hari berdasarkan kesesuaian dengan kriteria pasangan yang Anda tentukan di profil. Klik <strong>"Lihat di Ta'aruf"</strong> untuk melihat profil lengkap.</span>
            </div>

            <!-- Section Header -->
            <div class="kandidat-section-header">
                <h5><i class="bi bi-person-hearts"></i> Profil Rekomendasi</h5>
                <span class="section-note">
                    <i class="bi bi-calendar3"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </span>
            </div>

            <!-- Candidate Cards -->
            <div class="kandidat-grid kandidat-stagger">
                @foreach($kandidatHarian as $kandidat)
                <div class="kandidat-card">
                    <div class="kandidat-card-accent"></div>
                    <div class="kandidat-card-body">

                        <!-- Avatar + Name -->
                        <div class="kandidat-avatar-section">
                            <div class="kandidat-avatar-wrapper">
                                @php
                                    $path = !empty($kandidat->foto) ? Storage::url('uploads/karyawan/img/' . $kandidat->foto) : '';
                                    $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($kandidat->nama) . '&background=random&color=fff&size=200';
                                    $matchPct = $kandidat->match_percentage ?? 0;
                                    $matchLevel = $matchPct >= 80 ? 'high' : ($matchPct >= 50 ? 'medium' : 'low');
                                @endphp
                                <img src="{{ !empty($path) ? url($path) : $defaultAvatar }}"
                                     alt="{{ $kandidat->nama }}"
                                     class="kandidat-avatar">
                                @if(isset($kandidat->match_percentage))
                                <span class="kandidat-match-badge match-{{ $matchLevel }}">
                                    <i class="bi bi-{{ $matchLevel === 'high' ? 'check-circle-fill' : ($matchLevel === 'medium' ? 'star-fill' : 'dash-circle') }}"></i>
                                    {{ $matchPct }}%
                                </span>
                                @endif
                            </div>
                            <div>
                                <h5 class="kandidat-name">{{ \Illuminate\Support\Str::limit($kandidat->nama, 25) }}</h5>
                                <p class="kandidat-nip">{{ $kandidat->nip ?? 'NIP tidak tersedia' }}</p>
                            </div>
                        </div>

                        <!-- Match Bar -->
                        @if(isset($kandidat->match_percentage))
                        <div class="kandidat-match-section">
                            <div class="kandidat-match-label">
                                <span>Tingkat Kecocokan</span>
                                <span class="match-{{ $matchLevel }}-text">{{ $matchPct }}%</span>
                            </div>
                            <div class="kandidat-match-bar">
                                <div class="kandidat-match-fill fill-{{ $matchLevel }}" style="width: {{ $matchPct }}%;"></div>
                            </div>
                        </div>
                        @endif

                        <!-- Info List -->
                        <div class="kandidat-info-list">
                            <div class="kandidat-info-item">
                                <div class="kandidat-info-icon education">
                                    <i class="bi bi-mortarboard-fill"></i>
                                </div>
                                <div>
                                    <span class="kandidat-info-label">Pendidikan</span>
                                    <span class="kandidat-info-value">{{ $kandidat->biodata->pendidikan ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="kandidat-info-item">
                                <div class="kandidat-info-icon ethnicity">
                                    <i class="bi bi-globe-asia-australia"></i>
                                </div>
                                <div>
                                    <span class="kandidat-info-label">Suku</span>
                                    <span class="kandidat-info-value">{{ $kandidat->biodata->suku ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="kandidat-info-item">
                                <div class="kandidat-info-icon age">
                                    <i class="bi bi-calendar-heart"></i>
                                </div>
                                <div>
                                    <span class="kandidat-info-label">Usia</span>
                                    <span class="kandidat-info-value">{{ isset($kandidat->biodata->tgllahir) ? \Carbon\Carbon::parse($kandidat->biodata->tgllahir)->age . ' Tahun' : '-' }}</span>
                                </div>
                            </div>
                            @if(!empty($kandidat->biodata->tinggi))
                            <div class="kandidat-info-item">
                                <div class="kandidat-info-icon height">
                                    <i class="bi bi-arrows-vertical"></i>
                                </div>
                                <div>
                                    <span class="kandidat-info-label">Tinggi Badan</span>
                                    <span class="kandidat-info-value">{{ $kandidat->tinggi }} cm</span>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- CTA -->
                        <div class="kandidat-card-footer">
                            <a href="{{ route('taaruf') }}" class="kandidat-btn-profile">
                                <i class="bi bi-person-lines-fill"></i>
                                Lihat di Ta'aruf
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Explore All -->
            <div class="kandidat-explore">
                <p class="kandidat-explore-text">Ingin melihat lebih banyak kandidat? Jelajahi semua profil di halaman Ta'aruf.</p>
                <a href="{{ route('taaruf') }}" class="kandidat-btn-explore">
                    <i class="bi bi-search-heart"></i>
                    Eksplorasi Semua Kandidat
                </a>
            </div>

        @else

            <!-- Empty State -->
            <div class="kandidat-empty">
                <div class="kandidat-empty-icon">
                    <i class="bi bi-person-x"></i>
                </div>
                <h5>Belum Ada Rekomendasi Hari Ini</h5>
                <p>Pastikan Anda sudah mengisi kriteria pasangan di menu Profil agar kami dapat memberikan rekomendasi terbaik untuk Anda.</p>
                <a href="{{ route('profile') }}" class="kandidat-btn-criteria">
                    <i class="bi bi-pencil-square"></i>
                    Update Kriteria Pasangan
                </a>
            </div>

        @endif
    </div>

@endsection
