<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinsModel extends Model
{
    protected $table = 'coins_use';
    
    protected $fillable = [
        'user_id','testid','notes_id','coinsuse','batch_id','record_id',
        'availcoins'
    ];
}
