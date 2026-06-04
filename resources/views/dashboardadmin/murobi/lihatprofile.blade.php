@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== MUROBI LIHAT PROFIL STYLES ===== */
        .profile-container {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            margin-bottom: 2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Profile Header */
        .profile-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
        }

        .profile-image-wrapper {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 1rem;
            border: 5px solid rgba(255,255,255,0.9);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            position: relative;
        }

        .profile-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .verified-badge-large {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 40px;
            height: 40px;
            background: #10B981;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .profile-name {
            font-size: 1.75rem;
            font-weight: 800;
            color: white;
            margin: 0 0 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .profile-subtitle {
            color: rgba(255,255,255,0.9);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .stats-container {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .stat-badge {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        /* Info Section */
        .info-section {
            padding: 2rem;
        }

        .info-card {
            background: var(--gray-50);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--gray-200);
        }

        .info-card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--gray-200);
        }

        .info-card-icon {
            width: 42px;
            height: 42px;
            background: var(--primary);
            color: white;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .info-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .info-row {
            display: flex;
            padding: 0.65rem 0;
            border-bottom: 1px solid var(--gray-100);
            gap: 1rem;
        }

        .info-row:last-child { border-bottom: none; }

        .info-label {
            min-width: 160px;
            font-weight: 600;
            color: var(--text-muted);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-label i {
            width: 16px;
            text-align: center;
            color: var(--primary);
        }

        .info-value {
            flex: 1;
            color: var(--text-main);
            font-weight: 500;
            font-size: 0.95rem;
        }

        /* Criteria Section */
        .criteria-card {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .criteria-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            background: var(--white);
            border-radius: var(--radius-sm);
            border: 1px solid var(--gray-200);
            transition: all 0.2s ease;
        }

        .criteria-item:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-sm);
        }

        .criteria-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .criteria-content { flex: 1; }
        .criteria-label { font-size: 0.8rem; color: var(--text-muted); font-weight: 600; }
        .criteria-value { font-size: 0.95rem; color: var(--text-main); font-weight: 600; }

        .criteria-text-area {
            padding: 0.75rem;
            background: var(--white);
            border-radius: var(--radius-sm);
            border: 1px solid var(--gray-200);
        }

        .criteria-text-area .criteria-label {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Back Button */
        .btn-back-murobi {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--primary);
            color: var(--white);
            text-decoration: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .btn-back-murobi:hover {
            background: var(--primary-dark);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-header { padding: 2rem 1.5rem 1.5rem; }
            .profile-image-wrapper { width: 120px; height: 120px; }
            .profile-name { font-size: 1.4rem; }
            .info-section { padding: 1.25rem; }
            .info-row { flex-direction: column; gap: 0.25rem; }
            .info-label { min-width: auto; }
        }
    </style>

    <div class="container-fluid">
        <!-- Back Button -->
        <a href="{{ route('murobi.taaruf') }}" class="btn-back-murobi">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Profil
        </a>

        <div class="profile-container">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-image-wrapper">
                    @php
                        $path = !empty($karyawan->foto)
                            ? Storage::url('uploads/karyawan/img/' . $karyawan->foto)
                            : '';
                        $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($karyawan->nama) . '&background=random&color=fff&size=200';
                    @endphp
                    <img src="{{ !empty($path) ? url($path) : $defaultAvatar }}" alt="{{ $karyawan->nama }}">
                    <div class="verified-badge-large" title="Terverifikasi">
                        <i class="fas fa-check"></i>
                    </div>
                </div>

                <h1 class="profile-name">{{ $karyawan->nama }}</h1>

                <div class="profile-subtitle">
                    <strong>{{ $karyawan->tempatlahir ?? '-' }}</strong>,
                    {{ $karyawan->tgllahir ? \Carbon\Carbon::parse($karyawan->tgllahir)->format('d F Y') : '-' }}
                    <br>
                    {{ $emailprofile }}
                </div>

                <div class="stats-container">
                    @if($karyawan->tempatlahir)
                    <div class="stat-badge">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $karyawan->tempatlahir }}</span>
                    </div>
                    @endif
                    @if($karyawan->tgllahir)
                    <div class="stat-badge">
                        <i class="fas fa-calendar"></i>
                        <span>{{ \Carbon\Carbon::parse($karyawan->tgllahir)->age }} Tahun</span>
                    </div>
                    @endif
                    <div class="stat-badge">
                        <i class="fas fa-{{ $karyawan->jenkel == 'pria' ? 'mars' : 'venus' }}"></i>
                        <span>{{ ucfirst($karyawan->jenkel ?? '-') }}</span>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="info-section">
                <!-- Biodata Card -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon"><i class="fas fa-user"></i></div>
                        <h2 class="info-card-title">Biodata Lengkap</h2>
                    </div>
                    <div class="info-card-body">
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat</div>
                            <div class="info-value">{{ $karyawan->alamat ?: '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-heart"></i> Hobi</div>
                            <div class="info-value">{{ $karyawan->hobi ?: '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-quote-left"></i> Motto</div>
                            <div class="info-value">{{ $karyawan->motto ?: '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-phone"></i> No. HP</div>
                            <div class="info-value">{{ $karyawan->nohp ?: '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-briefcase"></i> Pekerjaan</div>
                            <div class="info-value">{{ $karyawan->pekerjaan ?: '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-graduation-cap"></i> Pendidikan</div>
                            <div class="info-value">{{ $karyawan->pendidikan ?: '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="fas fa-users"></i> Suku</div>
                            <div class="info-value">{{ $karyawan->suku ?: '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Kriteria Pasangan Card -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon" style="background: #ec4899;"><i class="fas fa-heart"></i></div>
                        <h2 class="info-card-title">Kriteria Pasangan</h2>
                    </div>
                    <div class="info-card-body">
                        <div class="criteria-card">
                            <div class="criteria-item">
                                <div class="criteria-icon"><i class="fas fa-users"></i></div>
                                <div class="criteria-content">
                                    <div class="criteria-label">Suku yang Diinginkan</div>
                                    <div class="criteria-value">{{ $karyawan->kriteriasuku ?: 'Tidak ada preferensi' }}</div>
                                </div>
                            </div>
                            <div class="criteria-item">
                                <div class="criteria-icon"><i class="fas fa-weight"></i></div>
                                <div class="criteria-content">
                                    <div class="criteria-label">Rentang Berat Badan</div>
                                    <div class="criteria-value">{{ $karyawan->kriteriaberat ?: '-' }} kg</div>
                                </div>
                            </div>
                            <div class="criteria-item">
                                <div class="criteria-icon"><i class="fas fa-arrows-alt-v"></i></div>
                                <div class="criteria-content">
                                    <div class="criteria-label">Rentang Tinggi Badan</div>
                                    <div class="criteria-value">{{ $karyawan->kriteriatinggi ?: '-' }} cm</div>
                                </div>
                            </div>
                            <div class="criteria-item">
                                <div class="criteria-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div class="criteria-content">
                                    <div class="criteria-label">Rentang Umur</div>
                                    <div class="criteria-value">{{ $karyawan->kriteriaumur ?: '-' }} tahun</div>
                                </div>
                            </div>

                            @if($karyawan->kriteriaumum)
                                <div class="criteria-text-area">
                                    <div class="criteria-label">
                                        <i class="fas fa-list-ul"></i> Kriteria Umum Lainnya
                                    </div>
                                    <div class="criteria-value">{{ $karyawan->kriteriaumum }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
