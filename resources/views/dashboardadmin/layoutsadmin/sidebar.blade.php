<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon" />
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
        /* ===== CORPORATE BLUE DASHBOARD DESIGN ===== */
        :root {
            --primary: #0f4c81; /* Classic Corporate Blue */
            --primary-dark: #0a365c;
            --primary-light: #e6f0fa;
            --accent: #0284c7;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --gray-900: #0f172a;
            --gray-800: #1e293b;
            --gray-700: #334155;
            --gray-600: #475569;
            --gray-500: #64748b;
            --gray-400: #94a3b8;
            --gray-300: #cbd5e1;
            --gray-200: #e2e8f0;
            --gray-100: #f1f5f9;
            --gray-50: #f8fafc;
            --white: #FFFFFF;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            --sidebar-width: 280px;
            --topbar-height: 70px;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 14px;
            --radius-xl: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--gray-50);
            color: var(--text-main);
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
            background: var(--primary);
            color: var(--white);
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: var(--shadow-lg);
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--primary);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--primary-dark);
            border-radius: 3px;
        }

        /* Sidebar Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-decoration: none;
            color: var(--white);
            gap: 12px;
            background: var(--primary-dark);
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: var(--white);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .sidebar-brand-text {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .sidebar-brand-text sup {
            font-size: 0.7rem;
            opacity: 0.8;
        }

        /* Sidebar Divider */
        .sidebar-divider {
            border: none;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 16px 0;
        }

        /* Sidebar Heading */
        .sidebar-heading {
            padding: 12px 24px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Nav Items */
        .nav-item {
            list-style: none;
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-weight: 500;
            gap: 12px;
            border-left: 4px solid transparent;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--white);
            border-left-color: rgba(255, 255, 255, 0.5);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        .nav-item.active .nav-link {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            font-weight: 600;
            border-left-color: var(--white);
        }

        /* Collapse Menu */
        .collapse-inner {
            background: rgba(0, 0, 0, 0.15);
            border-radius: var(--radius-md);
            margin: 4px 16px;
            padding: 8px 0;
        }

        .collapse-header {
            padding: 8px 16px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.5);
        }

        .collapse-item {
            display: block;
            padding: 8px 16px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .collapse-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            padding-left: 20px;
        }

        .collapse-item.active {
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            font-weight: 600;
            padding-left: 16px;
        }

        /* Sidebar Toggle Button */
        .sidebar-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--white);
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 16px auto;
        }

        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
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
            background: var(--primary-light);
            border: none;
            color: var(--primary);
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
            transition: all 0.2s ease;
            position: relative;
        }

        .user-dropdown:hover {
            background: var(--gray-50);
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary-light);
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
            border: 1px solid var(--gray-100);
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
            color: var(--text-main);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .dropdown-item-custom:hover {
            background: var(--gray-50);
            color: var(--primary);
        }

        .dropdown-divider-custom {
            height: 1px;
            background: var(--gray-100);
            margin: 4px 0;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 32px;
            background: var(--gray-50);
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
            color: var(--text-muted);
        }

        /* Scroll to Top */
        .scroll-to-top {
            position: fixed;
            right: 24px;
            bottom: 24px;
            width: 48px;
            height: 48px;
            background: var(--primary);
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
            background: var(--primary-dark);
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
            background: rgba(15, 23, 42, 0.6);
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
            border-radius: var(--radius-lg);
            max-width: 400px;
            width: 90%;
            box-shadow: var(--shadow-xl);
            animation: modalSlideIn 0.3s ease-out;
            overflow: hidden;
        }

        @keyframes modalSlideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header-custom {
            padding: 20px 24px;
            border-bottom: 1px solid var(--gray-100);
            background: var(--gray-50);
        }

        .modal-title-custom {
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .modal-body-custom {
            padding: 24px;
            color: var(--text-muted);
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .modal-footer-custom {
            padding: 16px 24px;
            border-top: 1px solid var(--gray-100);
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            background: var(--gray-50);
        }

        .btn-modal {
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            font-weight: 500;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-secondary-modal {
            background: var(--white);
            color: var(--text-main);
            border: 1px solid var(--gray-300);
        }

        .btn-secondary-modal:hover {
            background: var(--gray-100);
        }

        .btn-primary-modal {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary-modal:hover {
            background: var(--primary-dark);
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

            .user-name {
                display: none;
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
            background: rgba(15, 23, 42, 0.4);
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
            <div class="sidebar-brand-icon" style="background: transparent;">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <div class="sidebar-brand-text">Ta'aruf <sup>v.2.0</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Dashboard -->
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li class="nav-item {{ request()->is(['dashboardadmin']) || request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboardadmin">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Nav Item - Data Karyawan -->
            <li class="nav-item {{ request()->is(['masterkaryawan']) ? 'active' : '' }}">
                <a class="nav-link" href="/masterkaryawan">
                    <i class="fas fa-users"></i>
                    <span>Data Karyawan</span>
                </a>
            </li>

            <!-- Nav Item - Data Admin -->
            <li class="nav-item {{ request()->is(['masteradmin']) ? 'active' : '' }}">
                <a class="nav-link" href="/masteradmin">
                    <i class="fas fa-user-shield"></i>
                    <span>Data Admin</span>
                </a>
            </li>

            <!-- Nav Item - Proses Ta'aruf -->
            <li class="nav-item {{ request()->is(['prosestaaruf']) ? 'active' : '' }}">
                <a class="nav-link" href="/prosestaaruf">
                    <i class="fas fa-hands-helping"></i>
                    <span>Proses Ta'aruf</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Manajemen Konten</div>



            <!-- Nav Item - Q&A -->
            <li class="nav-item {{ request()->is(['daftartanya']) ? 'active' : '' }}">
                <a class="nav-link" href="/daftartanya">
                    <i class="fas fa-envelope-open-text"></i>
                    <span>Daftar Q n A</span>
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