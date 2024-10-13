<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('created_at', 'DESC')->paginate(5);

        return response()->json($suppliers, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:100',
            'address' => 'required|string',
        ]);
        
        $supplier = Supplier::create($request->all());

        return response()->json(['message' => 'New supplier added!', 'supplier' => $supplier], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        return response()->json($supplier, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:100',
            'address' => 'required|string',
        ]);
        
        $supplier = Supplier::findOrFail($id);

        $supplier->update($request->all());

        return response()->json(['message' => 'Supplier updated!', 'supplier' => $supplier], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return response()->json(['message' => 'Supplier removed!'], 200);
    }
}