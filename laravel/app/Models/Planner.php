<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planner extends Model
{
    protected $table = "planner";


    protected $fillable = ['tip_vezbe_id', 'planned_date', 'goal_weight', 'goal_reps', 'status', 'user_id'];


    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function tip_vezbe () {
        return $this->belongsTo(TipVezbe::class, 'tip_vezbe_id');
    } 
}
