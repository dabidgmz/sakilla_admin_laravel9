<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmPostRequest;
use App\Http\Requests\FilmPutRequest;
use App\Models\Film;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    /**
     * Get all films with pagination.
     * The films are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        // Get all films with pagination
        $films = Film::paginate(20);

        return response()->json($films);
    }

    /**
     * Get a film by its ID.
     *
     * @param int $id : The film ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the film by its ID
        $film = Film::where('film_id', $id)->first();

        // If the film does not exist, return an error
        if (!$film) {
            return response()->json(['message' => 'Film not found.'], 404);
        }

        return response()->json($film);
    }

    /**
     * Create a new film.
     *
     * @param FilmPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(FilmPostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the film
        $film = Film::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'release_year' => $request->input('release_year'),
            'language_id' => $request->input('language_id'),
            'original_language_id' => $request->input('original_language_id'),
            'rental_duration' => $request->input('rental_duration'),
            'rental_rate' => $request->input('rental_rate'),
            'length' => $request->input('length'),
            'replacement_cost' => $request->input('replacement_cost'),
            'rating' => $request->input('rating'),
            'special_features' => $request->input('special_features'),
            'last_update' => now(),
        ]);

        return response()->json($film, 201);
    }

    /**
     * Update a film by its ID.
     *
     * @param FilmPutRequest $request : The request object.
     * @param int $id : The film ID.
     * @return JsonResponse
     */
    public function update(FilmPutRequest $request, int $id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Check if at least one field is filled
        if (empty($request->all())) {
            return response()->json(['message' => 'You must specify at least one field to update.'], 400);
        }

        // Search the film by its ID
        $film = Film::where('film_id', $id)->first();

        // If the film does not exist, return an error
        if (!$film) {
            return response()->json(['message' => 'Film not found.'], 404);
        }

        // Update only provided fields
        $film->fill($request->only([
            'title', 'description', 'release_year', 'language_id', 'original_language_id',
            'rental_duration', 'rental_rate', 'length', 'replacement_cost',
            'rating', 'special_features'
        ]));

        $film->last_update = now();
        $film->save();

        return response()->json($film);
    }

    /**
     * Delete a film by its ID.
     *
     * @param int $id : The film ID.
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        // Search the film by its ID
        $film = Film::where('film_id', $id)->first();

        // If the film does not exist, return an error
        if (!$film) {
            return response()->json(['message' => 'Film not found.'], 404);
        }

        // Delete the film
        $film->delete();

        return response()->json(['message' => 'Film deleted.']);
    }
}