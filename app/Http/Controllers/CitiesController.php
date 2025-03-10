<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Obtains all cities with pagination.
     * The cities are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index(Request $request){
        // Obtain all cities with pagination
        $perPage = 50; 
        $query = City::with("country");

        if ($request->has('search')) {
            $query->where('city', 'like', '%' . $request->search . '%');
        }
        
        $cities = $query->paginate($perPage);
        return view("Citys", compact("cities"));
    }

    /**
     * Obtains a city by its ID.
     *
     * @param int $id : The city ID.
     * @return JsonResponse
     */
    public function show(int $id) {
        $city = City::where('city_id', $id)->first();

        if (!$city) {
            return response()->json(['message' => 'City not found.'], 404);
        }

        return response()->json($city);
    }
}