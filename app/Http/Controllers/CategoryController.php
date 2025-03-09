<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        $categories = Category::paginate(5); 
        return view('Categories', compact('categories'));
    }
}
