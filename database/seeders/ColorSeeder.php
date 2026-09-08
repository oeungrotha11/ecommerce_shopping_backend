<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('colors')->insert([
            ['id' => 1, 'name' => 'Black', 'hex_code' => '#000000', 'created_at' => '2026-09-03 10:38:32', 'updated_at' => '2026-09-03 10:38:32'],
            ['id' => 2, 'name' => 'White', 'hex_code' => '#FFFFFF', 'created_at' => '2026-09-03 10:38:45', 'updated_at' => '2026-09-03 10:38:45'],
            ['id' => 3, 'name' => 'Red', 'hex_code' => '#FF0000', 'created_at' => '2026-09-03 10:38:53', 'updated_at' => '2026-09-03 10:38:53'],
            ['id' => 4, 'name' => 'Blue', 'hex_code' => '#0000FF', 'created_at' => '2026-09-03 10:39:04', 'updated_at' => '2026-09-03 10:39:04'],
        ]);
    }
}
