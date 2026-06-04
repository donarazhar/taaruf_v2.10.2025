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
                    $defaultAvatar = $user->jenkel === 'L' ? 'avatar.jpg' : 'avatarwanita.jpg';
                @endphp
                <a href="/dashboard">
                    <img src="{{ !empty($path) ? url($path) : asset('assets/img/' . $defaultAvatar) }}"
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
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="page-content-wrapper">
    @yield('content')
</div>

@include('dashboard.dashlayouts.footer')
@include('dashboard.dashlayouts.script')

</body>

</html>
