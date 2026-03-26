<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Center extends Model
{
            use SoftDeletes;

    protected $fillable = ['title','zone_id','is_active','location','thumbnail','discription'];
}
