<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$posts = PostResource::collection(Post::where('user_id', auth()->id())->latest()->paginate(10))->response()->getData(true);

		// return $posts;
		return inertia('Dashboard/Post/Index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$categories = Category::get(['id', 'name']);

		return inertia('Dashboard/Post/Create', compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required|string|unique:posts,title',
			'content' => 'required|string',
			'category_id' => 'required|numeric|exists:categories,id',
		]);

		$request['user_id'] = auth()->id();
		$request['slug'] = str($request->title)->slug('-');

		Post::create($request->all());

		return redirect(route('dashboard.posts.index'))->with('message', 'Post successfully created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function show(Post $post)
	{
		if ($post->user_id !== auth()->id()) {
			abort(404);
		}

		return inertia('Dashboard/Post/Show', compact('post'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $post)
	{
		if ($post->user_id !== auth()->id()) {
			abort(404);
		}

		$categories = Category::all();

		return inertia('Dashboard/Post/Edit', compact('post', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Post $post)
	{
		$request->validate([
			'title' => "required|string|unique:posts,title,{$post->id}",
			'content' => 'required|string',
			'category_id' => 'required|numeric|exists:categories,id',
		]);

		$request['slug'] = str($request->title)->slug('-');

		$post->update($request->all());

		return redirect(route('dashboard.posts.index'))->with('message', 'Post successfully updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Post $post)
	{
		$post->delete();

		return redirect(route('dashboard.posts.index'))->with('message', 'Post deleted successfully');
	}
}
