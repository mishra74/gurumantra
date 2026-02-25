<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'package_name',
        'package_type',
        'course_type',
        'package_validity',
        'mrp',
        'price',
        'discount',
        'expire_at',
        'package_key',
        'is_active',
    ];

    protected $casts = [
        'expire_at' => 'date',
        'is_active' => 'boolean',
    ];
}
