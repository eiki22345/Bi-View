<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostLikesSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('post_likes')->insert([
      [
        'user_id' => 2,
        'post_id' => 1,
        'created_at' => now(),
      ],
      [
        'user_id' => 3,
        'post_id' => 1,
        'created_at' => now(),
      ],
      [
        'user_id' => 1,
        'post_id' => 2,
        'created_at' => now(),
      ],
    ]);
  }
}
