@extends('dashboard.dashlayouts.header')

<!-- Header Area -->
<div class="header-area" id="headerArea">
    <div class="container">
        <div class="header-content">
            <!-- Logo & User Info -->
            <div class="logo-wrapper">
                @php
                    $user = Auth::guard('karyawan')->user();
                    $path = !empty($user->foto) ? Storage::url('uploads/karyawan/img/' . $user->foto) : '';
                    $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&background=random&color=fff&size=200';
                @endphp
                <a href="/dashboard">
                    <img src="{{ !empty($path) ? url($path) : $defaultAvatar }}"
                        alt="{{ $user->nama }}" class="user-avatar">
                </a>
                <div class="user-info">
                    <div class="user-greeting">Selamat datang,</div>
                    <div class="user-name">{{ $user->nama }}</div>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="desktop-navbar">
                <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}" title="Home">
                    <i class="bi bi-house-door"></i> Home
                </a>
                
                <a href="{{ route('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}" title="Profile">
                    <i class="bi bi-person"></i> Profile
                </a>

                @if (isset($menuAktif) && $menuAktif)
                    <a href="{{ route('taaruf') }}" class="{{ request()->is('taaruf') ? 'active' : '' }}" title="Ta'aruf">
                        <i class="bi bi-heart"></i> Ta'aruf
                    </a>
                    
                    <a href="{{ route('progress') }}" class="{{ request()->is('progress') ? 'active' : '' }}" title="Progress">
                        <i class="bi bi-clock-history"></i> Progress
                    </a>
                @endif

                <a href="/proseslogout" title="Logout" onclick="return confirm('Yakin ingin logout?')" class="text-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>

                <!-- Dark Mode Toggle -->
                <button class="dark-mode-toggle btn btn-sm border-0 bg-transparent ms-2" id="darkModeBtn" title="Toggle Dark Mode">
                    <i class="bi bi-moon-fill text-dark fs-5" id="darkModeIcon"></i>
                </button>
            </div>

            <!-- Hamburger Button -->
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Menu">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenu">
        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Home
        </a>
        <a href="{{ route('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
            <i class="bi bi-person"></i> Profile
        </a>
        @if (isset($menuAktif) && $menuAktif)
            <a href="{{ route('taaruf') }}" class="{{ request()->is('taaruf') ? 'active' : '' }}">
                <i class="bi bi-heart"></i> Ta'aruf
            </a>
            <a href="{{ route('progress') }}" class="{{ request()->is('progress') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> Progress
            </a>
        @endif
        <a href="/proseslogout" onclick="return confirm('Yakin ingin logout?')" class="text-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (hamburgerBtn && mobileMenu) {
            hamburgerBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
                const icon = hamburgerBtn.querySelector('i');
                if (mobileMenu.classList.contains('active')) {
                    icon.classList.remove('bi-list');
                    icon.classList.add('bi-x');
                } else {
                    icon.classList.remove('bi-x');
                    icon.classList.add('bi-list');
                }
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!hamburgerBtn.contains(event.target) && !mobileMenu.contains(event.target) && mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.remove('active');
                    const icon = hamburgerBtn.querySelector('i');
                    icon.classList.remove('bi-x');
                    icon.classList.add('bi-list');
                }
            });
        }

        // Dark Mode Logic
        const darkModeBtn = document.getElementById('darkModeBtn');
        const darkModeIcon = document.getElementById('darkModeIcon');
        
        // Check local storage for preference
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            if(darkModeIcon) {
                darkModeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
                darkModeIcon.classList.replace('text-dark', 'text-warning');
            }
        }

        if (darkModeBtn) {
            darkModeBtn.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                if (document.body.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                    darkModeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
                    darkModeIcon.classList.replace('text-dark', 'text-warning');
                } else {
                    localStorage.setItem('theme', 'light');
                    darkModeIcon.classList.replace('bi-sun-fill', 'bi-moon-fill');
                    darkModeIcon.classList.replace('text-warning', 'text-dark');
                }
            });
        }
    });
</script>

<!-- Page Content -->
<div class="page-content-wrapper">
    @yield('content')
</div>

@include('dashboard.dashlayouts.footer')
@include('dashboard.dashlayouts.script')

</body>

</html>
