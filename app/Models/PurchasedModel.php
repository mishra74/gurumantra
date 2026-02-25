<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasedModel extends Model
{
    protected $table = 'orderd';
    protected $fillable = [
        'user_id','notes_volume','test_volume','test_id','batch_volume',
        'price','order_number','rezorpay_orderID','razorpay_payment_id','razorpay_signature'
    ];
}
