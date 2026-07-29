<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home
Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('/about', [HomeController::class, "about"])->name("about");
Route::get('/blog', [HomeController::class, "blog"])->name("blog");
Route::get('/blog/{post:slug}', [HomeController::class, "blogDetail"])->name("blog.details");

// Dashboard
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'user' => User::where("username", "AlifRJ")->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('dashboard/post', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name("my.post");
Route::get('dashboard/post{post:slug}', [PostController::class, 'edit'])->middleware(['auth', 'verified'])->name("edit.post");

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
