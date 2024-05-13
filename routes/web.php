<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Post\DownloadImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');

// Guest Routes  //
Route::middleware(['guest'])->group(function() {
    Route::get('/login',[LoginController::class, 'index'])->name('login');
    Route::post('/login',[LoginController::class, 'login'])->name('login.post');
    Route::get('/register',[RegisterController::class, 'index'])->name('register');
    Route::post('/register',[RegisterController::class, 'register'])->name('register.post');
});

// Auth Routes //
Route::middleware(['auth'])->group(function() {
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::get('/profile/settings',[ProfileController::class,'settings'])->name('profile.settings');
    Route::put('/profile/update',[ProfileController::class,'update'])->name('profile.update');
    Route::get('/auth',function() {
        // Auth::logout();
        return "You are logged in";
        
    });
    Route::delete('/logout',LogoutController::class)->name('logout');
    //user Profile Route
    Route::get('/user/{user}',UserProfileController::class)->name('userProfile');

    // Post Routes
    Route::resource('/posts',PostController::class);
    
    // Like Routes
    Route::post('/post/like/{post}',[LikeController::class,'like'])->name('like.post');
    // Comments Routes
    Route::post('/post/comment/{post}',[CommentController::class,'comment'])->name('comment.post');

});

//__Public Routes 
Route::get('/download/{post}',DownloadImageController::class)->name('download');
