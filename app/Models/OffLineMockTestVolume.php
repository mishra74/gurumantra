<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffLineMockTestVolume extends Model
{ 
        use SoftDeletes;

    protected $fillable = ['title', 'thumbnail', 'zone_id', 'center_id', 'cbt', 'omr', 'meta_key', 'description', 'mrp', 'price', 'discount', 'start_date', 'end_date', 'payment_method', 'total_tests', 'is_active','deleted_at'];
}
