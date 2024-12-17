<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Userscontroller;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('pages.blog.index', [
        'blogs' => Post::all(),
        'recentBlogs' => Post::latest()->take(5)->get()
    ]);
})->name('dashboard');

require __DIR__ . '/auth.php';
require __DIR__ . '/noAuth.php';
