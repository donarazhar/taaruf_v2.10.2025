<!DOCTYPE html>
<html>

<head>
    <style>
        /* ===== MODERN VIEW KARYAWAN STYLES ===== */
        :root {
            --black: #000000;
            --gray-900: #1A1A1A;
            --gray-800: #2D2D2D;
            --gray-700: #404040;
            --gray-600: #666666;
            --gray-500: #808080;
            --gray-400: #999999;
            --gray-300: #CCCCCC;
            --gray-200: #E5E5E5;
            --gray-100: #F5F5F5;
            --gray-50: #FAFAFA;
            --white: #FFFFFF;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.16);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--gray-800);
            line-height: 1.6;
        }

        /* ===== PROFILE CONTAINER ===== */
        .profile-container {
            padding: 0;
        }

        /* ===== PROFILE HEADER ===== */
        .profile-header {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        /* ===== PROFILE AVATAR CARD ===== */
        .avatar-card {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            box-shadow: var(--shadow-sm);
        }

        .avatar-wrapper {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid var(--gray-200);
            box-shadow: var(--shadow-md);
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: var(--black);
            color: var(--white);
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .avatar-badge i {
            font-size: 0.8rem;
        }

        /* ===== PROFILE INFO CARD ===== */
        .info-card {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
        }

        .info-card h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--black);
            margin: 0 0 16px 0;
            letter-spacing: -0.02em;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px;
            background: var(--gray-50);
            border-radius: var(--radius-md);
            border-left: 3px solid var(--black);
        }

        .info-icon {
            width: 32px;
            height: 32px;
            background: var(--black);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .info-icon i {
            font-size: 0.9rem;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--gray-900);
            word-break: break-word;
        }

        /* ===== SECTION CARD ===== */
        .section-card {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: var(--shadow-sm);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--gray-200);
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: var(--black);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-icon i {
            font-size: 1.1rem;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--black);
            margin: 0;
        }

        /* ===== DETAIL GRID ===== */
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 16px;
            background: var(--gray-50);
            border-radius: var(--radius-md);
            border: 1px solid var(--gray-200);
        }

        .detail-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .detail-label i {
            font-size: 0.85rem;
        }

        .detail-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--gray-900);
            word-break: break-word;
        }

        /* ===== GENDER BADGE ===== */
        .gender-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            background: var(--gray-200);
            color: var(--gray-900);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .gender-badge.male {
            background: rgba(0, 0, 0, 0.1);
            color: var(--black);
        }

        .gender-badge.female {
            background: rgba(0, 0, 0, 0.05);
            color: var(--gray-700);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .profile-header {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .avatar-card {
                padding: 16px;
            }

            .avatar-wrapper {
                width: 120px;
                height: 120px;
            }

            .info-card {
                padding: 20px;
            }

            .section-card {
                padding: 20px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .info-card h3 {
                font-size: 1.25rem;
            }

            .info-item {
                padding: 10px;
            }

            .detail-item {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    @foreach ($datakaryawan as $karyawan)
        <div class="profile-container">
            <!-- Profile Header -->
            <div class="profile-header">
                <!-- Avatar Card -->
                <div class="avatar-card">
                    <div class="avatar-wrapper">
                        @if ($karyawan->foto == null)
                            <img src="{{ asset('assets/img/nophoto.png') }}" alt="avatar" class="avatar-image">
                        @else
                            @php
                                $path = Storage::url('uploads/karyawan/img/' . $karyawan->foto);
                            @endphp
                            <img src="{{ $path }}" alt="{{ $karyawan->nama }}" class="avatar-image">
                        @endif
                    </div>
                    <div class="avatar-badge">
                        <i class="fas fa-user-check"></i>
                        <span>Verified</span>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="info-card">
                    <h3>{{ $karyawan->nama }}</h3>
                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Email</div>
                                <div class="info-value">{{ $karyawan->email }}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-venus-mars"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Jenis Kelamin</div>
                                <div class="info-value">
                                    <span class="gender-badge {{ $karyawan->jenkel == 'pria' ? 'male' : 'female' }}">
                                        <i class="fas {{ $karyawan->jenkel == 'pria' ? 'fa-mars' : 'fa-venus' }}"></i>
                                        {{ ucfirst($karyawan->jenkel) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Referensi</div>
                                <div class="info-value">
                                    @if ($karyawan->referensi_detail === null)
                                        Ybs adalah Pegawai YPI Al Azhar
                                    @else
                                        {{ $karyawan->referensi_detail }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Biodata Lengkap -->
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h4 class="section-title">Biodata Lengkap</h4>
                </div>

                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Tempat Lahir
                        </div>
                        <div class="detail-value">{{ $karyawan->tempatlahir }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fas fa-calendar-alt"></i>
                            Tanggal Lahir
                        </div>
                        <div class="detail-value">{{ date('d F Y', strtotime($karyawan->tgllahir)) }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fas fa-graduation-cap"></i>
                            Pendidikan
                        </div>
                        <div class="detail-value">{{ $karyawan->pendidikan }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fas fa-users"></i>
                            Suku
                        </div>
                        <div class="detail-value">{{ $karyawan->suku }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fas fa-ring"></i>
                            Status Nikah
                        </div>
                        <div class="detail-value">{{ $karyawan->statusnikah }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fas fa-gamepad"></i>
                            Hobi
                        </div>
                        <div class="detail-value">{{ $karyawan->hobi }}</div>
                    </div>
                </div>

                @if($karyawan->motto)
                    <div class="detail-item" style="margin-top: 16px; grid-column: 1 / -1;">
                        <div class="detail-label">
                            <i class="fas fa-quote-left"></i>
                            Motto Hidup
                        </div>
                        <div class="detail-value" style="font-style: italic; color: var(--gray-700);">
                            "{{ $karyawan->motto }}"
                        </div>
                    </div>
                @endif
            </div>

            <!-- Kriteria Pasangan -->
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4 class="section-title">Kriteria Pasangan</h4>
                </div>

                <div class="detail-grid">
                    <div class="detail-item" style="grid-column: 1 / -1;">
                        <div class="detail-label">
                            <i class="fas fa-clipboard-list"></i>
                            Kriteria Umum
                        </div>
                        <div class="detail-value">{{ $karyawan->kriteriaumum }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fas fa-users"></i>
                            Suku Yang Diinginkan
                        </div>
                        <div class="detail-value">{{ $karyawan->suku_pasangan ?? $karyawan->suku }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>