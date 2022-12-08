<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
	public function index()
	{
		$posts = PostResource::collection(Post::where('user_id', auth()->id())->latest()->paginate(10))->response()->getData(true);
		$categories = Category::all();

		return inertia('Dashboard/Post/Index', compact('posts', 'categories'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required|string|unique:posts,title',
			'content' => 'required|string',
			'category' => 'required|numeric|exists:categories,id',
		]);

		$request['user_id'] = auth()->id();
		$request['slug'] = str($request->title)->slug('-');
		$request['category_id'] = $request->category;
		$request['image'] = $request->image ?? '/uploads/posts/default.png';

		Post::create($request->except('category'));

		return redirect(route('dashboard.posts.index'))->with('message', 'Post successfully created');
	}

	public function show(Post $post)
	{
		if ($post->user_id !== auth()->id()) {
			abort(404);
		}

		return inertia('Dashboard/Post/Show', compact('post'));
	}

	public function update(Request $request, Post $post)
	{
		$request->validate([
			'title' => "required|string|unique:posts,title,{$post->id}",
			'content' => 'required|string',
			'category' => 'required|numeric|exists:categories,id',
		]);

		$request['slug'] = str($request->title)->slug('-');
		$request['category_id'] = $request->category;

		// default -> default // nothing
		// img1 -> img1 // nothing
		// img1 -> default // nothing
		// default -> img1 // remove
		// img1 -> img2 // remove
		// default -> null // nothing
		// null -> null // nothing
		if (!str_contains($post->image, 'default.png') && $post->image != $request->image && $post->image != null && $post->image != "") {
			$path = storage_path('app/public/' . $post->image);

			if (file_exists($path)) {
				unlink($path);
			}
		}

		$post->update($request->except('category'));

		return redirect(route('dashboard.posts.index'))->with('message', 'Post successfully updated');
	}

	public function destroy(Post $post)
	{
		if ($post->image && !str_contains($post->image, 'default.png')) {
			$path = storage_path('app/public/' . $post->image);

			if (file_exists($path)) {
				unlink($path);
			}
		}

		$post->delete();

		return redirect(route('dashboard.posts.index'))->with('message', 'Post successfully deleted');
	}

	public function upload(Request $request)
	{
		if ($request->hasFile('image')) {
			return $request->file('image')->store('uploads/posts', 'public');
		}

		return false;
	}

	public function uploadRevert(Request $request)
	{
		if ($image = $request->get('image')) {
			$path = storage_path('app/public/' . $image);

			if (file_exists($path)) {
				unlink($path);
			}
		}

		return false;
	}
}
