<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionToVolume extends Model
{
    protected $table = 'quetiontovolume';

    protected $fillable = [
        'volume_id',
        'test_id',
        'section_id',
        'question_id'
    ];

    public $timestamps = true;
}
