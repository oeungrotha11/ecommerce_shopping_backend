<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
     // GET /api/cart
    public function index(Request $request)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => $request->user()->id,
        ]);

        $cart->load([
            'items.productVariant.product',
            'items.productVariant.size',
            'items.productVariant.color',
        ]);

        $subtotal = 0;

        foreach ($cart->items as $item) {
            $price = $item->productVariant->price
                ?? $item->productVariant->product->base_price;

            $subtotal += $price * $item->quantity;
        }

        return response()->json([
            'cart' => $cart,
            'subtotal' => number_format($subtotal, 2, '.', ''),
        ]);
    }

    // POST /api/cart/items
    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = $request->user();

        $variant = ProductVariant::with('product')
            ->findOrFail($validated['product_variant_id']);

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $item = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_variant_id' => $variant->id,
        ]);

        $newQuantity = ($item->quantity ?? 0) + $validated['quantity'];

        if ($newQuantity > $variant->stock) {
            return response()->json([
                'message' => 'Not enough stock',
                'available_stock' => $variant->stock,
            ], 422);
        }

        $item->quantity = $newQuantity;
        $item->save();

        return response()->json([
            'message' => 'Product added to cart',
            'item' => $item->load([
                'productVariant.product',
                'productVariant.size',
                'productVariant.color',
            ]),
        ], 201);
    }

    // PUT /api/cart/items/{cartItem}
    public function updateItem(
        Request $request,
        CartItem $cartItem
    ) {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($cartItem->cart->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        $variant = $cartItem->productVariant;

        if ($validated['quantity'] > $variant->stock) {
            return response()->json([
                'message' => 'Not enough stock',
                'available_stock' => $variant->stock,
            ], 422);
        }

        $cartItem->update([
            'quantity' => $validated['quantity'],
        ]);

        return response()->json([
            'message' => 'Cart updated',
            'item' => $cartItem->load([
                'productVariant.product',
                'productVariant.size',
                'productVariant.color',
            ]),
        ]);
    }

    // DELETE /api/cart/items/{cartItem}
    public function removeItem(
        Request $request,
        CartItem $cartItem
    ) {
        if ($cartItem->cart->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        $cartItem->delete();

        return response()->json([
            'message' => 'Item removed from cart',
        ]);
    }

    // DELETE /api/cart
    public function clear(Request $request)
    {
        $cart = Cart::where('user_id', $request->user()->id)->first();

        if ($cart) {
            $cart->items()->delete();
        }

        return response()->json([
            'message' => 'Cart cleared',
        ]);
    }
}
