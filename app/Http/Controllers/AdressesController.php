<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressPostRequest;
use App\Http\Requests\AddressPutRequest;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    /**
     * Get all addresses with pagination.
     * The addresses are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        // Get all addresses with pagination
        $addresses = Address::paginate(20);

        return response()->json($addresses);
    }

    /**
     * Get an address by its ID.
     *
     * @param int $id : The address ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the address by its ID
        $address = Address::where('address_id', $id)->first();

        // If the address does not exist, return an error
        if (!$address) {
            return response()->json(['message' => 'Address not found.'], 404);
        }

        return response()->json($address);
    }

    /**
     * Create a new address.
     *
     * @param AddressPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(AddressPostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the address
        $address = Address::create([
            'address' => $request->input('address'),
            'address2' => $request->input('address2'),
            'district' => $request->input('district'),
            'city_id' => $request->input('city_id'),
            'postal_code' => $request->input('postal_code'),
            'phone' => $request->input('phone'),
            'location' => $request->input('location'),
            'last_update' => now(),
        ]);

        return response()->json($address, 201);
    }

    /**
     * Update an address by its ID.
     *
     * @param AddressPutRequest $request : The request object.
     * @param int $id : The address ID.
     * @return JsonResponse
     */
    public function update(AddressPutRequest $request, int $id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Check if at least one field is filled
        if (empty($request->all())) {
            return response()->json(['message' => 'You must specify at least one field to update.'], 400);
        }

        // Search the address by its ID
        $address = Address::where('address_id', $id)->first();

        // If the address does not exist, return an error
        if (!$address) {
            return response()->json(['message' => 'Address not found.'], 404);
        }

        // Update only provided fields
        $address->fill($request->only([
            'address', 'address2', 'district', 'city_id', 'postal_code', 'phone', 'location'
        ]));

        $address->last_update = now();
        $address->save();

        return response()->json($address);
    }

    /**
     * Delete an address by its ID.
     *
     * @param int $id : The address ID.
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        // Search the address by its ID
        $address = Address::where('address_id', $id)->first();

        // If the address does not exist, return an error
        if (!$address) {
            return response()->json(['message' => 'Address not found.'], 404);
        }

        // Delete the address
        $address->delete();

        return response()->json(['message' => 'Address deleted.']);
    }
}