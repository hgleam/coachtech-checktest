<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * データベースシーダー
 */
class DatabaseSeeder extends Seeder
{
    /**
     * データベースシーダー
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            ContactsSeeder::class,
        ]);
    }
}
