<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorPostRequest;
use App\Http\Requests\ActorPutRequest;
use App\Models\Actor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function index()
    {
        $perPage = 20;
        $actors = Actor::paginate($perPage);

        return view('Actors', compact('actors'));
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
    public function store(ActorPostRequest $request) {
        
        $request->validated();

        Actor::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'last_update' => now(),
        ]);
    
        $actors = Actor::paginate(20);
    
        return view('Actors', compact('actors'));
    }

    /**
     * Update an actor by its ID.
     *
     * @param ActorPutRequest $request : The request object.
     * @param int $id : The actor ID.
     * @return JsonResponse
     */
         
     public function update(ActorPutRequest $request, $id)
     {
         // Validar los datos del formulario
         $request->validated();
     
         // Buscar el actor por su ID
         $actor = Actor::findOrFail($id);
     
         // Actualizar los campos del actor
         $actor->update([
             'first_name' => $request->input('first_name'),
             'last_name' => $request->input('last_name'),
             'last_update' => now(),
         ]);
     
         // Redirigir a la vista de actores con la paginación actualizada
         return redirect()->route('Actors');
     }
     
    
    /**
     * Delete an actor by its ID.
     *
     * @param int $id : The actor ID.
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $actor = Actor::where('actor_id', $id)->first();
    
        // Si el actor no existe, devuelve un error
        if (!$actor) {
            return response()->json(['message' => 'Actor not found.'], 404);
        }
    
        // Eliminar al actor
        $actor->delete();
    
        return redirect()->route('Actors'); 
    }
    
}