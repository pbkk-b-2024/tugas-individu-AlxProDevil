<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch paginated products and return as JSON
        $products = Product::orderBy('created_at', 'DESC')->paginate(5);

        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        
        // Create a new product
        $product = Product::create($request->all());

        return response()->json(['message' => 'New product added!', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the product by ID or return a 404 error
        $product = Product::findOrFail($id);

        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        
        // Fetch the product by ID or return a 404 error
        $product = Product::findOrFail($id);

        // Update the product's data
        $product->update($request->all());

        return response()->json(['message' => 'Product updated!', 'product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the product by ID or return a 404 error
        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        return response()->json(['message' => 'Product removed!'], 200);
    }
}
