<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmPostRequest;
use App\Http\Requests\FilmPutRequest;
use App\Models\Actor;
use App\Models\Category;
use App\Models\Film;
use App\Models\FilmActor;
use App\Models\FilmCategory;
use App\Models\FilmText;
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
    public function index() {
        // Obtener películas paginadas
        $films = Film::paginate(50);
        $filmIds = $films->pluck('film_id');
    
        // Obtener datos relacionados con consultas separadas
        $filmActors = FilmActor::whereIn('film_id', $filmIds)->get()->groupBy('film_id');
        $actors = Actor::whereIn('actor_id', $filmActors->flatten()->pluck('actor_id'))->get()->keyBy('actor_id');
    
        $filmCategories = FilmCategory::whereIn('film_id', $filmIds)->get()->groupBy('film_id');
        $categories = Category::whereIn('category_id', $filmCategories->flatten()->pluck('category_id'))->get()->keyBy('category_id');
    
        $filmTexts = FilmText::whereIn('film_id', $filmIds)->get()->keyBy('film_id');
    
        
        $films->transform(function ($film) use ($filmActors, $actors, $filmCategories, $categories, $filmTexts) {
            // Verifica si la clave existe antes de acceder
            $film->actors = isset($filmActors[$film->film_id]) ? $filmActors[$film->film_id]->map(function ($filmActor) use ($actors) {
                return $actors[$filmActor->actor_id] ?? null;
            })->filter()->values() : collect();

            $film->categories = isset($filmCategories[$film->film_id]) ? $filmCategories[$film->film_id]->map(function ($filmCategory) use ($categories) {
                return $categories[$filmCategory->category_id] ?? null;
            })->filter()->values() : collect();

            $film->text = isset($filmTexts[$film->film_id]) ? $filmTexts[$film->film_id] : null;

            return $film;
        });

    
        return view('Films', compact('films'));
    }
        

    /**
     * Get a film by its ID.
     *
     * @param int $id : The film ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Obtener la película
        $film = Film::find($id);
    
        if (!$film) {
            return response()->json(['message' => 'Film not found.'], 404);
        }
    
        // Obtener relaciones en una sola consulta
        $filmActors = FilmActor::where('film_id', $id)->get();
        $actorIds = $filmActors->pluck('actor_id');
    
        $actors = Actor::whereIn('actor_id', $actorIds)->get()->keyBy('actor_id');
    
        $filmCategories = FilmCategory::where('film_id', $id)->get();
        $categoryIds = $filmCategories->pluck('category_id');
    
        $categories = Category::whereIn('category_id', $categoryIds)->get()->keyBy('category_id');
    
        $filmText = FilmText::where('film_id', $id)->first();
    
        // Mapear actores y categorías en la película
        $film->actors = $filmActors->map(fn($filmActor) => $actors[$filmActor->actor_id] ?? null)->filter()->values();
        $film->categories = $filmCategories->map(fn($filmCategory) => $categories[$filmCategory->category_id] ?? null)->filter()->values();
        $film->text = $filmText;
    
        return response()->json($film);
    }

    /**
     * Create a new film.
     *
     * @param FilmPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(FilmPostRequest $request) {
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

        return redirect()->route('Films');
    }

    /**
     * Update a film by its ID.
     *
     * @param FilmPutRequest $request : The request object.
     * @param int $id : The film ID.
     * @return JsonResponse
     */
    public function update(Request $request, int $id) {
        // Search the film by its ID
        $film = Film::findOrfail($id);

        
        $film->title = $request->input('title');
        $film->description = $request->input('description');
        $film->release_year = $request->input('release_year');
        $film->language_id = $request->input('language_id');
        $film->original_language_id = $request->input('original_language_id');
        $film->rental_duration = $request->input('rental_duration');
        $film->rental_rate = $request->input('rental_rate');
        $film->length = $request->input('length');
        $film->replacement_cost = $request->input('replacement_cost');
        $film->rating = $request->input('rating');
        $film->special_features = $request->input('special_features');
        $film->last_update = now();
        $film->save();

        return redirect()->route('Films');
    }

    /**
     * Delete a film by its ID.
     *
     * @param int $id : The film ID.
     * @return JsonResponse
     */
    public function destroy(int $id) {
        // Search the film by its ID
        $film = Film::where('film_id', $id)->first();
        $film->delete();
        return redirect()->route('Films');
    }
}