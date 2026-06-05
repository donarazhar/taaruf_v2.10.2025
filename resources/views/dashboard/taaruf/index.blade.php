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
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    /* ===== GLOBAL STYLES ===== */
    body {
        background-color: #F0F2F5 !important;
    }

    /* ===== HEADER SECTION ===== */
    .taaruf-header {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        gap: 1rem;
        border-left: 4px solid var(--primary-color);
    }

    .taaruf-header h1 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.15rem;
        color: var(--dark);
    }

    .taaruf-header p {
        font-size: 0.85rem;
        margin: 0;
        color: var(--gray-600);
    }

    .taaruf-header .icon {
        font-size: 1.75rem;
        flex-shrink: 0;
    }

    /* ===== FILTER SECTION ===== */
    .filter-section {
        background: var(--white);
        border: none;
        border-radius: var(--radius-lg);
        padding: 1rem 1.25rem;
        margin-bottom: 1rem;
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
        gap: 0.75rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .stat-card {
        flex: 1;
        min-width: 100px;
        background: var(--white);
        border: none;
        border-radius: var(--radius-md);
        padding: 0.75rem;
        text-align: center;
        box-shadow: var(--shadow-sm);
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        display: block;
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--gray-600);
        font-weight: 600;
    }

    /* ===== PROFILE CARD MODERN ===== */
    .blog-wrapper {
        margin-bottom: 1.5rem;
    }

    .profile-card {
        background: var(--white);
        border: none;
        border-radius: var(--radius-md);
        overflow: hidden;
        transition: all 0.2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-sm);
    }

    .profile-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
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
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        color: var(--white);
        padding: 2rem 0.75rem 0.5rem;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 10;
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
        padding: 0.55rem 0.75rem;
        background: var(--primary-color);
        color: var(--white);
        border: none;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 0.8rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        transition: all 0.2s ease;
    }

    .btn-view:hover {
        background: var(--primary-dark);
        color: var(--white);
    }

    .btn-like {
        width: 38px;
        height: 38px;
        padding: 0;
        background: #FEF2F2;
        color: var(--danger-color);
        border: none;
        border-radius: var(--radius-sm);
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-like:hover {
        background: var(--danger-color);
        color: var(--white);
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
    <div class="container">
        
        <!-- Header Section -->
        <div class="taaruf-header">
            <div class="icon">💑</div>
            <div>
                <h1>Ta'aruf Jodohku</h1>
                <p>Temukan pasangan terbaik untuk masa depan Anda</p>
            </div>
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
                Filter & Pencarian Lanjutan
            </div>
            <form action="{{ route('taaruf') }}" method="GET" id="filterForm">
                <div class="row g-3">
                    <!-- Search Input -->
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="🔍 Nama atau NIP">
                    </div>
                    <!-- Usia -->
                    <div class="col-md-2">
                        <select name="usia" class="form-select">
                            <option value="">Semua Usia</option>
                            <option value="20-25" {{ request('usia') == '20-25' ? 'selected' : '' }}>20 - 25 Tahun</option>
                            <option value="26-30" {{ request('usia') == '26-30' ? 'selected' : '' }}>26 - 30 Tahun</option>
                            <option value="31-35" {{ request('usia') == '31-35' ? 'selected' : '' }}>31 - 35 Tahun</option>
                            <option value="36-40" {{ request('usia') == '36-40' ? 'selected' : '' }}>36 - 40 Tahun</option>
                            <option value="40+" {{ request('usia') == '40+' ? 'selected' : '' }}>Di atas 40 Tahun</option>
                        </select>
                    </div>
                    <!-- Pendidikan -->
                    <div class="col-md-3">
                        <select name="pendidikan" class="form-select">
                            <option value="">Semua Pendidikan</option>
                            <option value="SMA/SMK" {{ request('pendidikan') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="D3" {{ request('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ request('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ request('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ request('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                    </div>
                    <!-- Suku -->
                    <div class="col-md-2">
                        <select name="suku" class="form-select">
                            <option value="">Semua Suku</option>
                            <option value="Jawa" {{ request('suku') == 'Jawa' ? 'selected' : '' }}>Jawa</option>
                            <option value="Sunda" {{ request('suku') == 'Sunda' ? 'selected' : '' }}>Sunda</option>
                            <option value="Batak" {{ request('suku') == 'Batak' ? 'selected' : '' }}>Batak</option>
                            <option value="Minang" {{ request('suku') == 'Minang' ? 'selected' : '' }}>Minang</option>
                            <option value="Bugis" {{ request('suku') == 'Bugis' ? 'selected' : '' }}>Bugis</option>
                            <option value="Betawi" {{ request('suku') == 'Betawi' ? 'selected' : '' }}>Betawi</option>
                            <option value="Lainnya" {{ request('suku') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <!-- Buttons -->
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100" style="background-color: var(--primary-color); border: none;">Terapkan</button>
                        <a href="{{ route('taaruf') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </div>
            </form>
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
                                    <div class="skeleton-image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, var(--gray-100) 0%, var(--gray-200) 50%, var(--gray-100) 100%); background-size: 200% 100%; animation: shimmer 1.5s infinite; z-index: 1;"></div>
                                    
                                    @if(isset($user->match_percentage))
                                    <div style="position: absolute; top: 10px; left: 10px; z-index: 3; background-color: rgba(0, 83, 197, 0.85); color: white; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; backdrop-filter: blur(4px); box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                        <i class="bi bi-heart-fill text-danger me-1"></i> Kecocokan {{ $user->match_percentage }}%
                                    </div>
                                    @endif

                                    @php
                                        $path = !empty($user->foto) ? Storage::url('uploads/karyawan/img/' . $user->foto) : '';
                                        $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&background=random&color=fff&size=200';
                                    @endphp
                                    <img class="profile-image" 
                                         src="{{ !empty($path) ? url($path) : $defaultAvatar }}"
                                         alt="{{ $user->nama }}"
                                         loading="lazy"
                                         onload="this.parentElement.querySelector('.skeleton-image').style.display='none'"
                                         style="z-index: 2;">
                                    
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
        <!-- Content End -->
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const profileGrid = document.getElementById('profileGrid');

        // Shimmer Animation Style
        if (!document.getElementById('shimmer-style')) {
            const style = document.createElement('style');
            style.id = 'shimmer-style';
            style.innerHTML = '@keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }';
            document.head.appendChild(style);
        }

        if(filterForm && profileGrid) {
            filterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show Skeleton Loading
                const skeletonHTML = `
                    ${Array(10).fill().map(() => `
                    <div class="col profile-item">
                        <div class="profile-card" style="box-shadow: none; border: 1px solid var(--gray-200);">
                            <div class="profile-image-wrapper" style="background: var(--gray-200);">
                                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, var(--gray-200) 0%, var(--gray-300) 50%, var(--gray-200) 100%); background-size: 200% 100%; animation: shimmer 1.5s infinite;"></div>
                            </div>
                            <div class="profile-card-body" style="padding: 1rem;">
                                <div style="height: 15px; width: 50%; background: var(--gray-200); border-radius: 4px; margin-bottom: 12px; position: relative; overflow: hidden;">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.4) 50%, transparent 100%); background-size: 200% 100%; animation: shimmer 1.5s infinite;"></div>
                                </div>
                                <div style="height: 10px; width: 80%; background: var(--gray-200); border-radius: 4px; margin-bottom: 8px; position: relative; overflow: hidden;">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.4) 50%, transparent 100%); background-size: 200% 100%; animation: shimmer 1.5s infinite;"></div>
                                </div>
                                <div style="height: 10px; width: 60%; background: var(--gray-200); border-radius: 4px; position: relative; overflow: hidden;">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.4) 50%, transparent 100%); background-size: 200% 100%; animation: shimmer 1.5s infinite;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `).join('')}
                `;
                
                profileGrid.innerHTML = skeletonHTML;

                const formData = new FormData(filterForm);
                const queryString = new URLSearchParams(formData).toString();
                
                // Update URL bar without reload
                window.history.pushState({}, '', '?' + queryString);

                fetch('{{ route('taaruf') }}?' + queryString, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newGrid = doc.getElementById('profileGrid');
                    
                    if (newGrid) {
                        profileGrid.innerHTML = newGrid.innerHTML;
                    } else {
                        profileGrid.innerHTML = '<div class="col-12 text-center py-5"><h5 class="text-muted">Tidak ada data ditemukan</h5></div>';
                    }
                    
                    // Replace pagination if exists
                    const currentPagination = document.querySelector('.pagination-wrapper') || document.querySelector('.d-flex.justify-content-center.mt-4');
                    const newPagination = doc.querySelector('.pagination-wrapper') || doc.querySelector('.d-flex.justify-content-center.mt-4');
                    
                    if(currentPagination && newPagination) {
                        currentPagination.innerHTML = newPagination.innerHTML;
                    } else if(newPagination) {
                        profileGrid.parentElement.insertAdjacentHTML('beforeend', newPagination.outerHTML);
                    } else if(currentPagination) {
                        currentPagination.innerHTML = '';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    profileGrid.innerHTML = '<div class="col-12 text-center py-5"><h5 class="text-danger"><i class="bi bi-exclamation-triangle"></i> Terjadi kesalahan saat memuat data. Periksa koneksi internet Anda.</h5></div>';
                });
            });
        }
    });
    </script>
    @endpush
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
