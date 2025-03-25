<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Staff extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'staff';
    protected $primaryKey = 'staff_id';
    public $timestamps = false;

    protected $fillable = [
        'staff_id',
        'first_name',
        'last_name',
        'address_id',
        'picture',
        'email',
        'store_id',
        'active',
        'username',
        'password',
        'temp_code',
        'google_id',
        'role_id',
        'last_update',
    ];

    /*----------------------------------------------------------------------------------------------------*/

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /*----------------------------------------------------------------------------------------------------*/
    
    public function address() {
        return $this->belongsTo(Address::class, 'address_id', 'address_id');
    }

    public function store() {
        return $this->hasOne(Store::class, 'manager_staff_id', 'staff_id');
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    /*----------------------------------------------------------------------------------------------------*/

    public function payment() {
        return $this->hasMany(Payment::class, 'staff_id', 'staff_id');
    }

    public function rental() {
        return $this->hasMany(Rental::class, 'staff_id', 'staff_id');
    }
}
