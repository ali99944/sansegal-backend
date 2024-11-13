<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'price',
        'discount',
        'quantity',
        'total_price',
        'image'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
