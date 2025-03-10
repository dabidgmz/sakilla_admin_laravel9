<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorPostRequest;
use App\Http\Requests\ActorPutRequest;
use App\Models\Actor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActorsController extends Controller
{
    /**
     * Get all actors with pagination.
     * The actors are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        // Get all actors with pagination
        $actors = Actor::paginate(20);

        return response()->json($actors);
    }

    /**
     * Get an actor by its ID.
     *
     * @param int $id : The actor ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the actor by its ID
        $actor = Actor::where('actor_id', $id)->first();

        // If the actor does not exist, return an error
        if (!$actor) {
            return response()->json(['message' => 'Actor not found.'], 404);
        }

        return response()->json($actor);
    }

    /**
     * Create a new actor.
     *
     * @param ActorPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(ActorPostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the actor
        $actor = Actor::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'last_update' => now(),
        ]);

        return response()->json($actor, 201);
    }

    /**
     * Update an actor by its ID.
     *
     * @param ActorPutRequest $request : The request object.
     * @param int $id : The actor ID.
     * @return JsonResponse
     */
    public function update(ActorPutRequest $request, int $id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Check if at least one field is filled
        if (empty($request->all())) {
            return response()->json(['message' => 'You must specify at least one field to update.'], 400);
        }

        // Search the actor by its ID
        $actor = Actor::where('actor_id', $id)->first();

        // If the actor does not exist, return an error
        if (!$actor) {
            return response()->json(['message' => 'Actor not found.'], 404);
        }

        // Update the actor
        $actor->fill($request->only([
            'first_name', 'last_name'
        ]));

        $actor->last_update = now();
        $actor->save();

        return response()->json($actor);
    }

    /**
     * Delete an actor by its ID.
     *
     * @param int $id : The actor ID.
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        // Search the actor by its ID
        $actor = Actor::where('actor_id', $id)->first();

        // If the actor does not exist, return an error
        if (!$actor) {
            return response()->json(['message' => 'Actor not found.'], 404);
        }

        // Delete the actor
        $actor->delete();

        return response()->json(['message' => 'Actor deleted.']);
    }
}