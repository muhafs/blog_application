<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	public function index()
	{
		$categories = Category::latest()->get();

		return inertia('Dashboard/Category/Index', compact('categories'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|unique:categories,name',
		]);

		$request['slug'] = str($request->name)->slug('-');
		$request['image'] = $request->image ?? '/uploads/categories/default.png';

		Category::create($request->only('name', 'slug', 'image'));

		return redirect(route('dashboard.categories.index'))->with('message', 'Category successfully created');
	}

	public function update(Request $request, Category $category)
	{
		$request->validate([
			'name' => "required|string|unique:categories,name,{$category->id}"
		]);

		$request['slug'] = str($request->name)->slug('-');

		// default -> default // nothing
		// img1 -> img1 // nothing
		// img1 -> default // nothing
		// default -> img1 // remove
		// img1 -> img2 // remove
		// default -> null // nothing
		// null -> null // nothing
		if (!str_contains($category->image, 'default.png') && $category->image != $request->image && $category->image != null && $category->image != "") {
			$path = storage_path('app/public/' . $category->image);

			if (file_exists($path)) {
				unlink($path);
			}
		}

		$category->update($request->all());

		return redirect(route('dashboard.categories.index'))->with('message', 'Category successfully updated');
	}

	public function destroy(Category $category)
	{
		if ($category->image && !str_contains($category->image, 'default.png')) {
			$path = storage_path('app/public/' . $category->image);

			if (file_exists($path)) {
				unlink($path);
			}
		}

		$category->delete();

		return redirect(route('dashboard.categories.index'))->with('message', 'Category successfully deleted');
	}

	public function upload(Request $request)
	{
		if ($request->hasFile('image')) {
			return $request->file('image')->store('uploads/categories', 'public');
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
