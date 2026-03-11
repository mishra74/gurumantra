<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoomRecording extends Model
{
    //
    protected $fillable = [
'meeting_id',
'topic',
'recording_url',
'download_url',
'recording_start',
'recording_end'
];
}
