@extends('dashboard.dashlayouts.style')

@section('content')
<style>
    .news-detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-top: 20px;
        margin-bottom: 40px;
    }
    .news-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1F2937;
        margin-bottom: 16px;
        line-height: 1.3;
    }
    .news-meta {
        font-size: 0.9rem;
        color: #6B7280;
        margin-bottom: 24px;
        display: flex;
        gap: 16px;
        align-items: center;
    }
    .news-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 32px;
    }
    .news-body {
        font-size: 1.1rem;
        color: #374151;
        line-height: 1.8;
    }
    .news-body p {
        margin-bottom: 16px;
    }
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: #f3f4f6;
        color: #4b5563;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 20px;
        transition: all 0.2s;
    }
    .btn-back:hover {
        background: #e5e7eb;
        color: #1f2937;
    }
</style>

<div class="container" style="padding-top: 20px;">
    <a href="{{ route('dashboard') }}" class="btn-back">
        <i class="fa fa-arrow-left"></i> Kembali ke Dashboard
    </a>
    
    <div class="news-detail-container">
        <h1 class="news-title">{{ $berita->title }}</h1>
        <div class="news-meta">
            @if(isset($berita->category['name']))
                <span><i class="fa fa-folder"></i> {{ $berita->category['name'] }}</span>
            @endif
            @if(isset($berita->published_at))
                <span><i class="fa fa-clock"></i> {{ \Carbon\Carbon::parse($berita->published_at)->format('d M Y') }}</span>
            @endif
            @if(isset($berita->views_count))
                <span><i class="fa fa-eye"></i> {{ $berita->views_count }} views</span>
            @endif
        </div>
        
        @if(isset($berita->featured_image) && $berita->featured_image)
            <img src="{{ env('MAA_WEB_URL', 'http://localhost:8001') }}/storage/{{ $berita->featured_image }}" alt="{{ $berita->title }}" class="news-image">
        @endif
        
        <div class="news-body">
            {!! $berita->content !!}
        </div>
    </div>
</div>
@endsection
