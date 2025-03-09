<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    public function index(){
        $cities = City::with("country")->get();
        Log::info($cities);
        return view("Citys", compact("cities"));
    }
}
