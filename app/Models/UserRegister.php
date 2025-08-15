<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRegister extends Model
{
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
}
