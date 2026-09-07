<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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
}
