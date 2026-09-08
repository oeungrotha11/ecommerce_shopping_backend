<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_variants')->insert([
            [
                'id'         => 1,
                'product_id' => 1,
                'size_id'    => 1,
                'color_id'   => 1,
                'sku'        => 'ZAN-TSH-001-BLK-S',
                'price'      => 15.00,
                'stock'      => 5,
                'image'      => null,
                'created_at' => '2026-09-05 09:38:05',
                'updated_at' => '2026-09-07 04:32:03',
            ],
            [
                'id'         => 2,
                'product_id' => 1,
                'size_id'    => 2,
                'color_id'   => 1,
                'sku'        => 'ZAN-TSH-001-BLK-M',
                'price'      => 15.00,
                'stock'      => 20,
                'image'      => null,
                'created_at' => '2026-09-05 09:39:36',
                'updated_at' => '2026-09-05 09:39:36',
            ],
            [
                'id'         => 3,
                'product_id' => 1,
                'size_id'    => 3,
                'color_id'   => 1,
                'sku'        => 'ZAN-TSH-001-BLK-L',
                'price'      => 15.00,
                'stock'      => 15,
                'image'      => null,
                'created_at' => '2026-09-05 09:40:16',
                'updated_at' => '2026-09-05 09:40:16',
            ],
            [
                'id'         => 4,
                'product_id' => 1,
                'size_id'    => 2,
                'color_id'   => 2,
                'sku'        => 'ZAN-TSH-001-WHT-M',
                'price'      => 15.00,
                'stock'      => 8,
                'image'      => null,
                'created_at' => '2026-09-05 09:41:17',
                'updated_at' => '2026-09-05 09:41:17',
            ],
        ]);
    }
}
