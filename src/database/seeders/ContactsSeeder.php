<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

/**
 * お問い合わせシーダー
 */
class ContactsSeeder extends Seeder
{
    /**
     * お問い合わせの件数
     */
    const CONTACTS_COUNT = 35;

    /**
     * お問い合わせのデータを作成
     * @return void
     */
    public function run()
    {
        Contact::factory()->count(self::CONTACTS_COUNT)->create();
    }
}
