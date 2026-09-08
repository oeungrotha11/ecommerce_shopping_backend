<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('wishlists')->insert([
            ['id' => 1, 'user_id' => 1, 'product_id' => 1, 'created_at' => '2026-09-07 03:38:27', 'updated_at' => '2026-09-07 03:38:27'],
        ]);
    }
}
