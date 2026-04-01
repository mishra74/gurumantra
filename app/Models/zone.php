<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

        
class Zone extends Model
{ 
        use SoftDeletes;
    protected $fillable = ['title','is_active','thumbnail'];
    public function centers()
{
    return $this->hasMany(Center::class, 'zone_id');
}
}
