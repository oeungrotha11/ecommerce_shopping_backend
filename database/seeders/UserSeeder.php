<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Ratha',
                'email' => 'ratha@example.com',
                'password' => '$2y$10$XVL04wV3MXBqrmzE4dw6oui23TRyPSkA5dw30EbgvyJ/.p76AqR6G',
                'phone' => '012345678',
                'address' => 'Phnom Penh',
                'role' => 'customer',
                'created_at' => '2026-09-03 08:55:23',
                'updated_at' => '2026-09-03 08:55:23',
            ],
            [
                'id' => 2,
                'name' => 'admin',
                'email' => 'admin@pitipiw.com',
                'password' => '$2y$10$p5to1dhynRFas2hxE3vs6.RcyN21FnMtl0llDrTzJCb5PDNeEMyZW',
                'phone' => '023456787',
                'address' => 'Phnom Penh',
                'role' => 'admin',
                'created_at' => '2026-09-08 01:57:42',
                'updated_at' => '2026-09-08 01:57:42',
            ],
        ]);
    }
}
