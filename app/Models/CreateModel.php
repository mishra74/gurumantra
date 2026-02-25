<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateModel extends Model
{
    use SoftDeletes;

    protected $table = 'create_test';

    protected $fillable = [
        'volume_id',
        'live_class',
        'start_time',
        'title',
        'start_date',
        'time_period',
        'last_time',
        'pdf_file_question',
        'pdf_enter_question',
        'pdf_file_answer',
        'pdf_enter_answer',
        'meta_key',
        'is_active',
        'description',
        // add more database fields here
    ];
}
