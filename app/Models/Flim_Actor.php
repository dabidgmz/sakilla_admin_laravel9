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
}
