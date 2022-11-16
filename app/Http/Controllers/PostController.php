<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

	public function index(Request $request)
	{
		$posts = Post::query()
			->when($request->search, function ($query, $search) {
				$query->where('title', 'like', "%{$search}%");
				// ->orWhere('content', 'like', "%{$search}%");
			})
			->orderBy('id', 'desc')
			->paginate(10)
			->withQueryString();

		$filters = $request->only('search');

		return inertia('Post/Index', compact('posts', 'filters'));
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
