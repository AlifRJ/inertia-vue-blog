<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'posts' => Post::latest()->with(['user', 'category'])->limit(9)->get(),
        'postCategories' => PostCategory::latest()->get()
        ]);
    }
    public function about()
    {
        return Inertia::render('About', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        ]);
    }
    public function blog()
    {
        return Inertia::render('Blog', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'posts' => Post::with(['user', 'category'])->latest()->paginate(12)
        ]);
    }
    public function blogDetail(Post $post)
    {
        $data = $post->load([
            'user',
            'category'
        ]);
        return Inertia::render('BlogDetail', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'post' => $data,
        ]);
    }
}
