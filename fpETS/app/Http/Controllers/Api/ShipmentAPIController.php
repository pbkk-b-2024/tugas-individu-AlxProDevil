<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentAPIController extends Controller
{
    /**
     * Display a listing of shipments.
     */
    public function index()
    {
        $shipments = Shipment::with('order')->get();

        return response()->json($shipments, 200);
    }

    /**
     * Store the shipment details in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'shipment_date' => 'required|date',
            'carrier' => 'required|string|max:255',
            'tracking_number' => 'nullable|string|max:255',
            'delivery_status' => 'required|string|in:Shipped,Delivered',
        ]);

        $shipment = Shipment::create([
            'order_id' => $request->order_id,
            'shipment_date' => $request->shipment_date,
            'carrier' => $request->carrier,
            'tracking_number' => $request->tracking_number,
            'delivery_status' => $request->delivery_status,
        ]);

        $order = Order::findOrFail($request->order_id);
        $order->status = $request->delivery_status;
        $order->save();

        return response()->json([
            'message' => 'Shipment processed successfully.',
            'shipment' => $shipment
        ], 201);
    }

    /**
     * Show a specific shipment.
     */
    public function show($id)
    {
        $shipment = Shipment::with('order')->findOrFail($id);

        return response()->json($shipment, 200);
    }

    /**
     * Update the shipment details.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'shipment_date' => 'required|date',
            'carrier' => 'required|string|max:255',
            'tracking_number' => 'nullable|string|max:255',
            'delivery_status' => 'required|string|in:Shipped,Delivered',
        ]);

        $shipment = Shipment::findOrFail($id);

        $shipment->update([
            'shipment_date' => $request->shipment_date,
            'carrier' => $request->carrier,
            'tracking_number' => $request->tracking_number,
            'delivery_status' => $request->delivery_status,
        ]);

        $order = $shipment->order;
        $order->status = $request->delivery_status;
        $order->save();

        return response()->json([
            'message' => 'Shipment updated successfully.',
            'shipment' => $shipment
        ], 200);
    }

    /**
     * Delete a shipment.
     */
    public function destroy($id)
    {
        $shipment = Shipment::findOrFail($id);

        $shipment->delete();

        return response()->json(['message' => 'Shipment deleted successfully.'], 200);
    }
}
