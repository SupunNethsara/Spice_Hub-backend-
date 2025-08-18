<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $table = 'user_details';
    protected $fillable = [
        'user_registration_id',
        'name',
        'email',
        'province',
        'district',
        'city',
        'address',
        'postal_code',
        'phone',
    ];
    protected $attributes = [
        'province' => null,
        'district' => null,
        'city' => null,
        'address' => null,
        'postal_code' => null,
        'phone' => null,
    ];
    public function user()
    {
        return $this->belongsTo(UserRegister::class, 'user_registration_id');
    }
}
