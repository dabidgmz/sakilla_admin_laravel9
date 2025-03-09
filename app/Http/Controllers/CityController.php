<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request){
        $perPage = 50; 
        $query = City::with("country");

        if ($request->has('search')) {
            $query->where('city', 'like', '%' . $request->search . '%');
        }
        
        $cities = $query->paginate($perPage);

        return view("Citys", compact("cities"));
    }
}
