<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $fillable = [
        'user_id', 'test_id', 'volume_id', 'question_id', 'selected_answer', 'is_correct'
    ];
}