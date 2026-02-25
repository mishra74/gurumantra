<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    'title',
    'description',
    'mrp',
    'price',
    'start_date',
    'validity',
    'validity_type',
    'days',

    'mrp_one',
    'price_one',
    'discount_one',

    'mrp_two',
    'price_two',
    'discount_two',

    'mrp_three',
    'price_three',
    'discount_three',

    'mrp_four',
    'price_four',
    'discount_four',

    'mrp_five',
    'price_five',
    'discount_five',

    'extend_type',
    'course_id',
    'is_active',
    'coin_percentage'
];


    protected $casts = [
        'start_date' => 'date',
        'is_active' => 'boolean',
    ];
    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'batch_class', 'batch_id', 'class_id');
    }
}
