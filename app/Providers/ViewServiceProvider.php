<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Related;
use Illuminate\Support\Facades\Schema;
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
        if (! Schema::hasTable('related') || ! Schema::hasTable('categories')) {
            return;
        }

        $related_sites = Related::select('name', 'url')->get();
        $categories = Category::select('id', 'name', 'slug')->get();
        view()->share([
            'related_sites' => $related_sites,
            'categories' => $categories,
        ]);
    }
}
