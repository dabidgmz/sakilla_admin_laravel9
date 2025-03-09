<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flim_Actor extends Model
{
    use HasFactory;
    protected $fillable = [
        'actor_id',
        'flim_id',
        'last_update',
    ];

    protected $table='film_actor';

    public function actor(){
        return $this->belongsTo(Actor::class,'actor_id');
    }
}
