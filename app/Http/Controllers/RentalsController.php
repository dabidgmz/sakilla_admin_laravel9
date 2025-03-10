<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalPostRequest;
use App\Http\Requests\RentalPutRequest;
use App\Models\Rental;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RentalsController extends Controller
{
    /**
     * Get all rentals with pagination.
     * The rentals are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        // Get all rentals with pagination
        $rentals = Rental::paginate(20);

        return response()->json($rentals);
    }

    /**
     * Get a rental by its ID.
     *
     * @param int $id : The rental ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the rental by its ID
        $rental = Rental::where('rental_id', $id)->first();

        // If the rental does not exist, return an error
        if (!$rental) {
            return response()->json(['message' => 'Rental not found.'], 404);
        }

        return response()->json($rental);
    }

    /**
     * Create a new rental.
     *
     * @param RentalPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(RentalPostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the rental
        $rental = Rental::create([
            'rental_date' => $request->input('rental_date'),
            'inventory_id' => $request->input('inventory_id'),
            'customer_id' => $request->input('customer_id'),
            'return_date' => $request->input('return_date'),
            'staff_id' => $request->input('staff_id'),
            'last_update' => now(),
        ]);

        return response()->json($rental, 201);
    }

    /**
     * Update a rental by its ID.
     *
     * @param RentalPutRequest $request : The request object.
     * @param int $id : The rental ID.
     * @return JsonResponse
     */
    public function update(RentalPutRequest $request, int $id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Search the rental by its ID
        $rental = Rental::where('rental_id', $id)->first();

        // If the rental does not exist, return an error
        if (!$rental) {
            return response()->json(['message' => 'Rental not found.'], 404);
        }

        // Update only provided fields
        $rental->fill($request->only(['rental_date', 'inventory_id', 'customer_id', 'return_date', 'staff_id']));
        $rental->last_update = now();
        $rental->save();

        return response()->json($rental);
    }

    /**
     * Delete a rental by its ID.
     *
     * @param int $id : The rental ID.
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        // Search the rental by its ID
        $rental = Rental::where('rental_id', $id)->first();

        // If the rental does not exist, return an error
        if (!$rental) {
            return response()->json(['message' => 'Rental not found.'], 404);
        }

        // Delete the rental
        $rental->delete();

        return response()->json(['message' => 'Rental deleted.']);
    }
}