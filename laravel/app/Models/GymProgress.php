<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $Dan
 * @property int $max_tezina
 * @property int $ponavljanja
 * @property string $tip_vezbe
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress whereDan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress whereMaxTezina($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress wherePonavljanja($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress whereTipVezbe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GymProgress whereUserId($value)
 * @mixin \Eloquent
 */
class GymProgress  extends Model
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
