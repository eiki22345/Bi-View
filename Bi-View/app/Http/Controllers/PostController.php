<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  public function index(Request $request)
  {
    $categories = Category::where('is_active', true)->get();

    $sort        = $request->query('sort', 'new');        // new | popular
    $categoryId  = $request->query('category_id');        // null | id

    $query = Post::with(['user', 'category', 'likes']);

    if ($categoryId) {
      $query->where('category_id', $categoryId);
    }

    if ($sort === 'popular') {
      $query->withCount('likes')->orderByDesc('likes_count');
    } else {
      $query->latest();
    }

    $posts = $query->get();

    // カテゴリ別いいね数ランキング（各カテゴリ上位3件）
    $rankingByCategory = $categories->map(function ($cat) {
      return [
        'category' => $cat,
        'posts'    => Post::with('likes')
          ->where('category_id', $cat->id)
          ->withCount('likes')
          ->orderByDesc('likes_count')
          ->limit(3)
          ->get(),
      ];
    });

    return view('posts.index', compact('categories', 'posts', 'sort', 'categoryId', 'rankingByCategory'));
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

  public function toggleLike(Post $post)
  {
    $like = PostLike::where('user_id', Auth::id())->where('post_id', $post->id)->first();

    if ($like) {
      $like->delete();
      $liked = false;
    } else {
      PostLike::create([
        'user_id' => Auth::id(),
        'post_id' => $post->id,
      ]);
      $liked = true;
    }

    return response()->json([
      'is_liked'    => $liked,
      'likes_count' => $post->likes()->count(),
    ]);
  }
}
