<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipVezbe extends Model
{

    protected $table = 'tip_vezbe';

    protected $fillable = ['naziv', 'muscle_group'];

    public function gymProgress() {
    return $this->hasMany(GymProgress::class, 'tip_vezbe_id');
}


}
