<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolumeMockTest extends Model
{
    protected $fillable = [
        'title',
        'description',
        'mrp',
        'start_date',
        'validity',
        'is_active',
        'validity_type',
        'days',
        'mrp_one',
        'mrp_two',
        'mrp_three',
        'mrp_four',
        'mrp_five',
        'extend_type',
        'price',
        'paid',
        'price_one',
        'price_two',
        'price_three',
        'price_four',
        'price_five',
        'discount_one',
        'discount_two',
        'discount_three',
        'discount_four',
        'discount_five',
        'coin_percentage'
       
    ];

    protected $casts = [
        'start_date' => 'date',
        'is_active' => 'boolean',
    ];
}
