<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'coins',
        'referral_code',
        'password',
        'phone',
        'coupon',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
