<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
    ]);
})->name("home");
Route::get('/about', function () {
    return Inertia::render('About', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
    ]);
})->name("about");
Route::get('/blog', function () {
    return Inertia::render('Blog', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
    ]);
})->name("blog");

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'user' => User::where("name", "Alif RJ")->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('dashboard/post', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name("my.post");
Route::get('dashboard/post{post:slug}', [PostController::class, 'edit'])->middleware(['auth', 'verified'])->name("edit.post");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
