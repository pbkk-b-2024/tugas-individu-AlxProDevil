<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderAPIController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->orderBy('created_at', 'DESC')->paginate(5);
        return response()->json($orders, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string',
        ]);

        $totalPrice = 0;

        foreach ($request->products as $product) {
            $productModel = Product::find($product['product_id']);
            
            if ($productModel->quantity < $product['quantity']) {
                return response()->json([
                    'message' => "Insufficient stock for product: {$productModel->name}",
                ], 400); 
            }

            $totalPrice += $productModel->price * $product['quantity'];
        }

        $order = Order::create([
            'user_id' => $request->user_id,
            'status' => 'Pending',
            'total_price' => $totalPrice,
            'shipping_address' => $request->shipping_address,
            'payment_status' => 'Unpaid',
        ]);

        foreach ($request->products as $product) {
            $productModel = Product::find($product['product_id']);

            $productModel->quantity -= $product['quantity'];
            $productModel->save();

            $order->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'], 
            ]);
        }

        return response()->json([
            'message' => 'Order placed successfully!',
            'order' => $order->load('products')
        ], 201);
    }

    public function show(string $id)
    {
        $order = Order::with('products')->findOrFail($id);
        return response()->json($order, 200);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string',
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