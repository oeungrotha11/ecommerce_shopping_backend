<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
   public function store(Request $request)
{
    $validated = $request->validate([
        'shipping_name' => 'required|string|max:255',
        'shipping_phone' => 'required|string|max:50',
        'shipping_address' => 'required|string',

        'payment_method' => [
            'required',
            'in:cash_on_delivery,bank_transfer,online',
        ],
    ]);

    $user = $request->user();

    $order = DB::transaction(function () use ($user, $validated) {

        $cart = Cart::where('user_id', $user->id)
            ->with([
                'items.productVariant.product',
                'items.productVariant.size',
                'items.productVariant.color',
            ])
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            abort(422, 'Cart is empty');
        }

        $subtotal = 0;

        foreach ($cart->items as $cartItem) {

            $variant = ProductVariant::with('product')
                ->lockForUpdate()
                ->find($cartItem->product_variant_id);

            if (!$variant) {
                abort(422, 'Product variant no longer exists');
            }

            if ($cartItem->quantity > $variant->stock) {
                abort(
                    422,
                    "Not enough stock for SKU {$variant->sku}"
                );
            }

            $price = $variant->price
                ?? $variant->product->base_price;

            $subtotal += $price * $cartItem->quantity;
        }

        $shippingFee = 0;

        $total = $subtotal + $shippingFee;

        // Create Order
        $order = Order::create([
            'user_id' => $user->id,

            'order_number' =>
                'ORD-' . strtoupper(uniqid()),

            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'total' => $total,

            'status' => 'pending',
            'payment_status' => 'pending',

            'shipping_name' =>
                $validated['shipping_name'],

            'shipping_phone' =>
                $validated['shipping_phone'],

            'shipping_address' =>
                $validated['shipping_address'],

            'placed_at' => now(),
        ]);

        // Create Order Items
        foreach ($cart->items as $cartItem) {

            $variant = ProductVariant::with([
                'product',
                'size',
                'color',
            ])->find($cartItem->product_variant_id);

            $price = $variant->price
                ?? $variant->product->base_price;

            $itemSubtotal =
                $price * $cartItem->quantity;

            $order->items()->create([
                'product_variant_id' =>
                    $variant->id,

                'product_name' =>
                    $variant->product->name,

                'sku' =>
                    $variant->sku,

                'size_name' =>
                    $variant->size->name,

                'color_name' =>
                    $variant->color->name,

                'unit_price' =>
                    $price,

                'quantity' =>
                    $cartItem->quantity,

                'subtotal' =>
                    $itemSubtotal,
            ]);

            // Decrease stock
            $variant->decrement(
                'stock',
                $cartItem->quantity
            );
        }

        // Create Payment
        $order->payment()->create([
            'payment_method' =>
                $validated['payment_method'],

            'amount' => $total,

            'status' => 'pending',
        ]);

        // Clear cart
        $cart->items()->delete();

        return $order;
    });

    return response()->json([
        'message' => 'Checkout successful',

        'order' => $order->load([
            'items',
            'payment',
        ]),
    ], 201);
}
}
