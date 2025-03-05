<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'customer_id',
        'staff_id',
        'rental_id',
        'amount',
        'payment_date',
        'last_update',
    ];
}
