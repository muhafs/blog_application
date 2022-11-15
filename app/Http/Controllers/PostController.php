<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->get();
        return inertia('Post/Index', compact('posts'));
    }

    public function create()
    {
        //
    }

    public function store(StorePostRequest $request)
    {
        //
    }

    // public function show(Post $post)
    public function show(Post $post)
    {
        return inertia('Post/Show', compact('post'));
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
