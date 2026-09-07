<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
     // POST /api/orders/{order}/payment
    public function store(
        Request $request,
        Order $order
    ) {
        if ($order->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        if ($order->payment) {
            return response()->json([
                'message' => 'Payment already exists for this order',
            ], 422);
        }

        $validated = $request->validate([
            'payment_method' => [
                'required',
                'in:cash_on_delivery,bank_transfer,online',
            ],
        ]);

        $payment = DB::transaction(function () use (
            $order,
            $validated
        ) {

            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_method' => $validated['payment_method'],
                'amount' => $order->total,
                'status' => 'pending',
            ]);

            return $payment;
        });

        return response()->json([
            'message' => 'Payment created successfully',
            'payment' => $payment,
        ], 201);
    }

    // GET /api/orders/{order}/payment
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
            $order->load('payment')
        );
    }
}
