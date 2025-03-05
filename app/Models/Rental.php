<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $fillable = [
        'rental_id',
        'rental_date',
        'inventory_id',
        'customer_id',
        'return_date',
        'staff_id',
        'last_update',
    ];
}
