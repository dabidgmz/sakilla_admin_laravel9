<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'Category';
    protected $primaryKey = 'category_id';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'name',
        'last_update',
    ];

    /*----------------------------------------------------------------------------------------------------*/

    /*----------------------------------------------------------------------------------------------------*/

    public function filmCategory() {
        return $this->hasMany(FilmCategory::class, 'category_id', 'category_id');
    }
}
