<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'productDetail_id',
        'quantity',
        'price',
        'total_price'
    ];
    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'productDetail_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
