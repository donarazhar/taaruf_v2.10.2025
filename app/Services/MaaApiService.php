<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MaaApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('MAA_WEB_URL', 'http://localhost:8001');
    }

    public function getPosts()
    {
        return Cache::remember('maa_posts', 300, function () {
            try {
                $response = Http::timeout(5)->get("{$this->baseUrl}/api/posts");
                if ($response->successful() && isset($response->json()['data']['data'])) {
                    return collect(json_decode(json_encode($response->json()['data']['data'])))->map(function($item) {
                        return (object)[
                            'slug' => $item->slug,
                            'judul' => $item->title,
                            'subjudul' => $item->excerpt,
                            'foto' => $item->featured_image ? "{$this->baseUrl}/storage/" . $item->featured_image : null
                        ];
                    });
                }
            } catch (\Exception $e) {
                // Ignore
            }
            return collect([]);
        });
    }

    public function getPost($slug)
    {
        return Cache::remember('maa_post_' . $slug, 300, function () use ($slug) {
            try {
                $response = Http::timeout(5)->get("{$this->baseUrl}/api/posts/{$slug}");
                if ($response->successful() && isset($response->json()['data'])) {
                    return (object) $response->json()['data'];
                }
            } catch (\Exception $e) {
                // Ignore
            }
            return null;
        });
    }

    public function getPrograms()
    {
        return Cache::remember('maa_programs', 300, function () {
            try {
                $response = Http::timeout(5)->get("{$this->baseUrl}/api/programs");
                if ($response->successful() && isset($response->json()['data'])) {
                    return collect($response->json()['data']);
                }
            } catch (\Exception $e) {
                // Ignore
            }
            return collect();
        });
    }

    public function getProgram($slug)
    {
        return Cache::remember('maa_program_' . $slug, 300, function () use ($slug) {
            try {
                $response = Http::timeout(5)->get("{$this->baseUrl}/api/programs/{$slug}");
                if ($response->successful() && isset($response->json()['data'])) {
                    return (object) $response->json()['data'];
                }
            } catch (\Exception $e) {
                // Ignore
            }
            return null;
        });
    }

    public function getYoutubeVideos()
    {
        return Cache::remember('maa_youtube', 300, function () {
            try {
                $response = Http::timeout(5)->get("{$this->baseUrl}/api/youtube");
                if ($response->successful() && isset($response->json()['data'])) {
                    return collect(json_decode(json_encode($response->json()['data'])));
                }
            } catch (\Exception $e) {
                // Ignore
            }
            return collect();
        });
    }

    public function getSliders()
    {
        return Cache::remember('maa_sliders', 300, function () {
            try {
                $response = Http::timeout(5)->get("{$this->baseUrl}/api/sliders");
                if ($response->successful() && isset($response->json()['data'])) {
                    return collect(json_decode(json_encode($response->json()['data'])));
                }
            } catch (\Exception $e) {
                // Ignore
            }
            return collect();
        });
    }
}
