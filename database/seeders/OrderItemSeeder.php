<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_items')->insert([
            [
                'id' => 1,
                'order_id' => 1,
                'product_variant_id' => 1,
                'product_name' => 'Basic T-Shirt',
                'sku' => 'ZAN-TSH-001-BLK-S',
                'size_name' => 'XXXL',
                'color_name' => 'Black',
                'unit_price' => 15.00,
                'quantity' => 5,
                'subtotal' => 75.00,
                'created_at' => '2026-09-07 04:32:03',
                'updated_at' => '2026-09-07 04:32:03',
            ],
        ]);
    }
}
