<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'role_id';

    protected $fillable = [
        'id',
        'name',
        'description',
        'is_active',
    ];

    /*----------------------------------------------------------------------------------------------------*/

    public function staff() {
        return $this->hasMany(Staff::class, 'role_id', 'id');
    }
}
