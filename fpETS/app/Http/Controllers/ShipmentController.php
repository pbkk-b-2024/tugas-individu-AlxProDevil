<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->where('payment_status', 'Completed')->get();

        return view('shipments.index', compact('orders'));
    }

    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('shipments.create', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
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
        if ($request->delivery_status === 'Shipped') {
            $order->status = 'Shipped';
        } elseif ($request->delivery_status === 'Delivered') {
            $order->status = 'Delivered';
        }
        $order->save();

        return redirect()->route('shipments.index')->with('success', 'Shipment processed successfully.');
    }

    public function show($id)
    {
        $shipment = Shipment::with('order')->findOrFail($id);

        return view('shipments.show', compact('shipment'));
    }

    public function edit($id)
    {
        $shipment = Shipment::findOrFail($id);

        return view('shipments.edit', compact('shipment'));
    }

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
        if ($request->delivery_status === 'Shipped') {
            $order->status = 'Shipped';
        } elseif ($request->delivery_status === 'Delivered') {
            $order->status = 'Delivered';
        }
        $order->save();

        return redirect()->route('shipments.index')->with('success', 'Shipment updated successfully.');
    }
}