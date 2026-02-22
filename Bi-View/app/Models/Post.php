<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'user_id',
    'category_id',
    'image_path',
    'content',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function likes()
  {
    return $this->hasMany(PostLike::class);
  }
}
