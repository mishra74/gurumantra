<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffLineMockTest extends Model
{
        use SoftDeletes;

    protected $fillable = ['thumbnail', 'meta_key', 'description', 'volume_id', 'live_class', 'title', 'start_date', 'start_time', 'time_period', 'last_time', 'pdf_file_question', 'pdf_enter_question', 'pdf_file_answer', 'pdf_enter_answer', 'is_active'];
}
