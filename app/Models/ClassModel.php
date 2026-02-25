<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
    use SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'title','time','start_date',
        'description','meta_key','meta_description','status','batches'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id'); // assume teacher is in users table
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'class_batch', 'class_id', 'batch_id');
    }
    // public function batches()
    // {
    //     return $this->belongsToMany(Batch::class, 'batch_class', 'class_id', 'batch_id');
    // }

}
