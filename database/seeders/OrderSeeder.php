<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'order_number' => 'ORD-6A9E3E4347174',
                'subtotal' => 75.00,
                'shipping_fee' => 0.00,
                'total' => 75.00,
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'shipping_name' => 'John Doe',
                'shipping_phone' => '012345678',
                'shipping_address' => 'Phnom Penh, Cambodia',
                'placed_at' => '2026-09-07 04:32:03',
                'created_at' => '2026-09-07 04:32:03',
                'updated_at' => '2026-09-08 02:16:23',
            ],
        ]);
    }
}
