<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * カテゴリシーダー
 */
class CategorySeeder extends Seeder
{
    /**
     * カテゴリデータを作成
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'content' => '商品のお届けについて',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'content' => '商品の交換について',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'content' => '商品トラブル',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'content' => 'ショップへのお問い合わせ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'content' => 'その他',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
