<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('carts')->insert([
            ['id' => 1, 'user_id' => 1, 'created_at' => '2026-09-07 03:44:40', 'updated_at' => '2026-09-07 03:44:40'],
        ]);
    }
}
