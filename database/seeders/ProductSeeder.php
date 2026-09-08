<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'id'          => 1,
            'category_id' => 1,
            'brand_id'    => 2,
            'code'        => 'ZAN-TSH-001',
            'name'        => 'Basic T-Shirt',
            'description' => 'Comfortable cotton t-shirt',
            'base_price'  => 15.00,
            'image'       => 'tshirt.jpg',
            'status'      => 'active',
            'created_at'  => '2026-09-05 09:07:42',
            'updated_at'  => '2026-09-05 09:07:42',
        ]);
    }
}
