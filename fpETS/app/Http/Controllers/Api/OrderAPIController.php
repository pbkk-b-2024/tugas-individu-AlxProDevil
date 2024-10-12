<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderAPIController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(5);
        return response()->json($orders, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
            'total_price' => 'required|numeric',
            'shipping_address' => 'required|string',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => $request->status,
            'total_price' => $request->total_price,
            'shipping_address' => $request->shipping_address,
            'payment_status' => 'Unpaid',
        ]);

        return response()->json(['message' => 'Order placed successfully!', 'order' => $order], 201);
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order, 200);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string',
            'total_price' => 'required|numeric',
            'shipping_address' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return response()->json(['message' => 'Order updated!', 'order' => $order], 200);
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted!'], 200);
    }
}
