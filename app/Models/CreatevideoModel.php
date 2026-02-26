<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CreatevideoModel extends Model
{
    use SoftDeletes;

    protected $table = 'create_video';

    protected $fillable = [
        'volume_id',
        'title',
        //'last_time',
        'pdf_file_question',
        'pdf_enter_question',
        'video',
        'meta_key',
        'is_active',
        'description',
        'thumbnail',
        // add more database fields here
    ];
}
