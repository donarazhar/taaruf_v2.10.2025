@extends('dashboard.dashlayouts.style')
@section('content')

    <div class="container pt-5 pb-5">
        <!-- Hero Section -->
        <div class="card mb-4" style="border-radius: 20px; border: none; overflow: hidden; position: relative;">
            <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); padding: 3rem 2rem; color: white;">
                <h2 class="font-weight-bold mb-2">Menu Lainnya</h2>
                <p class="mb-0" style="opacity: 0.9; font-size: 1.1rem;">Akses fitur tambahan untuk mendukung perjalanan Ta'aruf Anda</p>
                
                <!-- Decorative Elements -->
                <i class="bi bi-grid-fill" style="position: absolute; right: 2rem; bottom: -1rem; font-size: 8rem; opacity: 0.15;"></i>
            </div>
        </div>

        <div class="row mt-4 g-4">
            <!-- Edukasi -->
            <div class="col-md-4 mb-4">
                <a href="{{ route('dashboard.edukasi') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm border-0 text-center" style="border-radius: 15px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)';" onmouseout="this.style.transform='none';">
                        <div class="card-body py-5">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                <i class="bi bi-book-fill" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="font-weight-bold text-dark mb-3">Edukasi Pranikah</h4>
                            <p class="text-muted mb-0">Tingkatkan ilmu dan kesiapan Anda sebelum melangkah ke jenjang pernikahan melalui kajian dan artikel.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Konsultasi -->
            <div class="col-md-4 mb-4">
                <a href="{{ route('dashboard.konsultasi') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm border-0 text-center" style="border-radius: 15px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)';" onmouseout="this.style.transform='none';">
                        <div class="card-body py-5">
                            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                <i class="bi bi-chat-dots-fill" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="font-weight-bold text-dark mb-3">Konsultasi Murobbi</h4>
                            <p class="text-muted mb-0">Diskusikan kriteria pasangan dan keluh kesah persiapan Anda langsung bersama Murobbi berpengalaman.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Kandidat Harian -->
            <div class="col-md-4 mb-4">
                <a href="{{ route('dashboard.kandidat_harian') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm border-0 text-center" style="border-radius: 15px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)';" onmouseout="this.style.transform='none';">
                        <div class="card-body py-5">
                            <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                <i class="bi bi-star-fill" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="font-weight-bold text-dark mb-3">Kandidat Hari Ini</h4>
                            <p class="text-muted mb-0">Temukan rekomendasi kandidat pasangan yang memiliki tingkat kecocokan paling tinggi dengan kriteria Anda.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
