<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PostController::class, 'index'])->middleware(['auth','verified'])->name('posts.index');





require __DIR__.'/auth.php';

Route::get('/posts', [PostController::class, 'index'])->middleware('auth','verified')->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth','verified')->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])->middleware('auth','verified')->name('posts.store');


Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware(['auth', 'verified'])->name('posts.edit');


Route::get('/posts/{post}', [PostController::class, 'show'])->middleware(['auth','verified'])->name('posts.show');

Route::patch('/posts/{post}', [PostController::class, 'update'])->middleware(['auth', 'verified'])->name('posts.update');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware(['auth', 'verified'])->name('posts.destroy');

