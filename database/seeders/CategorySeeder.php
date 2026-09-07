<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Men',
                'parent_id' => null,
                'created_at' => '2026-09-03 09:37:18',
                'updated_at' => '2026-09-03 09:37:18',
            ],
            [
                'id' => 3,
                'name' => 'Shoes',
                'parent_id' => 1,
                'created_at' => '2026-09-03 09:40:19',
                'updated_at' => '2026-09-03 09:40:19',
            ],
            [
                'id' => 4,
                'name' => 'New In',
                'parent_id' => 1,
                'created_at' => '2026-09-03 09:41:53',
                'updated_at' => '2026-09-03 09:41:53',
            ],
            [
                'id' => 5,
                'name' => 'Women',
                'parent_id' => null,
                'created_at' => '2026-09-03 09:42:00',
                'updated_at' => '2026-09-03 09:42:00',
            ],
            [
                'id' => 6,
                'name' => 'Clothing',
                'parent_id' => 5,
                'created_at' => '2026-09-03 09:42:15',
                'updated_at' => '2026-09-03 09:42:15',
            ],
            [
                'id' => 7,
                'name' => 'Shoes',
                'parent_id' => 5,
                'created_at' => '2026-09-03 09:42:35',
                'updated_at' => '2026-09-03 09:42:35',
            ],
            [
                'id' => 8,
                'name' => 'Dresses',
                'parent_id' => 5,
                'created_at' => '2026-09-03 09:42:41',
                'updated_at' => '2026-09-03 09:42:41',
            ],
        ]);
    }
}
