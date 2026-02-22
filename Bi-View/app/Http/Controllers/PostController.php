<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  public function index()
  {
    $categories = Category::where('is_active', true)->get();
    $posts = Post::with(['user', 'category', 'likes'])->latest()->get();
    return view('posts.index', compact('categories', 'posts'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'image'       => ['required', 'image', 'max:5120'],
      'content'     => ['required', 'string', 'max:1000'],
      'category_id' => ['required', 'exists:categories,id'],
    ]);

    $path = $request->file('image')->store('posts', 'public');

    Post::create([
      'user_id'     => Auth::id(),
      'category_id' => $request->category_id,
      'image_path'  => $path,
      'content'     => $request->content,
    ]);

    return redirect()->route('posts.index')->with('success', '投稿しました！');
  }
}
