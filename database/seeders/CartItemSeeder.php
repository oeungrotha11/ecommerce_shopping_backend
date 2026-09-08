<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cart_items')->insert([
            ['id' => 2, 'cart_id' => 1, 'product_variant_id' => 1, 'quantity' => 1, 'created_at' => '2026-09-08 13:34:34', 'updated_at' => '2026-09-08 13:34:34'],
        ]);
    }
}
