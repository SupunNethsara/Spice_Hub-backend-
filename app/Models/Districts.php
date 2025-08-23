<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'name',
        'province_id',
    ];
    public function province()
    {
        return $this->belongsTo(provinces::class);
    }

    public function ShippingPayments()
    {
        return $this->hasMany(ShippingPayments::class);
    }
}
