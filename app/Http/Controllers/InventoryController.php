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
    public function index(): JsonResponse {
        // Get all inventory items with pagination
        $inventories = Inventory::paginate(20);

        return response()->json($inventories);
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
    public function store(InventoryPostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the inventory item
        $inventory = Inventory::create([
            'film_id' => $request->input('film_id'),
            'store_id' => $request->input('store_id'),
            'last_update' => now(),
        ]);

        return response()->json($inventory, 201);
    }

    /**
     * Update an inventory item by its ID.
     *
     * @param InventoryPutRequest $request : The request object.
     * @param int $id : The inventory ID.
     * @return JsonResponse
     */
    public function update(InventoryPutRequest $request, int $id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Search the inventory item by its ID
        $inventory = Inventory::where('inventory_id', $id)->first();

        // If the inventory item does not exist, return an error
        if (!$inventory) {
            return response()->json(['message' => 'Inventory item not found.'], 404);
        }

        // Update only provided fields
        $inventory->fill($request->only(['film_id', 'store_id']));
        $inventory->last_update = now();
        $inventory->save();

        return response()->json($inventory);
    }

    /**
     * Delete an inventory item by its ID.
     *
     * @param int $id : The inventory ID.
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        // Search the inventory item by its ID
        $inventory = Inventory::where('inventory_id', $id)->first();

        // If the inventory item does not exist, return an error
        if (!$inventory) {
            return response()->json(['message' => 'Inventory item not found.'], 404);
        }

        // Delete the inventory item
        $inventory->delete();

        return response()->json(['message' => 'Inventory item deleted.']);
    }
}
