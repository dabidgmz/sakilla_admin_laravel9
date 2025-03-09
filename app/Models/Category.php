<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'last_update',
    ];

    protected $table= 'category';

    protected $primaryKey='category_id';

    public function film_category(){
        return $this->belongsTo(Flim_Category::class,'category_id');
    }
}
