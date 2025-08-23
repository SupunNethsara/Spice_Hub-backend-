<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingPayments extends Model
{
    protected $table = 'shipping_payments';

    protected $fillable = ['province_id', 'district_id', 'amount'];

    public function province()
    {
        return $this->belongsTo(Provinces::class);
    }

    public function district()
    {
        return $this->belongsTo(Districts::class);
    }
}
