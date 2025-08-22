<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class UserRegister extends Model
{
    use HasApiTokens;

    protected $table = 'user_registration';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function details()
    {
        return $this->hasOne(UserDetails::class, 'user_registration_id');
    }


}
