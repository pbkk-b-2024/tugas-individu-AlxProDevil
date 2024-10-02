<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrderAPIController extends Controller
{
    // Show available products (index)
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'data' => $products,
        ], 200);
    }

    // Show the user's cart
    public function cart()
    {
        $cart = session()->get('cart', []);
        return response()->json([
            'success' => true,
            'data' => $cart,
        ], 200);
    }

    // Add a product to the cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart' => $cart,
        ], 200);
    }

    // Remove an item from the cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart',
            'cart' => $cart,
        ], 200);
    }

    // Checkout and create an order
    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty',
            ], 400);
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'Pending',
            'total_price' => $totalPrice,
            'shipping_address' => $request->shipping_address,
            'payment_status' => 'Unpaid',
        ]);

        // Clear the cart
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully',
            'order' => $order,
        ], 201);
    }

    // Show user orders
    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return response()->json([
            'success' => true,
            'data' => $orders,
        ], 200);
    }

    // Show all orders (for staff/admin)
    public function allOrders()
    {
        $orders = Order::with('user')
            ->orderBy('created_at', 'DESC')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders,
        ], 200);
    }
}