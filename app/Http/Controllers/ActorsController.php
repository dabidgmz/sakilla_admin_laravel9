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


    public function update(Request $request, int $id)
    {
        // Log para verificar que el ID está llegando correctamente
        Log::info('Update actor - Received ID: ' . $id);
    
        // Validar los datos de la solicitud
        $request->validated();
    
        // Verificar si al menos un campo está lleno
        if (empty($request->all())) {
            Log::warning('No fields were specified for update.');
            return redirect()->route('Actors')->with('error', 'You must specify at least one field to update.');
        }
    
        // Buscar al actor por su ID
        $actors = Actor::where('actor_id', $id)->first();
    
        // Si el actor no existe, retornar un error
        if (!$actors) {
            Log::error('Actor not found for ID: ' . $id);
            return redirect()->route('Actors')->with('error', 'Actor not found.');
        }
    
        // Log para verificar que el actor ha sido encontrado
        Log::info('Actor found: ' . json_encode($actors));
    
        // Actualizar el actor
        $actors->fill($request->only([
            'first_name', 'last_name'
        ]));
    
        $actors->last_update = now();
        $actors->save();
    
        // Log para confirmar que la actualización fue exitosa
        Log::info('Actor updated successfully for ID: ' . $id);
    
        return redirect()->route('Actors')->with('success', 'Actor updated successfully.');
    }
    

    public function edit($id)
    {
        // Buscar el actor por ID
        $actors = Actor::find($id);
    
        // Verificar si el actor existe
        if (!$actors) {
            return redirect()->route('Actors')->with('error', 'Actor not found.');
        }
    
        // Pasar el actor a la vista
        return view('Actors.update', compact('actor'));
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