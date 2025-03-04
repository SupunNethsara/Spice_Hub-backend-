<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'product_sname',
        'Product_price',
        'category', // Added category
        'weight', // Added weight
        'unit_of_measurement', // Added unit_of_measurement
        'stock', // Added stock
        'expiry_date', // Added expiry_date
        'Product_description',
        'Product_image', // Added Product_image
    ];
    protected $casts = [
        'Product_price' => 'decimal:2', // Cast price to decimal
        'expiry_date' => 'date', // Cast expiry date to a date format
    ];
}
