<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BrandSeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,

            // ProductSeeder and ProductVariantSeeder should run before these
            // because cart_items, order_items, and wishlists reference them.
            CartSeeder::class,
            WishlistSeeder::class,
            OrderSeeder::class,
            PaymentSeeder::class,
            CartItemSeeder::class,
            OrderItemSeeder::class,
        ]);
    }
}
