@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <style>
        /* ===== MUROBI TAARUF PAGE STYLES ===== */
        .content-area {
            --primary-blue: #0053C5;
            --primary-light: #0066FF;
        }

        /* Page Header */
        .murobi-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            border-radius: var(--radius-lg);
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .murobi-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .murobi-header h1 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .murobi-header p {
            opacity: 0.9;
            font-size: 1rem;
            margin: 0;
        }

        /* Stats Row */
        .stats-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .stat-box {
            flex: 1;
            min-width: 180px;
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: var(--white);
            flex-shrink: 0;
        }

        .stat-icon.blue { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .stat-icon.pink { background: linear-gradient(135deg, #ec4899, #be185d); }
        .stat-icon.green { background: linear-gradient(135deg, #10b981, #047857); }

        .stat-info h3 { font-size: 1.5rem; font-weight: 800; margin: 0; color: var(--text-main); }
        .stat-info p { font-size: 0.85rem; color: var(--text-muted); margin: 0; font-weight: 500; }

        /* Tabs */
        .gender-tabs {
            display: flex;
            gap: 0;
            margin-bottom: 1.5rem;
            background: var(--gray-100);
            border-radius: var(--radius-md);
            padding: 4px;
            border: 1px solid var(--gray-200);
        }

        .gender-tab {
            flex: 1;
            padding: 0.75rem 1.5rem;
            text-align: center;
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: var(--radius-sm);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .gender-tab:hover {
            color: var(--text-main);
            background: rgba(255,255,255,0.5);
        }

        .gender-tab.active {
            background: var(--white);
            color: var(--primary);
            box-shadow: var(--shadow-sm);
        }

        .gender-tab .tab-count {
            background: var(--gray-200);
            color: var(--text-muted);
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .gender-tab.active .tab-count {
            background: var(--primary);
            color: var(--white);
        }

        /* Search Box */
        .search-section {
            margin-bottom: 1.5rem;
        }

        .search-input-wrap {
            position: relative;
        }

        .search-input-wrap input {
            width: 100%;
            padding: 0.875rem 1.25rem 0.875rem 3rem;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: var(--white);
        }

        .search-input-wrap input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(15, 76, 129, 0.1);
        }

        .search-input-wrap .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 1rem;
        }

        /* Profile Grid */
        .profile-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.25rem;
        }

        /* Profile Card */
        .murobi-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
            animation: fadeInUp 0.4s ease-out;
        }

        .murobi-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .murobi-card-img {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            background: var(--gray-100);
        }

        .murobi-card-body {
            padding: 1rem;
        }

        .murobi-card-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .murobi-card-nip {
            display: inline-block;
            background: var(--gray-100);
            color: var(--text-muted);
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .murobi-card-gender {
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .murobi-card-gender.pria { color: #3b82f6; }
        .murobi-card-gender.wanita { color: #ec4899; }

        .btn-lihat-profil {
            display: block;
            width: 100%;
            padding: 0.6rem;
            background: var(--primary);
            color: var(--white);
            text-align: center;
            text-decoration: none;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-lihat-profil:hover {
            background: var(--primary-dark);
            color: var(--white);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-lihat-profil i {
            margin-right: 4px;
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Empty State */
        .empty-state-murobi {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-muted);
        }

        .empty-state-murobi i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .empty-state-murobi p {
            font-size: 1rem;
        }

        /* Pagination */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .pagination-wrap nav {
            display: block;
            width: 100%;
        }
        
        .pagination-wrap .pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-left: 0;
            list-style: none;
            gap: 0.5rem;
            margin: 0;
        }

        .pagination-wrap .page-item {
            margin: 0;
        }

        .pagination-wrap .page-link {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 12px;
            margin: 0;
            color: var(--text-muted);
            background-color: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md) !important;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            text-decoration: none;
            box-shadow: var(--shadow-sm);
        }

        .pagination-wrap .page-item.active .page-link,
        .pagination-wrap .page-item.active span.page-link {
            z-index: 3;
            color: var(--white);
            background-color: var(--primary);
            border-color: var(--primary);
            box-shadow: var(--shadow-md);
        }

        .pagination-wrap .page-item.disabled .page-link,
        .pagination-wrap .page-item.disabled span.page-link {
            color: var(--gray-400);
            pointer-events: none;
            background-color: var(--gray-50);
            border-color: var(--gray-200);
            box-shadow: none;
        }

        .pagination-wrap .page-link:hover {
            z-index: 2;
            color: var(--primary);
            background-color: var(--gray-50);
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .pagination-wrap .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(15, 76, 129, 0.25);
            outline: 0;
        }

        /* Alert */
        .alert-murobi {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            animation: fadeInUp 0.3s ease;
        }

        .alert-success-m {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error-m {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .murobi-header { padding: 1.5rem; }
            .murobi-header h1 { font-size: 1.35rem; }
            .stats-row { flex-direction: column; }
            .profile-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 0.75rem; }
            .murobi-card-body { padding: 0.75rem; }
            .murobi-card-name { font-size: 0.85rem; }
        }
    </style>

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="murobi-header">
            <h1><i class="fas fa-user-tie" style="margin-right: 8px;"></i> Murobi - Daftar Profil Ta'aruf</h1>
            <p>Lihat dan telaah semua profil peserta ta'aruf untuk proses penjodohan</p>
        </div>

        <!-- Alerts -->
        @if (Session::get('success'))
            <div class="alert-murobi alert-success-m">
                <i class="fas fa-check-circle"></i>
                <span>{{ Session::get('success') }}</span>
            </div>
        @endif
        @if (Session::get('error'))
            <div class="alert-murobi alert-error-m">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ Session::get('error') }}</span>
            </div>
        @endif

        <!-- Stats -->
        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-icon blue"><i class="fas fa-male"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalPria }}</h3>
                    <p>Pria Terverifikasi</p>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon pink"><i class="fas fa-female"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalWanita }}</h3>
                    <p>Wanita Terverifikasi</p>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon green"><i class="fas fa-users"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalPria + $totalWanita }}</h3>
                    <p>Total Peserta</p>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="search-section">
            <form action="{{ route('murobi.taaruf') }}" method="GET">
                <input type="hidden" name="tab" value="{{ $activeTab }}">
                <div class="search-input-wrap">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari berdasarkan nama atau NIP..." onchange="this.form.submit()">
                </div>
            </form>
        </div>

        <!-- Gender Tabs -->
        <div class="gender-tabs">
            <a href="{{ route('murobi.taaruf', array_merge(request()->all(), ['tab' => 'pria'])) }}" 
               class="gender-tab {{ $activeTab == 'pria' ? 'active' : '' }}">
                <i class="fas fa-male"></i> Pria
                <span class="tab-count">{{ $totalPria }}</span>
            </a>
            <a href="{{ route('murobi.taaruf', array_merge(request()->all(), ['tab' => 'wanita'])) }}" 
               class="gender-tab {{ $activeTab == 'wanita' ? 'active' : '' }}">
                <i class="fas fa-female"></i> Wanita
                <span class="tab-count">{{ $totalWanita }}</span>
            </a>
        </div>

        <!-- Tab Content: PRIA -->
        <div class="tab-content {{ $activeTab == 'pria' ? 'active' : '' }}" id="tabPria">
            @if($pria->count() > 0)
                <div class="profile-grid">
                    @foreach($pria as $user)
                        <div class="murobi-card">
                            @php
                                $path = !empty($user->foto) ? Storage::url('uploads/karyawan/img/' . $user->foto) : '';
                                $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&background=3b82f6&color=fff&size=200';
                            @endphp
                            <img class="murobi-card-img" 
                                 src="{{ !empty($path) ? url($path) : $defaultAvatar }}" 
                                 alt="{{ $user->nama }}" loading="lazy">
                            <div class="murobi-card-body">
                                <div class="murobi-card-name" title="{{ $user->nama }}" style="{{ in_array($user->email, $inProgressEmails) ? 'color: #ef4444;' : '' }}">{{ $user->nama }}</div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                    <span class="murobi-card-nip" style="margin-bottom: 0;">{{ $user->nip }}</span>
                                    @if(in_array($user->email, $inProgressEmails))
                                        <span style="background: #fef2f2; color: #991b1b; padding: 3px 6px; border-radius: 4px; font-size: 0.65rem; font-weight: 700; border: 1px solid #fecaca;"><i class="fas fa-lock" style="font-size: 0.6rem;"></i> In Progress</span>
                                    @endif
                                </div>
                                <div class="murobi-card-gender pria"><i class="fas fa-mars"></i> Pria</div>
                                @if(in_array($user->email, $inProgressEmails))
                                    <button class="btn-lihat-profil" style="background: var(--gray-300); color: var(--gray-500); cursor: not-allowed; border: none;" disabled>
                                        <i class="fas fa-eye-slash"></i> Sedang Progress
                                    </button>
                                @else
                                    <a href="{{ route('murobi.lihatprofile', ['email' => $user->email]) }}" class="btn-lihat-profil">
                                        <i class="fas fa-eye"></i> Lihat Profil
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-wrap">{{ $pria->links('vendor.pagination.bootstrap-5') }}</div>
            @else
                <div class="empty-state-murobi">
                    <i class="fas fa-user-slash"></i>
                    <p>Belum ada data karyawan pria terverifikasi</p>
                </div>
            @endif
        </div>

        <!-- Tab Content: WANITA -->
        <div class="tab-content {{ $activeTab == 'wanita' ? 'active' : '' }}" id="tabWanita">
            @if($wanita->count() > 0)
                <div class="profile-grid">
                    @foreach($wanita as $user)
                        <div class="murobi-card">
                            @php
                                $path = !empty($user->foto) ? Storage::url('uploads/karyawan/img/' . $user->foto) : '';
                                $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&background=ec4899&color=fff&size=200';
                            @endphp
                            <img class="murobi-card-img" 
                                 src="{{ !empty($path) ? url($path) : $defaultAvatar }}" 
                                 alt="{{ $user->nama }}" loading="lazy">
                            <div class="murobi-card-body">
                                <div class="murobi-card-name" title="{{ $user->nama }}" style="{{ in_array($user->email, $inProgressEmails) ? 'color: #ef4444;' : '' }}">{{ $user->nama }}</div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                    <span class="murobi-card-nip" style="margin-bottom: 0;">{{ $user->nip }}</span>
                                    @if(in_array($user->email, $inProgressEmails))
                                        <span style="background: #fef2f2; color: #991b1b; padding: 3px 6px; border-radius: 4px; font-size: 0.65rem; font-weight: 700; border: 1px solid #fecaca;"><i class="fas fa-lock" style="font-size: 0.6rem;"></i> In Progress</span>
                                    @endif
                                </div>
                                <div class="murobi-card-gender wanita"><i class="fas fa-venus"></i> Wanita</div>
                                @if(in_array($user->email, $inProgressEmails))
                                    <button class="btn-lihat-profil" style="background: var(--gray-300); color: var(--gray-500); cursor: not-allowed; border: none;" disabled>
                                        <i class="fas fa-eye-slash"></i> Sedang Progress
                                    </button>
                                @else
                                    <a href="{{ route('murobi.lihatprofile', ['email' => $user->email]) }}" class="btn-lihat-profil">
                                        <i class="fas fa-eye"></i> Lihat Profil
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-wrap">{{ $wanita->links('vendor.pagination.bootstrap-5') }}</div>
            @else
                <div class="empty-state-murobi">
                    <i class="fas fa-user-slash"></i>
                    <p>Belum ada data karyawan wanita terverifikasi</p>
                </div>
            @endif
        </div>
    </div>
@endsection
