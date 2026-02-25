<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    protected $fillable = [
        'question', 'marks', 'negative_marks', 'type',
        'total_options', 'options', 'correct_answer', 'hint','tag_id','question_tileid'
    ];

    protected $casts = [
        'options' => 'array'
    ];
}
