<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreatePDFNotesModel extends Model
{
    use SoftDeletes;

    protected $table = 'pdfnotes_create';

    protected $fillable = [
        'volume_id',
       
        'title',
        
        'last_time',
        'pdf_file_question',
        'pdf_enter_question',
        'pdf_file_answer',
        'pdf_enter_answer',
        'meta_key',
        'is_active',
        'description',
        // add more database fields here
    ];
}
