<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Related;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
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
        $getSetting = Setting::firstOr(function () {
            return Setting::create([
                'site_name' => 'news',
                'favicon' => 'default',
                'logo' => 'img/logo.png',
                'facebook' => 'https://www.facebook.com/',
                'instagram' => 'https://www.instagram.com/',
                'youtube' => 'https://www.youtube.com/',
                'country' => 'Egypt',
                'city' => 'Cairo',
                'street' => 'Ain shams',
                'email' => 'news@gmail.com',
                'phone' => '01024146510',
                'small_desc' => 'this is app for news social networking site like facebook and twitter and other',
            ]);
        });
        $getSetting->whatsapp = "https:/wa.me/" . $getSetting->phone;
        view()->share(
            [
                'getSetting' => $getSetting,
                
            ]
        );
    }
}
