<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmCategoryPostRequest;
use App\Http\Requests\FilmCategoryPutRequest;
use App\Models\FilmCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilmsCategoriesController extends Controller
{
    /**
     * Get all film-category relationships with pagination.
     * The relationships are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        // Get all film-category relationships with pagination
        $filmCategories = FilmCategory::paginate(20);

        return response()->json($filmCategories);
    }

    /**
     * Get a film-category relationship by its composite key.
     *
     * @param int $film_id : The film ID.
     * @param int $category_id : The category ID.
     * @return JsonResponse
     */
    public function show(int $film_id, int $category_id): JsonResponse {
        // Search the relationship by film_id and category_id
        $filmCategory = FilmCategory::where('film_id', $film_id)
                                    ->where('category_id', $category_id)
                                    ->first();

        // If the relationship does not exist, return an error
        if (!$filmCategory) {
            return response()->json(['message' => 'Film-Category relationship not found.'], 404);
        }

        return response()->json($filmCategory);
    }

    /**
     * Create a new film-category relationship.
     *
     * @param FilmCategoryPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(FilmCategoryPostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the film-category relationship
        $filmCategory = FilmCategory::create([
            'film_id' => $request->input('film_id'),
            'category_id' => $request->input('category_id'),
            'last_update' => now(),
        ]);

        return response()->json($filmCategory, 201);
    }

    /**
     * Update a film-category relationship by its composite key.
     *
     * @param FilmCategoryPutRequest $request : The request object.
     * @param int $film_id : The current film ID.
     * @param int $category_id : The current category ID.
     * @return JsonResponse
     */
    public function update(FilmCategoryPutRequest $request, int $film_id, int $category_id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Search the relationship by film_id and category_id
        $filmCategory = FilmCategory::where('film_id', $film_id)
                                    ->where('category_id', $category_id)
                                    ->first();

        // If the relationship does not exist, return an error
        if (!$filmCategory) {
            return response()->json(['message' => 'Film-Category relationship not found.'], 404);
        }

        // Create a new relationship if film_id or category_id is changed
        if ($request->has('film_id') || $request->has('category_id')) {
            FilmCategory::create([
                'film_id' => $request->input('film_id', $film_id),
                'category_id' => $request->input('category_id', $category_id),
                'last_update' => now(),
            ]);
            
            // Delete old relationship
            $filmCategory->delete();
        } else {
            // Only update last_update field
            $filmCategory->last_update = now();
            $filmCategory->save();
        }

        return response()->json(['message' => 'Film-Category relationship updated.']);
    }

    /**
     * Delete a film-category relationship by its composite key.
     *
     * @param int $film_id : The film ID.
     * @param int $category_id : The category ID.
     * @return JsonResponse
     */
    public function destroy(int $film_id, int $category_id): JsonResponse {
        // Search the relationship by film_id and category_id
        $filmCategory = FilmCategory::where('film_id', $film_id)
                                    ->where('category_id', $category_id)
                                    ->first();

        // If the relationship does not exist, return an error
        if (!$filmCategory) {
            return response()->json(['message' => 'Film-Category relationship not found.'], 404);
        }

        // Delete the relationship
        $filmCategory->delete();

        return response()->json(['message' => 'Film-Category relationship deleted.']);
    }
}
