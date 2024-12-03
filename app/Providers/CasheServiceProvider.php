<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CasheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
        // read more posts
        if (! Cache::has('read_more_posts')) {
            $read_more_posts = Post::select('id', 'title', 'slug')->latest()->limit(10)->get();
            Cache::remember('read_more_posts', 3600, function() use ($read_more_posts) {
                return $read_more_posts;
            });
        }
        // latest posts
        if (! Cache::has('latestPosts')) {
            $latestPosts = Post::select('id', 'title', "slug")->latest()->limit(5)->get();
            Cache::remember('latestPosts', 3600, function () use ($latestPosts) {
                return $latestPosts;
            });
        }
        // greater posts comments
        if (! Cache::has('popularPosts')) {
            $popularPosts = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->take(5)
                ->get();
            Cache::remember('popularPosts', 3600, function () use ($popularPosts) {
                return $popularPosts;
            });
        }
        // get posts
        $read_more_posts = Cache::get('read_more_posts');
        $latestPosts = Cache::get('latestPosts');
        $popularPosts = Cache::get('popularPosts');
        view()->share([
            'read_more_posts' => $read_more_posts,
            'latestPosts' => $latestPosts,
            'popularPosts' => $popularPosts,
        ]);
    }
}
