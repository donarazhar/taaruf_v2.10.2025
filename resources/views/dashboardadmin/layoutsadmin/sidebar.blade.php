<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon" />
    <title>Ta'aruf Admin - Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/ke2yr843uv7kjydevaiblj2mi0zm9uwvu9tikkn3sph5wdpc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* ===== MODERN ADMIN DASHBOARD DESIGN ===== */
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
            --white: #FFFFFF;
            --success: #22c55e;
            --warning: #fbbf24;
            --danger: #ef4444;
            --info: #3b82f6;
            --sidebar-width: 280px;
            --topbar-height: 70px;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.16);
            --shadow-xl: 0 16px 48px rgba(0, 0, 0, 0.2);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--gray-100);
            color: var(--gray-900);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--black);
            color: var(--white);
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--gray-900);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--gray-700);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--gray-600);
        }

        /* Sidebar Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 20px;
            border-bottom: 1px solid var(--gray-800);
            text-decoration: none;
            color: var(--white);
            gap: 12px;
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: var(--white);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--black);
            font-size: 20px;
        }

        .sidebar-brand-text {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .sidebar-brand-text sup {
            font-size: 0.7rem;
            opacity: 0.7;
        }

        /* Sidebar Divider */
        .sidebar-divider {
            border: none;
            height: 1px;
            background: var(--gray-800);
            margin: 16px 0;
        }

        /* Sidebar Heading */
        .sidebar-heading {
            padding: 12px 24px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gray-500);
        }

        /* Nav Items */
        .nav-item {
            list-style: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            color: var(--gray-400);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-weight: 500;
            gap: 12px;
        }

        .nav-link:hover {
            background: var(--gray-900);
            color: var(--white);
            padding-left: 28px;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        .nav-item.active .nav-link {
            background: var(--white);
            color: var(--black);
            font-weight: 600;
        }

        .nav-item.active .nav-link:hover {
            padding-left: 24px;
        }

        /* Collapse Menu */
        .collapse-inner {
            background: var(--gray-900);
            border-radius: var(--radius-md);
            margin: 8px 16px;
            padding: 12px 0;
        }

        .collapse-header {
            padding: 8px 16px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gray-500);
        }

        .collapse-item {
            display: block;
            padding: 10px 16px;
            color: var(--gray-400);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .collapse-item:hover {
            background: var(--gray-800);
            color: var(--white);
            padding-left: 20px;
        }

        .collapse-item.active {
            background: var(--gray-800);
            color: var(--white);
            font-weight: 600;
        }

        /* Sidebar Toggle Button */
        .sidebar-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gray-900);
            border: none;
            color: var(--white);
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 16px auto;
        }

        .sidebar-toggle:hover {
            background: var(--gray-800);
            transform: rotate(180deg);
        }

        /* ===== MAIN CONTENT ===== */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        /* Topbar */
        .topbar {
            height: var(--topbar-height);
            background: var(--white);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            background: var(--gray-100);
            border: none;
            color: var(--gray-900);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .topbar-toggle:hover {
            background: var(--gray-200);
        }

        /* User Dropdown */
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: var(--radius-md);
            transition: all 0.3s ease;
            position: relative;
        }

        .user-dropdown:hover {
            background: var(--gray-100);
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--gray-900);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--gray-200);
            object-fit: cover;
        }

        .dropdown-menu-custom {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: var(--white);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            border: 1px solid var(--gray-200);
        }

        .user-dropdown.show .dropdown-menu-custom {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--gray-900);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .dropdown-item-custom:hover {
            background: var(--gray-100);
        }

        .dropdown-divider-custom {
            height: 1px;
            background: var(--gray-200);
            margin: 8px 0;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 32px;
            background: var(--white);
        }

        .container-fluid {
            max-width: 100%;
        }

        /* Footer */
        .footer {
            background: var(--white);
            padding: 24px 32px;
            border-top: 1px solid var(--gray-200);
            text-align: center;
        }

        .footer-text {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        /* Scroll to Top */
        .scroll-to-top {
            position: fixed;
            right: 24px;
            bottom: 24px;
            width: 48px;
            height: 48px;
            background: var(--black);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 998;
        }

        .scroll-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-to-top:hover {
            background: var(--gray-900);
            transform: translateY(-4px);
        }

        /* Modal */
        .modal-custom {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal-custom.show {
            display: flex;
        }

        .modal-dialog-custom {
            background: var(--white);
            border-radius: var(--radius-xl);
            max-width: 500px;
            width: 90%;
            box-shadow: var(--shadow-xl);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header-custom {
            padding: 24px 28px;
            border-bottom: 1px solid var(--gray-200);
        }

        .modal-title-custom {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .modal-body-custom {
            padding: 28px;
            color: var(--gray-600);
            line-height: 1.6;
        }

        .modal-footer-custom {
            padding: 20px 28px;
            border-top: 1px solid var(--gray-200);
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-modal {
            padding: 10px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary-modal {
            background: var(--gray-200);
            color: var(--gray-900);
        }

        .btn-secondary-modal:hover {
            background: var(--gray-300);
        }

        .btn-primary-modal {
            background: var(--black);
            color: var(--white);
        }

        .btn-primary-modal:hover {
            background: var(--gray-900);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .topbar-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .topbar {
                padding: 0 16px;
            }

            .content-area {
                padding: 20px 16px;
            }

            .footer {
                padding: 20px 16px;
            }

            .user-name {
                display: none;
            }

            .sidebar-brand-text {
                font-size: 1.1rem;
            }
        }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        @media (max-width: 768px) {
            .sidebar-overlay {
                display: block;
            }
        }
    </style>
</head>

<body id="page-top">

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <!-- Sidebar Brand -->
        <a class="sidebar-brand" href="/dashboardadmin">
            <div class="sidebar-brand-icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="sidebar-brand-text">Ta'aruf <sup>v.2.0</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Dashboard -->
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li class="nav-item active">
                <a class="nav-link" href="/dashboardadmin">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Interface</div>

            <!-- Nav Item - Master Data -->
            <li class="nav-item {{ request()->is(['masterberita', 'masteryoutube', 'masterkaryawan']) ? 'active' : '' }}">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseMaster">
                    <i class="fas fa-cog"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseMaster" class="collapse {{ request()->is(['masterberita', 'masteryoutube', 'masterkaryawan']) ? 'show' : '' }}">
                    <div class="collapse-inner">
                        <h6 class="collapse-header">Data Inputan</h6>
                        <a class="collapse-item {{ request()->is(['masterberita']) ? 'active' : '' }}" href="/masterberita">Artikel & Berita</a>
                        <a class="collapse-item {{ request()->is(['masteryoutube']) ? 'active' : '' }}" href="/masteryoutube">Youtube</a>
                        <a class="collapse-item {{ request()->is(['masterkaryawan']) ? 'active' : '' }}" href="/masterkaryawan">Data Karyawan</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Q&A -->
            <li class="nav-item {{ request()->is(['daftartanya']) ? 'active' : '' }}">
                <a class="nav-link" href="/daftartanya">
                    <i class="fas fa-envelope"></i>
                    <span>Daftar Q n A</span>
                </a>
            </li>

            <!-- Nav Item - Proses Ta'aruf -->
            <li class="nav-item {{ request()->is(['prosestaaruf']) ? 'active' : '' }}">
                <a class="nav-link" href="/prosestaaruf">
                    <i class="fas fa-table"></i>
                    <span>Proses Ta'aruf</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggle -->
            <div class="text-center">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-angle-left"></i>
                </button>
            </div>
        </ul>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Topbar -->
        <nav class="topbar">
            <button class="topbar-toggle" id="sidebarToggleTop">
                <i class="fas fa-bars"></i>
            </button>

            <!-- User Dropdown -->
            <div class="user-dropdown" id="userDropdown">
                <span class="user-name">{{ $datauser->name }}</span>
                <img class="user-avatar" src="{{ asset('assets/img/logo.png') }}" alt="User">
                <i class="fas fa-chevron-down" style="font-size: 12px; color: var(--gray-600);"></i>
                
                <!-- Dropdown Menu -->
                <div class="dropdown-menu-custom">
                    <a class="dropdown-item-custom" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Content Area -->
        <main class="content-area">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-text">
                Copyright &copy; 2025 Direktorat Dakwah & Sosial YPI Al Azhar
            </div>
        </footer>
    </div>

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top" href="#page-top" id="scrollToTop">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal-custom" id="logoutModal">
        <div class="modal-dialog-custom">
            <div class="modal-header-custom">
                <h5 class="modal-title-custom">Konfirmasi Logout</h5>
            </div>
            <div class="modal-body-custom">
                Apakah Anda yakin ingin keluar dari sesi ini?
            </div>
            <div class="modal-footer-custom">
                <button class="btn-modal btn-secondary-modal" data-dismiss="modal">Batal</button>
                <a class="btn-modal btn-primary-modal" href="/proseslogoutadmin">Logout</a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script>
        // Sidebar Toggle (Desktop)
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainWrapper = document.querySelector('.main-wrapper');
        
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainWrapper.classList.toggle('sidebar-collapsed');
            });
        }

        // Sidebar Toggle (Mobile)
        const sidebarToggleTop = document.getElementById('sidebarToggleTop');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        if (sidebarToggleTop) {
            sidebarToggleTop.addEventListener('click', function() {
                sidebar.classList.add('show');
                sidebarOverlay.classList.add('show');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
        }

        // User Dropdown
        const userDropdown = document.getElementById('userDropdown');
        if (userDropdown) {
            userDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
                this.classList.toggle('show');
            });

            document.addEventListener('click', function() {
                userDropdown.classList.remove('show');
            });
        }

        // Scroll to Top
        const scrollToTop = document.getElementById('scrollToTop');
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 100) {
                scrollToTop.classList.add('show');
            } else {
                scrollToTop.classList.remove('show');
            }
        });

        if (scrollToTop) {
            scrollToTop.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Modal Functions
        document.querySelectorAll('[data-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const modal = document.querySelector(targetId);
                if (modal) {
                    modal.classList.add('show');
                }
            });
        });

        document.querySelectorAll('[data-dismiss="modal"]').forEach(button => {
            button.addEventListener('click', function() {
                const modal = this.closest('.modal-custom');
                if (modal) {
                    modal.classList.remove('show');
                }
            });
        });

        // Close modal when clicking outside
        document.querySelectorAll('.modal-custom').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('show');
                }
            });
        });

        // Collapse Menu Toggle
        document.querySelectorAll('[data-toggle="collapse"]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const target = document.querySelector(targetId);
                if (target) {
                    target.classList.toggle('show');
                }
            });
        });
    </script>

    @stack('myscript')
</body>

</html>