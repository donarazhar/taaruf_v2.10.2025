<div class="container d-flex align-items-center justify-content-between">

    <div class="logo">
        <!-- <h1><a href="index.html"><span>Ta'aruf Jodohku</span></a></h1> -->
        <img src="{{ asset('assets/img/logo.png') }}" alt="" width="100%" height="100%">
    </div>

    <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link scrollto active" href="/">Beranda</a></li>
            <li><a class="nav-link scrollto" href="/#about">Tentang</a></li>
            <li><a class="nav-link scrollto" href="/#details">Informasi</a></li>
            <li class="dropdown"><a href="#"><span>Daftar</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a href="/daftar-email">via Email</a></li>
                    <li><a href="/daftar">via API</a></li>
                </ul>
            </li>
            <li><a class="nav-link scrollto" href="/login">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>

</div>
