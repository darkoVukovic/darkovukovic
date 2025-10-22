<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gym_progress extends Model
{

     protected $table = 'gym_progress';


   protected $fillable = [
        'Dan',
        'max_tezina',
        'ponavljanja',
        'tip_vezbe',
    ];

}
