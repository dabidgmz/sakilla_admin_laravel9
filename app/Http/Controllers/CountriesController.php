<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    /**
     * Obtains all countries with pagination.
     * The countries are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        // Obtain all countries with pagination
        $countries = Country::paginate(20);

        return response()->json($countries);
    }

    /**
     * Obtains a country by its ID.
     *
     * @param int $id : The country ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the country by its ID
        $country = Country::where('country_id', $id)->first();

        // If the country does not exist, return an error
        if (!$country) {
            return response()->json(['message' => 'Country not found.'], 404);
        }

        return response()->json($country);
    }
}