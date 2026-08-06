<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()?->isAdmin()){
            $categories = PostCategory::latest()->paginate(10);
            return Inertia::render('PostCategory/PostCategory',['categories' => $categories]); 
        }
        return to_route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('PostCategory/PostCategoryCreate'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Request validation
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            // 'image'        => 'nullable|image|max:2048',
            'detail'         => 'required|string',
        ]);   

        // dd($validated);

        // Handle Image Upload
        // if ($request->hasFile('image')) {
        //     $validated['image'] = $request->file('image')->storePublicly('post_images', 'public');
        // }

        // Create post using validated and processed data
        PostCategory::create($validated);

        return redirect()->route('category.index')->with('success', 'Category Created Successfuly!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $postCategory)
    {
        return Inertia::render('PostCategory/PostCategoryDetail',['category' => $postCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $postCategory)
    {
        // Return edit form with categories
        return Inertia::render('PostCategory/PostCategoryEdit',['categories'=>$postCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostCategory $postCategory)
    {
        // dd($request);
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            // 'image'        => 'nullable',
            // 'image.*'        => 'sometimes|image|max:2048',
            'detail'         => 'required|string',
        ]);

        // Handle image upload & old file cleanup
        // if ($request->hasFile('image')) {
        //     if ($post->image && Storage::disk('public')->exists($post->image)) {
        //         Storage::disk('public')->delete($post->image);
        //     }

        //     $validated['image'] = $request->file('image')->storePublicly('post_images', 'public');
        // }

        // Reset slug if title changed
        if ($postCategory->title !== $validated['title']) {
            $validated['slug'] = null; 
        }

        $postCategory->update($validated);

        return redirect()->route('category.index')->with('success', 'Category Updated Successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();

        return to_route('category.index')->with('message', 'Category Deleted Successfuly!');
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
        PostCategory::whereIn('id', $request->ids)->delete();

        return to_route('post.index')->with('success', count($request->ids) . ' Categories Deleted Successfuly!');
    }
}
