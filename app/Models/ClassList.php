<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassList extends Model
{
    protected $fillable = [
        'title',
        'time',
        'class_room_id',
        'start_date',
        'is_active',
        'zoom_meeting_id',
        'start_url',
        'join_url',
        'start_time',
        'password'
    ];
}
