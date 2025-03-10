<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalPostRequest;
use App\Http\Requests\RentalPutRequest;
use App\Models\Rental;
use Illuminate\Contracts\View\View;
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
    public function index(){
        // Get all rentals with pagination
        $perPage = 810;
        $rentals = Rental::paginate($perPage);
        return View('Rentals', compact('rentals'));
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
    public function store(Request $request) {
        
        $rental = Rental::create([
            'rental_date' => now(),
            'inventory_id' => $request->input('inventory_id'),
            'customer_id' => $request->input('customer_id'),
            'return_date' => now(),
            'staff_id' => $request->input('staff_id'),
            'last_update' => now(),
        ]);

        return redirect()->route('Rentals');
    }

    /**
     * Update a rental by its ID.
     *
     * @param RentalPutRequest $request : The request object.
     * @param int $id : The rental ID.
     * @return JsonResponse
     */
    public function update(Request $request, int $id) {
        // Search the rental by its ID
        $rental = Rental::where('rental_id', $id)->first();

        // If the rental does not exist, return an error
        if (!$rental) {
            return response()->json(['message' => 'Rental not found.'], 404);
        }


        $rental->rental_date = now();
        $rental->inventory_id = $request->input('inventory_id');
        $rental->customer_id = $request->input('customer_id');
        $rental->return_date = now();
        $rental->staff_id = $request->input('staff_id');
        $rental->last_update = now();
        $rental->save();

        return redirect()->route('Rentals');
    }

    /**
     * Delete a rental by its ID.
     *
     * @param int $id : The rental ID.
     * @return JsonResponse
     */
    public function destroy(int $id) {
        // Search the rental by its ID
        $rental = Rental::where('rental_id', $id)->first();
        $rental->delete();
        return redirect()->route('Rentals');
    }
}