<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'name', 'discount_type', 'value', 'class_type', 'batches', 'test_series', 'notes', 'recording_room', 'all', 'coupon_for_scholarship', 'coupon_for_gn_package', 'coupon_for_influencer', 'coupon_for_all', 'minimum_price', 'coupon_code','is_active'
    ];

    
}
