<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'city',
        'country_id',
        'last_update',
    ];

    protected $primaryKey = 'city_id';

    protected $table= 'city';

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }
}
