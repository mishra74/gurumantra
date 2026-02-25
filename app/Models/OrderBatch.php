<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderBatch extends Model
{
    protected $fillable = [
        'user_id',
        'test_volume',
        'type',
        'test_id',
        'price',
        'order_number',
        'razorpay_orderID',
        'razorpay_payment_id',
        'razorpay_signature'
    ];
}
