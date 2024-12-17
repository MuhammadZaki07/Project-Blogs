<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoryController;


Route::get('blogs/blogView/{slug}', [BlogsController::class, 'show'])->name('blogView');
Route::get('categories/details/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('category', [CategoryController::class, 'search'])->name('category.search');
Route::get('categories', [CategoryController::class, 'index'])->name('category.page');

Route::get('blogs/user/{userId}', [BlogsController::class, 'showByUser'])->name('blogs.byUser');
Route::get('blogs', [BlogsController::class, 'search'])->name('blogs.search');
Route::post('blogs/{id}/comment', [BlogsController::class, 'storeComment'])->name('blogs.comment');
