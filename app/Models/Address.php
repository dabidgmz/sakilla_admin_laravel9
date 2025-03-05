<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
        'address',
        'address2',
        'district',
        'city_id',
        'postal_code',
        'phone',
        'location',
        'last_update',
    ];
}
