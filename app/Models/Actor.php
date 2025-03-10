<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $table = 'actor';
    protected $primaryKey = 'actor_id';
    public $timestamps = false;

    protected $fillable = [
        'actor_id',
        'first_name',
        'last_name',
        'last_update',
    ];

    /*----------------------------------------------------------------------------------------------------*/

    /*----------------------------------------------------------------------------------------------------*/

    // public function filmActor() {
    //     return $this->hasMany(FilmActor::class, 'actor_id', 'actor_id');
    // }
}
