<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffLineMockTestVolume extends Model
{ 
        use SoftDeletes;

    protected $fillable = ['title', 'thumbnail', 'cbt', 'omr', 'meta_key', 'description',  'discount', 'start_date', 'end_date', 'payment_method','is_active','deleted_at'];
// OffLineMockTestVolume.php
public function centerPrices()
{
    return $this->hasMany(CenterPrice::class, 'mock_test_volume_id');
}
    }
