<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // GET /api/admin/orders
    public function index()
    {
        $orders = Order::with([
            'user',
            'items',
            'payment',
        ])
        ->latest()
        ->get();

        return response()->json($orders);
    }

    // GET /api/admin/orders/{order}
    public function show(Order $order)
    {
        return response()->json(
            $order->load([
                'user',
                'items.productVariant.product',
                'items.productVariant.size',
                'items.productVariant.color',
                'payment',
            ])
        );
    }

    // PUT /api/admin/orders/{order}/status
    public function updateStatus(
        Request $request,
        Order $order
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,confirmed,processing,shipped,delivered,cancelled',
            ],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Order status updated',

            'order' => $order->load([
                'items',
                'payment',
            ]),
        ]);
    }

    // PUT /api/admin/orders/{order}/payment-status
    public function updatePaymentStatus(
        Request $request,
        Order $order
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,paid,failed,refunded',
            ],
        ]);

        $payment = $order->payment;

        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found',
            ], 404);
        }

        $payment->update([
            'status' => $validated['status'],
            'paid_at' =>
                $validated['status'] === 'paid'
                    ? now()
                    : null,
        ]);

        $order->update([
            'payment_status' =>
                $validated['status'],
        ]);

        return response()->json([
            'message' => 'Payment status updated',

            'payment' => $payment,
            'order' => $order,
        ]);
    }
}