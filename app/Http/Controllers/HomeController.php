<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where("published", true)->latest()->with(['user', 'category'])->limit(6)->get();
        $posts->transform(function ($post) {
            $post->image = $post->image ? asset('storage/' . $post->image) : null;
            return $post;
        });
        $postCategories = PostCategory::latest()->limit(3)->get();

        return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'posts' => $posts,
        'postCategories' => $postCategories
        ]);
    }

    public function about()
    {
        return Inertia::render('About', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        ]);
    }

    public function blog()
    {
        $posts =  Post::where("published", true)->with(['user', 'category'])->latest()->paginate(12);
        $posts->transform(function ($post) {
            $post->image = $post->image ? asset('storage/' . $post->image) : null;
            return $post;
        });
        return Inertia::render('Blog', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
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
        'post' => $data,
        ]);
    }

    public function category()
    {
        $categories = PostCategory::latest()->paginate(12);
        $categories->transform(function ($post) {
            $post->image = $post->image ? asset('storage/' . $post->image) : null;
            return $post;
        });
        return Inertia::render('Category', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'categories' => $categories
        ]);
    }

    public function categoryDetail(PostCategory $category)
    {
        
        $posts = Post::where("published", true)->where("category_id", $category->id)->with(['user', 'category'])->paginate(12);

        $posts->transform(function ($post) {
            $post->image = $post->image ? asset('storage/' . $post->image) : null;
            return $post;
        });

        return Inertia::render('CategoryDetail', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'posts' => $posts,
        'category' => $category,
        ]);
    }
}
