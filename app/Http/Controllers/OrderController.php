<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
     // GET /api/orders
    public function index(Request $request)
    {
        $orders = Order::with('items')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json($orders);
    }

    // GET /api/orders/{order}
    public function show(
        Request $request,
        Order $order
    ) {
        if ($order->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        return response()->json(
            $order->load([
                'items.productVariant.product',
                'items.productVariant.size',
                'items.productVariant.color',
            ])
        );
    }

    public function cancel(Request $request, Order $order)
{
    $order->load('items');

    if ($order->user_id !== $request->user()->id) {
        return response()->json([
            'message' => 'You are not allowed to cancel this order.',
        ], 403);
    }

    if (!in_array($order->status, ['pending', 'confirmed'])) {
        return response()->json([
            'message' => 'This order cannot be cancelled.',
        ], 422);
    }

    DB::transaction(function () use ($order) {

        // 3. Restore stock
        foreach ($order->items as $item) {

            if (!$item->product_variant_id) {
                continue;
            }

            $variant = ProductVariant::lockForUpdate()
                ->find($item->product_variant_id);

            if ($variant) {
                $variant->increment('stock', $item->quantity);
            }
        }

        // 4. Cancel order
        $order->update([
            'status' => 'cancelled',
        ]);
    });

    // 5. Return updated order
    $order->load([
        'items',
        'payment',
    ]);

    return response()->json([
        'message' => 'Order cancelled successfully.',
        'data' => $order,
    ]);
}
}
