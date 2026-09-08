<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('brands')->insert([
            ['id' => 2, 'name' => '361°', 'logo' => '361.png', 'created_at' => '2026-09-03 10:11:03', 'updated_at' => '2026-09-03 10:11:03'],
            ['id' => 3, 'name' => 'Routine', 'logo' => 'routine.png', 'created_at' => '2026-09-03 10:11:14', 'updated_at' => '2026-09-03 10:11:14'],
            ['id' => 4, 'name' => 'Nike', 'logo' => 'nike.png', 'created_at' => '2026-09-03 10:11:21', 'updated_at' => '2026-09-03 10:11:21'],
        ]);
    }
}
