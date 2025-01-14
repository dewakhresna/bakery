<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'product_name',
        'product_image',
        'price',
        'quantity',
        'sub_total_product',
        'total_quantity',
        'sub_total',
        'total_amount',
        'status',
    ];
}
