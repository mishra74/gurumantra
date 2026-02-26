<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCurrent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'pdf',
        'content',
        'is_active',
        'thumbnail',
        'category',
        'thumbnail',
    ];
}
