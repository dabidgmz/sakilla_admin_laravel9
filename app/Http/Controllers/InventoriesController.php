<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryPostRequest;
use App\Http\Requests\InventoryPutRequest;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoriesController extends Controller
{
    /**
     * Get all inventory items with pagination.
     * The inventory items are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index() {
        $perPage = 250;  
        $inventoriData = Inventory::paginate($perPage); 
        $storeCounts = Inventory::all()->groupBy('store_id')->map(function ($items, $key) {
            return $items->count();  
        });
    
        return view('Inventory', compact('inventoriData', 'storeCounts'));
    }
    

    /**
     * Get an inventory item by its ID.
     *
     * @param int $id : The inventory ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the inventory item by its ID
        $inventory = Inventory::where('inventory_id', $id)->first();

        // If the inventory item does not exist, return an error
        if (!$inventory) {
            return response()->json(['message' => 'Inventory item not found.'], 404);
        }

        return response()->json($inventory);
    }

    /**
     * Create a new inventory item.
     *
     * @param InventoryPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(Request $request)
    {
 
        $inventory = Inventory::create([
            'film_id' => $request->input('film_id'),
            'store_id' => $request->input('store_id'),
            'last_update' => now(),
        ]);
        return redirect()->route('Inventories');
    }
    

    /**
     * Update an inventory item by its ID.
     *
     * @param InventoryPutRequest $request : The request object.
     * @param int $id : The inventory ID.
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        // Actualiza los datos del inventario
        $inventory->update([
            'film_id' => $request->input('film_id'),
            'store_id' => $request->input('store_id'),
            'last_update' => now(),
        ]);

        return redirect()->route('Inventories');
    }


    /**
     * Delete an inventory item by its ID.
     *
     * @param int $id : The inventory ID.
     * @return JsonResponse
     */
    public function destroy($id)
    {
        // Encuentra el inventario por su ID
        $inventory = Inventory::findOrFail($id);

        // Elimina el inventario
        $inventory->delete();

        // Redirige al listado de inventarios
        return redirect()->route('Inventories');
    }

}
