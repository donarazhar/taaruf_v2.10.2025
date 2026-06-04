@extends('dashboard.dashlayouts.style')

@push('styles')
<style>
    /* ===== COLOR VARIABLES ===== */
    :root {
        --primary-color: #0053C5;
        --primary-light: #0066FF;
        --primary-dark: #003D91;
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
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    /* ===== GLOBAL STYLES ===== */
    body {
        background-color: var(--white) !important;
    }

    .page-content-wrapper {
        background: var(--white);
        min-height: 100vh;
        padding: 1.5rem 0;
    }

    /* ===== HEADER SECTION ===== */
    .taaruf-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        text-align: center;
        color: var(--white);
    }

    .taaruf-header h1 {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: var(--white);
    }

    .taaruf-header p {
        font-size: 1rem;
        margin: 0;
        opacity: 0.95;
    }

    .taaruf-header .icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    /* ===== FILTER SECTION ===== */
    .filter-section {
        background: var(--white);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .filter-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-controls {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
    }

    .search-box input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 83, 197, 0.1);
    }

    /* ===== STATS BAR ===== */
    .stats-bar {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .stat-card {
        flex: 1;
        min-width: 150px;
        background: var(--white);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-color);
        display: block;
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--gray-600);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ===== PROFILE CARD MODERN ===== */
    .blog-wrapper {
        margin-bottom: 2rem;
    }

    .profile-card {
        background: var(--white);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-sm);
    }

    .profile-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-light);
    }

    .profile-image-wrapper {
        position: relative;
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        overflow: hidden;
        background: var(--gray-100);
    }

    .profile-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .profile-card:hover .profile-image {
        transform: scale(1.05);
    }

    .profile-badge {
        position: absolute;
        top: 0.75rem;
        left: 0.75rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        box-shadow: var(--shadow-md);
        z-index: 10;
        max-width: calc(100% - 1.5rem);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .verified-badge {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background: var(--success-color);
        color: var(--white);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        box-shadow: var(--shadow-md);
        z-index: 10;
    }

    .profile-card-body {
        padding: 1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .profile-nip {
        display: inline-block;
        background: var(--gray-800);
        color: var(--white);
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .profile-info {
        flex: 1;
        margin-bottom: 1rem;
    }

    .profile-referensi {
        font-size: 0.8rem;
        color: var(--gray-600);
        margin-bottom: 1rem;
        padding: 0.5rem;
        background: var(--gray-100);
        border-radius: var(--radius-sm);
        border-left: 3px solid var(--primary-color);
    }

    .profile-referensi strong {
        color: var(--primary-color);
    }

    .profile-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-view {
        flex: 1;
        padding: 0.65rem 1rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        border: none;
        border-radius: var(--radius-md);
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: var(--white);
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
    }

    .btn-like {
        width: 45px;
        height: 45px;
        padding: 0;
        background: var(--white);
        color: var(--danger-color);
        border: 2px solid var(--danger-color);
        border-radius: var(--radius-md);
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-like:hover {
        background: var(--danger-color);
        color: var(--white);
        transform: scale(1.1);
        box-shadow: var(--shadow-md);
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--white);
        border: 2px dashed var(--gray-300);
        border-radius: var(--radius-lg);
        margin: 2rem 0;
    }

    .empty-state-icon {
        font-size: 4rem;
        color: var(--gray-300);
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: var(--gray-600);
        font-size: 1rem;
    }

    /* ===== LOADING STATE ===== */
    .loading-card {
        background: var(--white);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        overflow: hidden;
        height: 100%;
    }

    .loading-skeleton {
        background: linear-gradient(90deg, var(--gray-100) 0%, var(--gray-200) 50%, var(--gray-100) 100%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .loading-image {
        width: 100%;
        padding-top: 100%;
    }

    .loading-content {
        padding: 1rem;
    }

    .loading-line {
        height: 12px;
        border-radius: 6px;
        margin-bottom: 0.5rem;
    }

    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 768px) {
        .taaruf-header {
            padding: 1.5rem;
        }

        .taaruf-header h1 {
            font-size: 1.5rem;
        }

        .taaruf-header .icon {
            font-size: 2rem;
        }

        .filter-section {
            padding: 1rem;
        }

        .filter-controls {
            flex-direction: column;
        }

        .search-box {
            width: 100%;
            min-width: auto;
        }

        .stats-bar {
            gap: 0.5rem;
        }

        .stat-card {
            min-width: calc(50% - 0.25rem);
            padding: 0.75rem;
        }

        .stat-number {
            font-size: 1.5rem;
        }

        .stat-label {
            font-size: 0.75rem;
        }

        .profile-badge {
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
        }

        .verified-badge {
            width: 28px;
            height: 28px;
            font-size: 0.8rem;
        }

        .profile-card-body {
            padding: 0.75rem;
        }

        .profile-nip {
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
        }

        .profile-referensi {
            font-size: 0.75rem;
            padding: 0.4rem;
        }

        .btn-view {
            font-size: 0.8rem;
            padding: 0.6rem 0.75rem;
        }

        .btn-like {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .profile-badge {
            font-size: 0.65rem;
            padding: 0.25rem 0.5rem;
            top: 0.5rem;
            left: 0.5rem;
        }

        .verified-badge {
            width: 24px;
            height: 24px;
            font-size: 0.7rem;
            top: 0.5rem;
            right: 0.5rem;
        }
    }

    /* ===== GRID LAYOUT ===== */
    .row {
        --bs-gutter-x: 1rem;
        --bs-gutter-y: 1rem;
    }

    @media (max-width: 576px) {
        .row {
            --bs-gutter-x: 0.75rem;
            --bs-gutter-y: 0.75rem;
        }
    }

    /* ===== FADE IN ANIMATION ===== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .profile-card {
        animation: fadeInUp 0.5s ease-out;
    }

    .profile-card:nth-child(1) { animation-delay: 0.1s; }
    .profile-card:nth-child(2) { animation-delay: 0.2s; }
    .profile-card:nth-child(3) { animation-delay: 0.3s; }
    .profile-card:nth-child(4) { animation-delay: 0.4s; }
</style>
@endpush

@section('content')
<div class="page-content-wrapper">
    <div class="container">
        
        <!-- Header Section -->
        <div class="taaruf-header">
            <div class="icon">💑</div>
            <h1>Ta'aruf Jodohku</h1>
            <p>Temukan pasangan terbaik untuk masa depan Anda</p>
        </div>

        @php
            $authUser = Auth::guard('karyawan')->user();
        @endphp

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stat-card">
                <span class="stat-number">{{ $users->total() }}</span>
                <span class="stat-label">Total Profil</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $authUser->jenkel == 'pria' ? 'W' : 'P' }}</span>
                <span class="stat-label">Gender</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">100%</span>
                <span class="stat-label">Terverifikasi</span>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-title">
                <i class="fa fa-filter"></i>
                Filter & Pencarian
            </div>
            <div class="filter-controls">
                <form action="{{ route('taaruf') }}" method="GET" class="search-box m-0 w-100">
                    <input type="text" 
                           name="search"
                           id="searchInput" 
                           value="{{ request('search') }}"
                           placeholder="🔍 Cari berdasarkan nama atau NIP..." 
                           onchange="this.form.submit()">
                </form>
            </div>
        </div>

        <!-- Profile Grid -->
        <div class="blog-wrapper">
            @if($users->total() > 0)
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3" id="profileGrid">
                    @foreach ($users as $user)
                        <div class="col profile-item" 
                             data-name="{{ strtolower($user->nama) }}" 
                             data-nip="{{ strtolower($user->nip) }}">
                            <div class="profile-card">
                                <!-- Image Section -->
                                <div class="profile-image-wrapper">
                                    @php
                                        $path = !empty($user->foto) ? Storage::url('uploads/karyawan/img/' . $user->foto) : '';
                                        $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&background=random&color=fff&size=200';
                                    @endphp
                                    <img class="profile-image" 
                                         src="{{ !empty($path) ? url($path) : $defaultAvatar }}"
                                         alt="{{ $user->nama }}"
                                         loading="lazy">
                                    
                                    <!-- Name Badge -->
                                    <span class="profile-badge" title="{{ $user->nama }}">
                                        {{ Str::limit($user->nama, 15) }}
                                    </span>
                                    
                                    <!-- Verified Badge -->
                                    @if($user->status == '1')
                                        <span class="verified-badge" title="Terverifikasi">
                                            <i class="fa fa-check"></i>
                                        </span>
                                    @endif
                                </div>

                                <!-- Card Body -->
                                <div class="profile-card-body">
                                    <!-- NIP Badge -->
                                    <span class="profile-nip">{{ $user->nip }}</span>

                                    <!-- Profile Info -->
                                    <div class="profile-info">
                                        @if(!empty($user->referensi_detail))
                                            <div class="profile-referensi">
                                                <strong>Referensi:</strong><br>
                                                {{ Str::limit($user->referensi_detail, 50) }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="profile-actions">
                                        <a class="btn-view" href="/taaruf/{{ $user->email }}/lihatprofile">
                                            <i class="fa fa-eye"></i>
                                            Lihat Profil
                                        </a>
                                        <a class="btn-like" 
                                           href="/taaruf/{{ $user->email }}/lihatprofile" 
                                           title="Suka">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $users->links('vendor.pagination.bootstrap-5') }}
                </div>

                <!-- No Results Message (Hidden by default) -->
                <div id="noResults" style="display: {{ $users->count() == 0 ? 'block' : 'none' }};">
                    <div class="empty-state">
                        <div class="empty-state-icon">🔍</div>
                        <h3>Tidak Ada Hasil</h3>
                        <p>Tidak ditemukan profil yang sesuai dengan pencarian Anda</p>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-state-icon">💔</div>
                    <h3>Belum Ada Profil</h3>
                    <p>Saat ini belum ada profil {{ $authUser->jenkel == 'pria' ? 'wanita' : 'pria' }} yang tersedia</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    // Like button animation
    document.addEventListener('DOMContentLoaded', function() {
        const likeButtons = document.querySelectorAll('.btn-like');
        
        likeButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Create heart animation
                const heart = document.createElement('i');
                heart.className = 'fa fa-heart';
                heart.style.position = 'absolute';
                heart.style.color = '#EF4444';
                heart.style.fontSize = '2rem';
                heart.style.pointerEvents = 'none';
                heart.style.animation = 'heartFloat 1s ease-out';
                
                const rect = button.getBoundingClientRect();
                heart.style.left = rect.left + rect.width / 2 + 'px';
                heart.style.top = rect.top + 'px';
                
                document.body.appendChild(heart);
                
                setTimeout(() => {
                    heart.remove();
                }, 1000);
            });
        });
    });

    // Add heart float animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes heartFloat {
            0% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translateY(-50px) scale(1.5);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);


</script>
@endpush
