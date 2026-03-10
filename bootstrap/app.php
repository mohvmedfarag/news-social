<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckNotificationReadAt;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        then: function (){
            Route::middleware('web')->group(base_path('routes/admin.php'));
        }
    )

    ->withMiddleware(function (Middleware $middleware) {


        $middleware->redirectGuestsTo(function(){
            if (request()->is('admin/*')) {
                return route('admin.showLoginForm');
            }
            return route('login');
        });
        $middleware->redirectUsersTo(function(){
            if (request()->is('admin/*')) {
                return route('admin.home');
            }
            return route('frontend.index');
        });
        $middleware->web(append: [
            CheckNotificationReadAt::class,
        ]);

        $middleware->api(prepend: [
            CheckNotificationReadAt::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
