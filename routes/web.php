<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home
Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('/about', [HomeController::class, "about"])->name("about");
Route::get('/blog', [HomeController::class, "blog"])->name("blog");
Route::get('/blog/{post:slug}', [HomeController::class, "blogDetail"])->name("blog.details");

// Dashboard
Route::middleware(['auth','verified'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
    // Post
    Route::resource('dashboard/post', PostController::class)->parameters(['post' => 'post:slug']);
    Route::post('dashboard/post/bulk-destroy', [PostController::class, 'bulkDestroy'])->name('post.bulk-destroy');
    // Post Category
    Route::resource('dashboard/category', PostCategoryController::class)->parameters(['category' => 'category:slug']);
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
