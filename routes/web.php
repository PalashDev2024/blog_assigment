<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\ProfileController;


Route::get('/', fn() => redirect('dashboard'));


Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect']);
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback']);

Route::get('auth/google', [SocialLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback'])->name('google.callback');



Route::middleware(['auth', 'verified'])->group(function () {

   
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
   
    Route::resource('posts', PostController::class);
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('posts', [AdminController::class, 'posts']);
        Route::resource('users', AdminUserController::class);
    });

require __DIR__.'/auth.php';