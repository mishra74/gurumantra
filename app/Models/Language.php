<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    Protected $fill=['name','is_active','deleted_at','language'];
}
