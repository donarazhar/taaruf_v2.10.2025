@extends('dashboard.dashlayouts.style')
@section('content')

    <div class="container pt-5 pb-5">
        <!-- Hero Section -->
        <div class="card mb-4" style="border-radius: 20px; border: none; overflow: hidden; position: relative;">
            <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); padding: 3rem 2rem; color: white;">
                <h2 class="font-weight-bold mb-2">Kandidat Pilihan Hari Ini</h2>
                <p class="mb-0" style="opacity: 0.9; font-size: 1.1rem;">Rekomendasi profil terbaik yang sesuai dengan kriteria Anda</p>
                
                <i class="fas fa-star" style="position: absolute; right: 2rem; bottom: -1rem; font-size: 8rem; opacity: 0.15;"></i>
            </div>
        </div>

        @if(isset($kandidatHarian) && $kandidatHarian->count() > 0)
        <div class="bg-white p-4 mt-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200);">
            <div class="row g-4">
                @foreach($kandidatHarian as $kandidat)
                <div class="col-md-6">
                    <div class="d-flex bg-light p-4 rounded-3 h-100" style="border: 1px solid var(--gray-200); transition: all 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='var(--shadow-md)';" onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
                        <div class="me-4 position-relative">
                            @php
                                $path = !empty($kandidat->foto) ? Storage::url('uploads/karyawan/img/' . $kandidat->foto) : '';
                                $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($kandidat->nama) . '&background=random&color=fff&size=200';
                            @endphp
                            <img src="{{ !empty($path) ? url($path) : $defaultAvatar }}" alt="{{ $kandidat->nama }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 3px solid var(--primary-color);">
                            @if(isset($kandidat->match_percentage))
                            <span class="badge bg-primary position-absolute bottom-0 start-50 translate-middle-x" style="font-size: 0.75rem; padding: 4px 8px; white-space: nowrap; border: 2px solid white;">
                                {{ $kandidat->match_percentage }}% Cocok
                            </span>
                            @endif
                        </div>
                        <div class="d-flex flex-column justify-content-center w-100">
                            <h5 class="mb-2 fw-bold text-dark">{{ \Illuminate\Support\Str::limit($kandidat->nama, 25) }}</h5>
                            <div class="mb-3 text-muted" style="font-size: 0.9rem; line-height: 1.5;">
                                <div><i class="fas fa-graduation-cap text-primary me-2" style="width:16px"></i> {{ $kandidat->pendidikan ?? 'Pendidikan -' }}</div>
                                <div><i class="fas fa-users text-primary me-2" style="width:16px"></i> {{ $kandidat->suku ?? 'Suku -' }}</div>
                                <div><i class="fas fa-birthday-cake text-primary me-2" style="width:16px"></i> {{ !empty($kandidat->tgllahir) ? \Carbon\Carbon::parse($kandidat->tgllahir)->age . ' Tahun' : '-' }}</div>
                            </div>
                            <a href="{{ route('taaruf') }}" class="btn btn-primary mt-auto align-self-start" style="font-size: 0.85rem; border-radius: 20px; padding: 8px 20px;">
                                Lihat Profil Lengkap <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('taaruf') }}" class="btn btn-outline-primary fw-bold" style="border-radius: 20px; padding: 10px 30px;">
                    Eksplorasi Semua Kandidat <i class="fas fa-search ms-2"></i>
                </a>
            </div>
        </div>
        @else
        <div class="bg-white p-5 text-center mt-4" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200);">
            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px;">
                <i class="fas fa-user-slash fa-3x text-muted"></i>
            </div>
            <h4 class="fw-bold text-dark mb-3">Belum Ada Rekomendasi Hari Ini</h4>
            <p class="text-muted mb-4">Pastikan Anda sudah mengisi kriteria pasangan di menu Profil agar kami dapat memberikan rekomendasi terbaik untuk Anda.</p>
            <a href="{{ route('profile') }}" class="btn btn-primary" style="border-radius: 20px; padding: 10px 30px;">
                Update Kriteria Pasangan
            </a>
        </div>
        @endif
    </div>

@endsection
