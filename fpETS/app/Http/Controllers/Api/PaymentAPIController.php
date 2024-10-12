<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentAPIController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'DESC')->paginate(5);
        return response()->json($payments, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|string',
        ]);

        $payment = Payment::create([
            'order_id' => $request->order_id,
            'payment_method' => $request->payment_method,
            'status' => 'Pending',
        ]);

        return response()->json(['message' => 'Payment initiated!', 'payment' => $payment], 201);
    }

    public function show(string $id)
    {
        $payment = Payment::findOrFail($id);
        return response()->json($payment, 200);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        return response()->json(['message' => 'Payment updated!', 'payment' => $payment], 200);
    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['message' => 'Payment deleted!'], 200);
    }
}
