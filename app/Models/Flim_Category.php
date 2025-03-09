<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flim_Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'flim_id',
        'category_id',
        'last_update',
    ];

    protected $table = 'film_category';

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
