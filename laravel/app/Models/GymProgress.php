<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TipVezbe;

class GymProgress extends Model
{

     protected $table = 'gym_progress';


   protected $fillable = [
        'Dan',
        'max_tezina',
        'ponavljanja',
        'user_id',
        'tip_vezbe_id',
    ];

  public function tip_vezbe () {
    return $this->belongsTo(TipVezbe::class, 'tip_vezbe_id');
  } 
  

  public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    } 

  
}
