<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('orders.index', compact('products'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('orders.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('orders.cart')->with('error', 'Your cart is empty');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'Pending',
            'total_price' => $totalPrice,
            'shipping_address' => $request->shipping_address,
            'payment_status' => 'Unpaid',
        ]);

        foreach ($cart as $item) {
            $productId = $item['id'];  
            $product = Product::find($productId); 
            $product->quantity -= $item['quantity']; 
            $product->save(); 

            $order->orderProducts()->create([
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.user')->with('success', 'Order placed successfully');
    }

    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.user-orders', compact('orders'));
    }

    public function allOrders()
    {
        $orders = Order::with('user')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('orders.all-orders', compact('orders'));
    }
}