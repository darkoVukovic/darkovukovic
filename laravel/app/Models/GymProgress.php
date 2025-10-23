<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GymProgress extends Model
{

     protected $table = 'gym_progress';


   protected $fillable = [
        'Dan',
        'max_tezina',
        'ponavljanja',
        'tip_vezbe',
        'user_id',
    ];


  public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    } 
}
