<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sizes')->insert([
            ['id' => 1, 'name' => 'XXXL', 'created_at' => '2026-09-03 10:31:17', 'updated_at' => '2026-09-03 10:35:36'],
            ['id' => 2, 'name' => 'M', 'created_at' => '2026-09-03 10:32:17', 'updated_at' => '2026-09-03 10:32:17'],
            ['id' => 3, 'name' => 'L', 'created_at' => '2026-09-03 10:33:47', 'updated_at' => '2026-09-03 10:33:47'],
            ['id' => 4, 'name' => 'XL', 'created_at' => '2026-09-03 10:33:51', 'updated_at' => '2026-09-03 10:33:51'],
            ['id' => 5, 'name' => 'XXL', 'created_at' => '2026-09-03 10:33:55', 'updated_at' => '2026-09-03 10:33:55'],
        ]);
    }
}
