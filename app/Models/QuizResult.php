<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = [
        'user_id',
        'tile_id',
        'total_questions',
        'attempted',
        'correct',
        'incorrect',
        'percentage',
        'questions',
        'answers',
        'time_taken',
        'exam_type'
    ];

    protected $casts = [
        'questions' => 'array',
        'answers' => 'array',
    ];
}
