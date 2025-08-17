<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $table = 'order_products';

    protected $fillable = [
        'product_name',
        'product_sname',
        'Product_price',
        'category',
        'weight',
        'unit_of_measurement',
        'stock',
        'expiry_date',
        'Product_description',
        'Product_image',
    ];
    protected $casts = [
        'Product_price' => 'decimal:2',
        'expiry_date' => 'date',
    ];
}
