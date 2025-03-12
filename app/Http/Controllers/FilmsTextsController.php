<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmTextPostRequest;
use App\Http\Requests\FilmTextPutRequest;
use App\Models\FilmText;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilmsTextsController extends Controller
{
    /**
     * Get all film texts with pagination.
     * The film texts are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index() {
        // Obtener todos los textos de películas con paginación
        $perPage = 50;
        $filmTxt = FilmText::paginate($perPage);
    
        return view('Film_text', compact('filmTxt')); 
    }
    
    
    
    /**
     * Get a film text by its film ID.
     *
     * @param int $film_id : The film ID.
     * @return JsonResponse
     */
    public function show(int $film_id): JsonResponse {
        // Search the film text by film_id
        $filmText = FilmText::where('film_id', $film_id)->first();

        // If the film text does not exist, return an error
        if (!$filmText) {
            return response()->json(['message' => 'Film text not found.'], 404);
        }

        return response()->json($filmText);
    }

    /**
     * Create a new film text.
     *
     * @param FilmTextPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(Request $request) {
        // Valida los datos de entrada

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        //Buscar el id más alto y sumarle uno
        $filmId = FilmText::max('film_id') + 1;
    
        // Crea el nuevo texto de la película
        $filmText = FilmText::create([
            'film_id' => $filmId, 
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'last_update' => now(),
        ]);
    
        return redirect()->route('Film_text');
    }
    

    /**
     * Update a film text by its film ID.
     *
     * @param FilmTextPutRequest $request : The request object.
     * @param int $film_id : The film ID.
     * @return JsonResponse
     */
    public function update(FilmTextPutRequest $request, int $film_id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Search the film text by film_id
        $filmText = FilmText::where('film_id', $film_id)->first();

        // If the film text does not exist, return an error
        if (!$filmText) {
            return response()->json(['message' => 'Film text not found.'], 404);
        }

        // Update only provided fields
        $filmText->fill($request->only(['title', 'description']));
        $filmText->save();

        return response()->json($filmText);
    }

    /**
     * Delete a film text by its film ID.
     *
     * @param int $film_id : The film ID.
     * @return JsonResponse
     */
    public function destroy(int $film_id): JsonResponse {
        // Search the film text by film_id
        $filmText = FilmText::where('film_id', $film_id)->first();

        // If the film text does not exist, return an error
        if (!$filmText) {
            return response()->json(['message' => 'Film text not found.'], 404);
        }

        // Delete the film text
        $filmText->delete();

        return response()->json(['message' => 'Film text deleted.']);
    }
}