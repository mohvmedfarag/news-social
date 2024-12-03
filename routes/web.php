<?php

use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Frontend\Dashboard\NotificationController;
use App\Http\Controllers\Frontend\Dashboard\ProfileController;
use App\Http\Controllers\Frontend\Dashboard\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\NewSubscriberController;
use App\Http\Controllers\SearchController;

Route::redirect('/', '/home');

Route::group([
    'as' => 'frontend.',
], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::post('news-subscribe', [NewSubscriberController::class, 'store'])->name('news-subscribe');

    Route::get('category/{slug}', CategoryController::class)->name('category.posts');

    Route::controller(PostController::class)->name('post.')->prefix('post/')->group(function (){
        Route::get('{slug}',  'show')->name('show');
        Route::get('comments/{slug}', 'getAllPosts')->name('getAllComments');
        Route::post('comments/store', 'saveComment')->name('comments.store');
    });

    Route::controller(ContactController::class)->name('contact.')->prefix('contact/')->group(function (){
        Route::get('',  'index')->name('index');
        Route::post('store',  'store')->name('store');
    });

    Route::match(['GET', 'POST'], 'search', SearchController::class)->name('search');

    // manage profile page
    Route::prefix('account/')->name('dashboard.')->middleware(['auth', 'verified'])->group(function(){
        Route::controller(ProfileController::class)->group(function(){
            Route::get('profile', 'index')->name('profile');
            // create post route
            Route::post('post/share', 'sharePost')->name('post.share');
            // update post route
            Route::get('post/edit/{slug}', 'editPost')->name('post.edit');
            Route::post('post/update', 'updatePost')->name('post.update');
            // delete post route
            Route::post('post/delete', 'deletePost')->name('post.delete');
            Route::get('post/get-comments/{id}', 'getComments')->name('post.getComments');
            Route::post('post/image/delete/{id}', 'deletePostImage')->name('post.image.delete');
        });
        // setting routs
        Route::prefix('setting')->controller(SettingController::class)->group(function(){
            Route::get('', 'index')->name('setting');
            Route::post('/update', 'updateProfile')->name('setting.update');
            Route::post('/change-password', 'changePassword')->name('setting.changePassword');

        });
        // notifications routes
        Route::prefix('notifications')->controller(NotificationController::class)->group(function(){
            Route::get('', 'index')->name('notifications');
            Route::post('delete', 'delete')->name('notifications.delete');
            Route::get('delete-all', 'deleteAll')->name('notifications.deleteAll');
        });
    });
}
);

Route::controller(VerificationController::class)->name('verification.')->prefix('email/')->group(function(){
    Route::get('verify', [VerificationController::class, 'show'])->name('notice');
    Route::get('verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify');
    Route::post('resend', [VerificationController::class, 'resend'])->name('resend');
});
Auth::routes();