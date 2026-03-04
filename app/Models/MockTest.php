<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MockTest extends Model
{
    protected $fillable = ['volume_id', 'live_class', 'title', 'start_date', 'start_time', 'time_period', 'last_time', 'pdf_file_question', 'pdf_enter_question', 'pdf_file_answer', 'pdf_enter_answer', 'meta_key', 'is_active', 'description', 'thumbnail', 'deleted_at'];
}
