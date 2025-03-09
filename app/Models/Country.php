<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'country',
        'last_update',
    ];
    
    protected $primaryKey = 'country_id';
    
    protected $table= 'country';

    public function City(){
        return $this->belongsTo(City::class);
    }
}
