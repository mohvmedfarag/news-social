<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Related;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        $related_sites = Related::select('name', 'url')->get();
        $categories = Category::select('id', 'name', 'slug')->get();
        view()->share([
            'related_sites' => $related_sites,
            'categories' => $categories,
        ]);
    }
}
