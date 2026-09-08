<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->insert([
            [
                'id' => 1,
                'order_id' => 1,
                'payment_method' => 'bank_transfer',
                'amount' => 75.00,
                'status' => 'paid',
                'transaction_id' => null,
                'paid_at' => '2026-09-08 02:16:23',
                'created_at' => '2026-09-07 17:33:19',
                'updated_at' => '2026-09-08 02:16:23',
            ],
        ]);
    }
}
