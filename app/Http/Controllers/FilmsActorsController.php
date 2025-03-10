<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmActorPostRequest;
use App\Http\Requests\FilmActorPutRequest;
use App\Models\FilmActor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilmsActorsController extends Controller
{
    /**
     * Get all film-actor relationships with pagination.
     * The relationships are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        // Get all film-actor relationships with pagination
        $filmActors = FilmActor::paginate(20);

        return response()->json($filmActors);
    }

    /**
     * Get a film-actor relationship by its composite key.
     *
     * @param int $actor_id : The actor ID.
     * @param int $film_id : The film ID.
     * @return JsonResponse
     */
    public function show(int $actor_id, int $film_id): JsonResponse {
        // Search the relationship by actor_id and film_id
        $filmActor = FilmActor::where('actor_id', $actor_id)
                              ->where('film_id', $film_id)
                              ->first();

        // If the relationship does not exist, return an error
        if (!$filmActor) {
            return response()->json(['message' => 'Film-Actor relationship not found.'], 404);
        }

        return response()->json($filmActor);
    }

    /**
     * Create a new film-actor relationship.
     *
     * @param FilmActorPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(FilmActorPostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the film-actor relationship
        $filmActor = FilmActor::create([
            'actor_id' => $request->input('actor_id'),
            'film_id' => $request->input('film_id'),
            'last_update' => now(),
        ]);

        return response()->json($filmActor, 201);
    }

    /**
     * Update a film-actor relationship by its composite key.
     *
     * @param FilmActorPutRequest $request : The request object.
     * @param int $actor_id : The current actor ID.
     * @param int $film_id : The current film ID.
     * @return JsonResponse
     */
    public function update(FilmActorPutRequest $request, int $actor_id, int $film_id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Search the relationship by actor_id and film_id
        $filmActor = FilmActor::where('actor_id', $actor_id)
                              ->where('film_id', $film_id)
                              ->first();

        // If the relationship does not exist, return an error
        if (!$filmActor) {
            return response()->json(['message' => 'Film-Actor relationship not found.'], 404);
        }

        // Create a new relationship if actor_id or film_id is changed
        if ($request->has('actor_id') || $request->has('film_id')) {
            FilmActor::create([
                'actor_id' => $request->input('actor_id', $actor_id),
                'film_id' => $request->input('film_id', $film_id),
                'last_update' => now(),
            ]);
            
            // Delete old relationship
            $filmActor->delete();
        } else {
            // Only update last_update field
            $filmActor->last_update = now();
            $filmActor->save();
        }

        return response()->json(['message' => 'Film-Actor relationship updated.']);
    }

    /**
     * Delete a film-actor relationship by its composite key.
     *
     * @param int $actor_id : The actor ID.
     * @param int $film_id : The film ID.
     * @return JsonResponse
     */
    public function destroy(int $actor_id, int $film_id): JsonResponse {
        // Search the relationship by actor_id and film_id
        $filmActor = FilmActor::where('actor_id', $actor_id)
                              ->where('film_id', $film_id)
                              ->first();

        // If the relationship does not exist, return an error
        if (!$filmActor) {
            return response()->json(['message' => 'Film-Actor relationship not found.'], 404);
        }

        // Delete the relationship
        $filmActor->delete();

        return response()->json(['message' => 'Film-Actor relationship deleted.']);
    }
}