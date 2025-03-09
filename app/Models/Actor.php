<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor_id',
        'first_name',
        'last_name',
        'last_update',
    ];

    protected $primaryKey = 'actor_id';

    protected $table='actor';

    public function film_actor(){
        return $this->hasMany(Flim_Actor::class,'actor_id');
    }
}
