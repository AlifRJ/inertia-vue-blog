<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $validated = $request->validate([
            'category_id'  => 'required|integer',
            'title'        => 'required|string|max:255',
            'image'        => 'nullable|image|max:2048',
            'body'         => 'required|string',
            'published'    => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Add auto-generated or authenticated fields
        $validated['user_id'] = Auth::id();

        // Create excerpt from body
        $plainText = strip_tags($request->body);
        $validated['excerpt'] = str($plainText)->words(10, '...');

        // Handle Boolean field safely
        $validated['published'] = $request->boolean('published');

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storePublicly('post_images', 'public');
        }

        // Handle published_at timestamp
        if ($validated['published'] && empty($validated['published_at'])) {
            $validated['published_at'] = Carbon::now();
        }

        // Create post using validated and processed data
        Post::create($validated);

        return redirect()->route('post.index')->with('success', 'Post Created Successfuly!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->image = $post->image ? asset('storage/' . $post->image) : null;
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
        $validated = $request->validate([
            'category_id'  => 'required|integer',
            'title'        => 'required|string|max:255',
            'image'        => 'nullable',
            'image.*'        => 'sometimes|image|max:2048',
            'body'         => 'required|string',
            'published'    => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Handle excerpt & booleans
        $plainText = strip_tags($request->body);
        $validated['excerpt'] = str($plainText)->words(10, '...');
        $validated['published'] = $request->boolean('published');

        // Handle published_at logic
        if ($validated['published'] && empty($post->published_at)) {
            $validated['published_at'] = Carbon::now();
        }

        // Handle image upload & old file cleanup
        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $validated['image'] = $request->file('image')->storePublicly('post_images', 'public');
        }

        // Reset slug if title changed
        if ($post->title !== $validated['title']) {
            $validated['slug'] = null; 
        }

        $post->update($validated);

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
            'ids.*' => 'integer|exists:posts,id',
        ]);

        // Delete Post by id from list
        Post::whereIn('id', $request->ids)->delete();

        return to_route('post.index')->with('success', count($request->ids) . ' Posts Deleted Successfuly!');
    }
}
