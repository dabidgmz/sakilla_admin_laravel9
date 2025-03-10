<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;
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
    public function index(): JsonResponse {
        // Obtain all cities with pagination
        $cities = City::paginate(20);

        return response()->json($cities);
    }

    /**
     * Obtains a city by its ID.
     *
     * @param int $id : The city ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the city by its ID
        $city = City::where('city_id', $id)->first();

        // If the city does not exist, return an error
        if (!$city) {
            return response()->json(['message' => 'City not found.'], 404);
        }

        return response()->json($city);
    }
}