<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'shipment_date',
        'carrier',
        'tracking_number',
        'delivery_status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}