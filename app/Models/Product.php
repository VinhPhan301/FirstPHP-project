<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'name',
        'image',
        'price',
        'type',
        'sold_out'
    ];
}
