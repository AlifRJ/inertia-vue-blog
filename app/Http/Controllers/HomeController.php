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
        $posts = Post::latest()->with(['user', 'category'])->limit(9)->get();
        $posts->transform(function ($post) {
            $post->image = $post->image ? asset('storage/' . $post->image) : null;
            return $post;
        });
        $postCategories = PostCategory::latest()->get();

        return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'posts' => $posts,
        'postCategories' => $postCategories
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
        $posts =  Post::with(['user', 'category'])->latest()->paginate(12);
        $posts->transform(function ($post) {
            $post->image = $post->image ? asset('storage/' . $post->image) : null;
            return $post;
        });
        return Inertia::render('Blog', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'posts' => $posts
        ]);
    }
    public function blogDetail(Post $post)
    {
        $post->image = $post->image ? asset('storage/' . $post->image) : null;
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
