<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'productDetail_id',
        'quantity',
    ];

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'productDetail_id');
    }
}
