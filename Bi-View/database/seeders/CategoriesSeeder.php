<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
  public function run(): void
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('categories')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $themes = [
      ['month' => '2026-01', 'names' => [['name' => '氷点下の窓霜（まどしも）', 'type' => 'pro'], ['name' => 'わたしの特製・雪だるま', 'type' => 'everyone']]],
      ['month' => '2026-02', 'names' => [['name' => 'スノーランドの軌跡', 'type' => 'pro'], ['name' => 'あつあつ！美唄焼き鳥', 'type' => 'everyone']]],
      ['month' => '2026-03', 'names' => [['name' => '春を待つ滴（しずく）', 'type' => 'pro'], ['name' => 'ちいさな春みつけた', 'type' => 'everyone']]],
      ['month' => '2026-04', 'names' => [['name' => '宮島沼・マガンのねぐら立ち', 'type' => 'pro'], ['name' => '美唄のピンク色', 'type' => 'everyone']]],
      ['month' => '2026-05', 'names' => [['name' => '炭鉱遺産と星明かり', 'type' => 'pro'], ['name' => 'パクっ！とアスパラ', 'type' => 'everyone']]],
      ['month' => '2026-06', 'names' => [['name' => '水鏡（みずかがみ）の魔法', 'type' => 'pro'], ['name' => '雨上がりのキラキラ', 'type' => 'everyone']]],
      ['month' => '2026-07', 'names' => [['name' => '大理石と夏の影', 'type' => 'pro'], ['name' => '美唄の大きな雲', 'type' => 'everyone']]],
      ['month' => '2026-08', 'names' => [['name' => '大地のパッチワーク', 'type' => 'pro'], ['name' => 'つめたいおやつ', 'type' => 'everyone']]],
      ['month' => '2026-09', 'names' => [['name' => '黄金の波', 'type' => 'pro'], ['name' => '秋のむし、みーつけた', 'type' => 'everyone']]],
      ['month' => '2026-10', 'names' => [['name' => '錦秋のアルテピアッツァ', 'type' => 'pro'], ['name' => '大盛り！とりめし', 'type' => 'everyone']]],
      ['month' => '2026-11', 'names' => [['name' => '初雪の舞', 'type' => 'pro'], ['name' => 'ぽかぽかするもの', 'type' => 'everyone']]],
      ['month' => '2026-12', 'names' => [['name' => '静寂のホワイトアウト', 'type' => 'pro'], ['name' => 'きらきらイルミネーション', 'type' => 'everyone']]],
    ];

    $currentMonth = now()->format('Y-m');
    $rows = [];

    foreach ($themes as $theme) {
      foreach ($theme['names'] as $item) {
        $rows[] = [
          'name'         => $item['name'],
          'type'         => $item['type'],
          'target_month' => $theme['month'],
          'is_active'    => $theme['month'] === $currentMonth,
          'created_at'   => now(),
          'updated_at'   => now(),
        ];
      }
    }

    DB::table('categories')->insert($rows);
  }
}
