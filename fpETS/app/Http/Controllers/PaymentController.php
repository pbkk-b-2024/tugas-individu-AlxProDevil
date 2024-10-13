<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function showPaymentPage($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        return view('orders.payment', compact('order'));
    }

    public function processPayment(Request $request, $orderId)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $order = Order::findOrFail($orderId);

        $payment = Payment::create([
            'order_id' => $orderId,
            'payment_method' => $request->payment_method,
            'status' => 'Pending',
        ]);

        $order->payment_status = 'Pending'; 
        $order->save();

        if ($request->payment_method === 'bank_transfer') {
            return redirect()->route('payment.uploadReceipt', $orderId)->with('success', 'Please upload the payment receipt.');
        } else {
            $payment->status = 'Completed';
            $payment->save();
            $order->payment_status = 'Completed';
            $order->save();
            return redirect()->route('orders.user')->with('success', 'Your order has been placed. Please pay on delivery.');
        }
    }

    public function showUploadReceipt($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('orders.upload_receipt', compact('order'));
    }

    public function uploadReceipt(Request $request, $orderId)
    {
        $request->validate([
            'receipt' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $order = Order::findOrFail($orderId);
        $payment = $order->payment;

        if ($request->hasFile('receipt')) {
            $filePath = $request->file('receipt')->store('receipts', 'public');
            $payment->receipt_path = $filePath;
            $payment->status = 'Pending';
            $payment->save();
            $order->payment_status = 'Pending';
            $order->save();

            return redirect()->route('orders.user')->with('success', 'Receipt uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload receipt.');
    }

    public function confirmPayment($orderId)
    {
        $order = Order::findOrFail($orderId);
        $payment = Payment::where('order_id', $orderId)->first();

        if ($payment && $payment->status === 'Pending') {
            $payment->status = 'Completed';
            $payment->save();

            $order->payment_status = 'Completed'; 
            $order->save();

            return redirect()->back()->with('success', 'Payment confirmed successfully.');
        }

        return redirect()->back()->with('error', 'Payment not found or already confirmed.');
    }
}