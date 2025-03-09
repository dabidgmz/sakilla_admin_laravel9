<?php

namespace App\Http\Controllers;

use App\Models\Flim_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FlimCategoryController extends Controller
{
    public function index(){
        $perPage = 50;
        $query = Flim_Category::with("category");

        $flim_category = $query->paginate($perPage);
        Log::info($flim_category);
        return view("Flim_Category", compact("flim_category"));
    }
}
