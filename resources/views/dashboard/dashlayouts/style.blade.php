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
                    $defaultAvatar = $user->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';
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
