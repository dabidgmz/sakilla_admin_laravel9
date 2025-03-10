<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    /**
     * Obtains all languages.
     *
     * @return JsonResponse
     */
    public function index(){
        // Get all languages
        $perPage = 5;
        $query = Language::query();
        $languages = $query->paginate($perPage);

        return view("Languages",compact("languages"));
    }

    /**
     * Obtains a language by its ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the language by its ID
        $language = Language::where('language_id', $id)->first();

        // If the language does not exist, return an error
        if (!$language) {
            return response()->json(['message' => 'Language not found.'], 404);
        }

        return response()->json($language);
    }
}