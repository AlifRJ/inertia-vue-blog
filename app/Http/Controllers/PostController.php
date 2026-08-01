<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return all user posts/articles
        $post = Auth::user()
        ->posts()
        ->with('category')
        ->latest()
        ->paginate(10);
        return Inertia::render('Post/Post',['posts' => $post]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return create form with categories
        $category = PostCategory::all();
        return Inertia::render('Post/PostCreate',['categories' => $category]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Request validation
        $request->validate([
            'category_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            "published" => 'boolean',
            "published_at" => 'nullable|date'
        ]);

        // Create excerpt
        $plainText = strip_tags($request->body);
        $excerpt = str($plainText)->words(10, '...');

        // Define input
        $data = [
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
                'title' => $request->title,
                'excerpt' => $excerpt,
                'body' => $request->body,
                'published' => $request->boolean('published'),
            ];
        if ($request->published) {
            $data['published_at'] = Carbon::now();
        }

        // Create post
        Post::create($data);

        return redirect()->route('post.index')->with('success', 'Post Created Successfuly!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Show specified user post
        $post->load('user', "category");
        return Inertia::render('Post/PostDetail',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Return edit form with categories
        $category = PostCategory::all();
        return Inertia::render('Post/PostEdit',['post'=>$post,'categories'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Request Validation
        $request->validate([
            'category_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            "published" => 'boolean',
            "published_at" => 'nullable|date'
        ]);

        $plainText = strip_tags($request->body);

        // Update post with request
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->excerpt = str($plainText)->words(10, '...');
        $post->published = $request->boolean('published');
        if ($request->published && !$post->published_at) {
            $post->published_at = Carbon::now();
        }

        // reset slug: enabling sluggable
        $post->slug = null; 

        // save post
        $post->save();

        return redirect()->route('post.index')->with('success', 'Post Updated Successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return to_route('post.index')->with('message', 'Post Deleted Successfuly!');
    }

    /**
     * Bulk remove the specified resource from storage.
     */
    public function bulkDestroy(Request $request)
    {
        // List validation
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:posts,id', // Memastikan setiap ID valid dan ada di database
        ]);

        // Delete Post by id from list
        Post::whereIn('id', $request->ids)->delete();

        return to_route('post.index')->with('success', count($request->ids) . ' Posts Deleted Successfuly!');
    }
}
