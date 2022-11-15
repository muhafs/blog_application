<?php

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';


Route::get('/', function () {
    return inertia('Home');
})->name('home');

Route::get('/about', function () {
    return inertia('About');
})->name('about');

Route::controller(PostController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog');
    Route::get('/blog/{post:slug}', 'show')->name('blog-detail');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index')->name('category');
    Route::get('/category/{category:slug}', 'show')->name('category-detail');
});

//! Dashboard
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
