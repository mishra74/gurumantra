<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    protected $fillable = [
        'volume_id',
       
        'title',
        
        'last_time',
        'pdf_file_question',
        'pdf_enter_question',
        'pdf_file_answer',
        'pdf_enter_answer',
        'meta_key',
        'is_active',
        'description',
        'validity',
        'validity_type', 'mrp', 'price', 'discount', 'coin_percentage','paid','thumbnail'
        // add more database fields here
    ];
}
