@extends('dashboard.dashlayouts.style')

@section('content')
<style>
    .layanan-detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-top: 20px;
        margin-bottom: 40px;
    }
    .layanan-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1F2937;
        margin-bottom: 16px;
        line-height: 1.3;
    }
    .layanan-meta {
        font-size: 0.9rem;
        color: #6B7280;
        margin-bottom: 24px;
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: center;
    }
    .layanan-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 32px;
    }
    .layanan-body {
        font-size: 1.1rem;
        color: #374151;
        line-height: 1.8;
    }
    .layanan-body p {
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
    
    <div class="layanan-detail-container">
        <h1 class="layanan-title">{{ $layanan->name }}</h1>
        <div class="layanan-meta">
            @if(isset($layanan->type))
                <span style="text-transform: capitalize;"><i class="fa fa-tag"></i> {{ $layanan->type }}</span>
            @endif
            @if(isset($layanan->location))
                <span><i class="fa fa-map-marker-alt"></i> {{ $layanan->location }}</span>
            @endif
            @if(isset($layanan->start_date))
                <span><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($layanan->start_date)->format('d M Y') }}</span>
            @endif
        </div>
        
        @if(isset($layanan->image) && $layanan->image)
            <img src="{{ env('MAA_WEB_URL', 'http://localhost:8001') }}/storage/{{ $layanan->image }}" alt="{{ $layanan->name }}" class="layanan-image">
        @endif
        
        <div class="layanan-body">
            @if(isset($layanan->content) && !empty($layanan->content))
                {!! $layanan->content !!}
            @else
                <p>{{ $layanan->description }}</p>
            @endif
        </div>
    </div>
</div>
@endsection
