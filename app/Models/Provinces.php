<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $table = 'provinces';

    protected $fillable = [
        'name',
    ];
    public function districts()
    {
        return $this->hasMany(Districts::class);
    }

    public function shippingPayments()
    {
        return $this->hasMany(ShippingPayments::class);
    }
}
