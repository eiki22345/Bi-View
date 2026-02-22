<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('users')->insert([
      [
        'nickname' => 'テストユーザー1',
        'email' => 'user1@example.com',
        'password' => Hash::make('password'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'nickname' => 'テストユーザー2',
        'email' => 'user2@example.com',
        'password' => Hash::make('password'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'nickname' => 'テストユーザー3',
        'email' => 'user3@example.com',
        'password' => Hash::make('password'),
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
