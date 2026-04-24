<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/', 'as' => 'admin.'], function(){
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
    Route::post('login/check', [LoginController::class, 'login'])->name('login.check');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => 'auth:admin'], function(){

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
    Route::post('users/{user}/change-status', [UserController::class,'changeStatus'])->name('users.changeStatus');

    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/change-status', [CategoryController::class,'changeStatus'])
    ->name('categories.changeStatus');

    Route::resource('posts', PostController::class);
    Route::post('posts/{post}/change-status', [PostController::class,'changeStatus'])
    ->name('posts.changeStatus');

    Route::resource('settings', SettingController::class)->only(['index', 'update']);

    Route::resource('admins' ,AdminController::class);
    Route::post('admins/{admin}/change-status', [AdminController::class,'changeStatus'])->name('admins.changeStatus');

    Route::get('home', function(){
        return view('admin.index');
    })->name('home');
});
