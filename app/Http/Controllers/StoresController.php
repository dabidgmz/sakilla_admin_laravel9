<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StorePutRequest;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Get all stores with pagination.
     * The stores are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index() {
        // Get all stores with pagination
        $stores = Store::all();
        return view("Stores",compact("stores"));
    }

    /**
     * Get a store by its ID.
     *
     * @param int $id : The store ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the store by its ID
        $store = Store::where('store_id', $id)->first();

        // If the store does not exist, return an error
        if (!$store) {
            return response()->json(['message' => 'Store not found.'], 404);
        }

        return response()->json($store);
    }

    /**
     * Create a new store.
     *
     * @param StorePostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(StorePostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the store
        $store = Store::create([
            'manager_staff_id' => $request->input('manager_staff_id'),
            'address_id' => $request->input('address_id'),
            'last_update' => now(),
        ]);

        return response()->json($store, 201);
    }

    /**
     * Update a store by its ID.
     *
     * @param StorePutRequest $request : The request object.
     * @param int $id : The store ID.
     * @return JsonResponse
     */
    public function update(StorePutRequest $request, int $id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Search the store by its ID
        $store = Store::where('store_id', $id)->first();

        // If the store does not exist, return an error
        if (!$store) {
            return response()->json(['message' => 'Store not found.'], 404);
        }

        // Update only provided fields
        $store->fill($request->only(['manager_staff_id', 'address_id']));
        $store->last_update = now();
        $store->save();

        return response()->json($store);
    }

    /**
     * Delete a store by its ID.
     *
     * @param int $id : The store ID.
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        // Search the store by its ID
        $store = Store::where('store_id', $id)->first();

        // If the store does not exist, return an error
        if (!$store) {
            return response()->json(['message' => 'Store not found.'], 404);
        }

        // Delete the store
        $store->delete();

        return response()->json(['message' => 'Store deleted.']);
    }
}
