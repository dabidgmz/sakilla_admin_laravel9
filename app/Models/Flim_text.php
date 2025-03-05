<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flim_text extends Model
{
    use HasFactory;
    protected $fillable = [
        'flim_id',
        'title',
        'description',
    ];
}
