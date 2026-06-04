@extends('dashboard.dashlayouts.style')

@push('styles')
<style>
    /* ===== COLOR VARIABLES ===== */
    :root {
        --primary-color: #2563EB;
        --primary-light: #3B82F6;
        --primary-dark: #1D4ED8;
        --success-color: #10B981;
        --danger-color: #EF4444;
        --warning-color: #F59E0B;
        --dark: #1F2937;
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
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
        --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
    }

    body {
        background: #F0F2F5;
    }

    /* ===== LOGIN WRAPPER ===== */
    .login-wrapper {
        padding: 2rem 0;
        min-height: 100vh;
    }

    /* ===== PROFILE CONTAINER ===== */
    .profile-container {
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    /* ===== PROFILE HEADER ===== */
    .profile-header {
        background: var(--white);
        padding: 2rem 1.5rem 1.5rem;
        text-align: center;
        position: relative;
        border-bottom: 1px solid var(--gray-200);
    }

    .profile-image-container {
        position: relative;
        display: inline-block;
        margin-bottom: 1.5rem;
        z-index: 1;
    }

    .profile-image-wrapper {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid var(--gray-200);
        margin: 0 auto;
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
        width: 36px;
        height: 36px;
        background: var(--success-color);
        border: 3px solid var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1rem;
        z-index: 2;
    }

    .profile-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.35rem;
        z-index: 1;
        position: relative;
    }

    .profile-subtitle {
        color: var(--gray-600);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 0;
        z-index: 1;
        position: relative;
    }

    .profile-subtitle strong {
        font-weight: 600;
        color: var(--dark);
    }

    /* ===== ALERT MESSAGES ===== */
    .alert-modern {
        border: none;
        border-radius: var(--radius-md);
        padding: 1rem 1.25rem;
        margin: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: slideDown 0.3s ease;
    }

    .alert-success {
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
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== INFO CARDS ===== */
    .info-section {
        padding: 1.5rem;
    }

    .info-card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 1.25rem;
        margin-bottom: 1rem;
    }

    .info-card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 2px solid var(--gray-200);
    }

    .info-card-icon {
        width: 36px;
        height: 36px;
        background: #EFF6FF;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .info-card-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
    }

    .info-card-body {
        line-height: 1.8;
    }

    .info-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--gray-100);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 700;
        color: var(--gray-700);
        min-width: 140px;
        flex-shrink: 0;
    }

    .info-value {
        color: var(--gray-800);
        flex: 1;
    }

    /* ===== CRITERIA CARD ===== */
    .criteria-card {
        background: var(--gray-100);
        border: none;
        border-radius: var(--radius-md);
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .criteria-item {
        background: var(--white);
        border-radius: var(--radius-md);
        padding: 1rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: start;
        gap: 0.75rem;
        transition: all 0.3s ease;
    }

    .criteria-item:hover {
        box-shadow: var(--shadow-sm);
        transform: translateX(5px);
    }

    .criteria-item:last-child {
        margin-bottom: 0;
    }

    .criteria-icon {
        width: 32px;
        height: 32px;
        background: #EFF6FF;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 0.8rem;
        flex-shrink: 0;
    }

    .criteria-content {
        flex: 1;
    }

    .criteria-label {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .criteria-value {
        color: var(--gray-700);
        font-size: 0.95rem;
    }

    .criteria-text-area {
        background: var(--white);
        border-radius: var(--radius-md);
        padding: 1.25rem;
        border-left: 4px solid var(--primary-color);
        box-shadow: var(--shadow-sm);
    }

    .criteria-text-area .criteria-label {
        font-size: 1rem;
        margin-bottom: 0.75rem;
        display: block;
    }

    .criteria-text-area .criteria-value {
        line-height: 1.8;
        white-space: pre-line;
    }

    /* ===== ACTION BUTTON ===== */
    .action-section {
        padding: 0 1.5rem 1.5rem;
    }

    .btn-progress {
        width: 100%;
        padding: 0.85rem 1.5rem;
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-progress.btn-primary {
        background: var(--primary-color);
        color: var(--white);
    }

    .btn-progress.btn-primary:hover:not(:disabled) {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37,99,235,0.3);
    }

    .btn-progress.btn-danger {
        background: var(--gray-200);
        color: var(--gray-600);
        cursor: not-allowed;
    }

    .btn-progress i {
        font-size: 1.1rem;
    }

    /* ===== STATS BADGES ===== */
    .stats-container {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
        flex-wrap: wrap;
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    .stat-badge {
        background: #EFF6FF;
        border: 1px solid #BFDBFE;
        border-radius: var(--radius-sm);
        padding: 0.5rem 1rem;
        color: var(--dark);
        font-weight: 600;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .stat-badge i {
        font-size: 0.9rem;
        color: var(--primary-color);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .profile-header {
            padding: 2rem 1.5rem 1.5rem;
        }

        .profile-image-wrapper {
            width: 150px;
            height: 150px;
        }

        .verified-badge-large {
            width: 38px;
            height: 38px;
            font-size: 1rem;
        }

        .profile-name {
            font-size: 1.5rem;
        }

        .profile-subtitle {
            font-size: 0.9rem;
        }

        .info-section {
            padding: 1.5rem;
        }

        .info-card {
            padding: 1.25rem;
        }

        .info-card-icon {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
        }

        .info-card-title {
            font-size: 1.1rem;
        }

        .info-row {
            flex-direction: column;
            gap: 0.25rem;
        }

        .info-label {
            min-width: auto;
        }

        .action-section {
            padding: 0 1.5rem 1.5rem;
        }

        .btn-progress {
            padding: 0.875rem 1.5rem;
            font-size: 1rem;
        }

        .stats-container {
            gap: 0.5rem;
        }

        .stat-badge {
            padding: 0.6rem 1rem;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 480px) {
        .profile-image-wrapper {
            width: 130px;
            height: 130px;
        }

        .verified-badge-large {
            width: 35px;
            height: 35px;
            font-size: 0.9rem;
        }

        .profile-name {
            font-size: 1.3rem;
        }

        .info-card-icon {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }

        .criteria-icon {
            width: 30px;
            height: 30px;
            font-size: 0.8rem;
        }
    }

    /* ===== LOADING ANIMATION ===== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .profile-container {
        animation: fadeInUp 0.6s ease-out;
    }

    /* ===== HOVER GLOW EFFECT ===== */
    .btn-progress.btn-primary:hover:not(:disabled) {
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }
</style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6">
                
                <!-- Alert Messages -->
                @if (Session::get('success'))
                    <div class="alert-modern alert-success">
                        <i class="fa fa-check-circle"></i>
                        <span>{{ Session::get('success') }}</span>
                    </div>
                @endif
                
                @if (Session::get('warning'))
                    <div class="alert-modern alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        <span>{{ Session::get('warning') }}</span>
                    </div>
                @endif

                <form action="/taaruf/progressprofile" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="profile-container">
                        
                        <!-- Profile Header -->
                        <div class="profile-header">
                            <div class="profile-image-container">
                                <div class="profile-image-wrapper">
                                    @php
                                        $path = !empty($karyawan->foto)
                                            ? Storage::url('uploads/karyawan/img/' . $karyawan->foto)
                                            : '';
                                        $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($karyawan->nama) . '&background=random&color=fff&size=200';
                                    @endphp
                                    <img src="{{ !empty($path) ? url($path) : $defaultAvatar }}"
                                         alt="{{ $karyawan->nama }}">
                                    <div class="verified-badge-large" title="Terverifikasi">
                                        <i class="fa fa-check"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <h1 class="profile-name">{{ $karyawan->nama }}</h1>
                            
                            <div class="profile-subtitle">
                                <strong>{{ $karyawan->tempatlahir }}</strong>, 
                                {{ \Carbon\Carbon::parse($karyawan->tgllahir)->format('d F Y') }}
                                <br>
                                {{ $emailprofile }}
                            </div>

                            <div class="stats-container">
                                <div class="stat-badge">
                                    <i class="fa fa-map-marker"></i>
                                    <span>{{ $karyawan->tempatlahir }}</span>
                                </div>
                                <div class="stat-badge">
                                    <i class="fa fa-calendar"></i>
                                    <span>{{ \Carbon\Carbon::parse($karyawan->tgllahir)->age }} Tahun</span>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Information -->
                        <div class="info-section">
                            
                            <!-- Biodata Lengkap Card -->
                            <div class="info-card">
                                <div class="info-card-header">
                                    <div class="info-card-icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <h2 class="info-card-title">Biodata Lengkap</h2>
                                </div>
                                <div class="info-card-body">
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fa fa-map-marker"></i> Alamat
                                        </div>
                                        <div class="info-value">{{ $karyawan->alamat ?: '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fa fa-heart"></i> Hobi
                                        </div>
                                        <div class="info-value">{{ $karyawan->hobi ?: '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fa fa-quote-left"></i> Motto
                                        </div>
                                        <div class="info-value">{{ $karyawan->motto ?: '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fa fa-phone"></i> No. HP
                                        </div>
                                        <div class="info-value">{{ $karyawan->nohp ?: '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fa fa-briefcase"></i> Pekerjaan
                                        </div>
                                        <div class="info-value">{{ $karyawan->pekerjaan ?: '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fa fa-graduation-cap"></i> Pendidikan
                                        </div>
                                        <div class="info-value">{{ $karyawan->pendidikan ?: '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fa fa-users"></i> Suku
                                        </div>
                                        <div class="info-value">{{ $karyawan->suku ?: '-' }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kriteria Pasangan Card -->
                            <div class="info-card">
                                <div class="info-card-header">
                                    <div class="info-card-icon">
                                        <i class="fa fa-heart"></i>
                                    </div>
                                    <h2 class="info-card-title">Kriteria Pasangan</h2>
                                </div>
                                <div class="info-card-body">
                                    <div class="criteria-card">
                                        
                                        <div class="criteria-item">
                                            <div class="criteria-icon">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <div class="criteria-content">
                                                <div class="criteria-label">Suku yang Diinginkan</div>
                                                <div class="criteria-value">{{ $karyawan->kriteriasuku ?: 'Tidak ada preferensi' }}</div>
                                            </div>
                                        </div>

                                        <div class="criteria-item">
                                            <div class="criteria-icon">
                                                <i class="fa fa-weight"></i>
                                            </div>
                                            <div class="criteria-content">
                                                <div class="criteria-label">Rentang Berat Badan</div>
                                                <div class="criteria-value">{{ $karyawan->kriteriaberat ?: '-' }} kg</div>
                                            </div>
                                        </div>

                                        <div class="criteria-item">
                                            <div class="criteria-icon">
                                                <i class="fa fa-arrows-v"></i>
                                            </div>
                                            <div class="criteria-content">
                                                <div class="criteria-label">Rentang Tinggi Badan</div>
                                                <div class="criteria-value">{{ $karyawan->kriteriatinggi ?: '-' }} cm</div>
                                            </div>
                                        </div>

                                        <div class="criteria-item">
                                            <div class="criteria-icon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <div class="criteria-content">
                                                <div class="criteria-label">Rentang Umur</div>
                                                <div class="criteria-value">{{ $karyawan->kriteriaumur ?: '-' }} tahun</div>
                                            </div>
                                        </div>

                                        @if($karyawan->kriteriaumum)
                                            <div class="criteria-text-area">
                                                <div class="criteria-label">
                                                    <i class="fa fa-list-ul"></i> Kriteria Umum Lainnya
                                                </div>
                                                <div class="criteria-value">{{ $karyawan->kriteriaumum }}</div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Action Section -->
                        <div class="action-section">
                            <input type="hidden" name="emailprofile" id="emailprofile" value="{{ $emailprofile }}">
                            
                            <button class="btn-progress {{ $isDisabled ? 'btn-danger' : 'btn-primary' }}" 
                                    type="submit"
                                    {{ $isDisabled ? 'disabled' : '' }}>
                                @if($isDisabled)
                                    <i class="fa fa-ban"></i>
                                    <span>Tidak Tersedia</span>
                                @else
                                    <i class="fa fa-heart"></i>
                                    <span>Ajukan Progress</span>
                                @endif
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
