<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('posts')->insert([
      [
        'user_id' => 1,
        'category_id' => 1,
        'image_path' => 'images/sample1.jpg',
        'content' => '美唄の雪景色がとても綺麗でした！',
        'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => null,
      ],
      [
        'user_id' => 2,
        'category_id' => 1,
        'image_path' => 'images/sample2.jpg',
        'content' => '朝の澄んだ空気が最高です。',
        'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => null,
      ],
      [
        'user_id' => 3,
        'category_id' => 2,
        'image_path' => 'images/sample3.jpg',
        'content' => '紅葉が見事でした。',
        'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => null,
      ],
    ]);
  }
}
