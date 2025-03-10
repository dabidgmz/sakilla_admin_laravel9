<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Obtains all categories.
     *
     * @return JsonResponse
     */
    public function index(Request $request) {
        // Get all categories
        $query = Category::query();
    
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        $categories = $query->paginate(5); 
    
        return view('Categories', compact('categories'));
    }

    /**
     * Obtains a category by its ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id) {
        // Search the category by its ID
        $category = Category::where('category_id', $id)->first();

        // If the category does not exist, return an error
        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        return response()->json($category);
    }
}