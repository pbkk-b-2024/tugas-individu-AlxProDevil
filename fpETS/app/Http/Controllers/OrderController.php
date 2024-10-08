<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show available products (index)
    public function index()
    {
        $products = Product::all();
        return view('orders.index', compact('products'));
    }

    // Show the user's cart
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('orders.cart', compact('cart'));
    }

    // Add a product to the cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        // Add one item to the cart on each button click
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => 1, // Initial quantity is 1
                'price' => $product->price,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // Remove an item from the cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart');
    }

    // Checkout and create an order
    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('orders.cart')->with('error', 'Your cart is empty');
        }

        // Calculate the total price
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

        // Decrement the quantity of each product and create order items
        foreach ($cart as $item) {
            $productId = $item['id'];  // Retrieve the 'id' key from the cart item
            $product = Product::find($productId);  // Find product by ID
            $product->quantity -= $item['quantity'];  // Decrement the quantity
            $product->save();  // Save the product

            // Create order items
            $order->orderProducts()->create([
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
            ]);
        }

        // Clear the cart after successful order creation
        session()->forget('cart');

        return redirect()->route('orders.user')->with('success', 'Order placed successfully');
    }

    // Show user orders
    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.user-orders', compact('orders'));
    }

    public function allOrders()
    {
        // Fetch all orders
        $orders = Order::with('user') // Assuming you have a relation to get user details
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('orders.all-orders', compact('orders'));
    }
}