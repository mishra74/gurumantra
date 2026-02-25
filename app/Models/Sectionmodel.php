<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sectionmodel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'section';
    protected $fillable = [
        'title',
        'marks',
        'negative_marks',
        'is_active',
        'language',
        'create_test'
    ];
}
