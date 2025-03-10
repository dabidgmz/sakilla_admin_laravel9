<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerPostRequest;
use App\Http\Requests\CustomerPutRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Get all customers with pagination.
     * The customers are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        // Get all customers with pagination
        $customers = Customer::paginate(20);

        return response()->json($customers);
    }

    /**
     * Get a customer by its ID.
     *
     * @param int $id : The customer ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the customer by its ID
        $customer = Customer::where('customer_id', $id)->first();

        // If the customer does not exist, return an error
        if (!$customer) {
            return response()->json(['message' => 'Customer not found.'], 404);
        }

        return response()->json($customer);
    }

    /**
     * Create a new customer.
     *
     * @param CustomerPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(CustomerPostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the customer
        $customer = Customer::create([
            'store_id' => $request->input('store_id'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'address_id' => $request->input('address_id'),
            'active' => $request->input('active'),
            'create_date' => now(),
            'last_update' => now(),
        ]);

        return response()->json($customer, 201);
    }

    /**
     * Update a customer by its ID.
     *
     * @param CustomerPutRequest $request : The request object.
     * @param int $id : The customer ID.
     * @return JsonResponse
     */
    public function update(CustomerPutRequest $request, int $id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Check if at least one field is filled
        if (empty($request->all())) {
            return response()->json(['message' => 'You must specify at least one field to update.'], 400);
        }

        // Search the customer by its ID
        $customer = Customer::where('customer_id', $id)->first();

        // If the customer does not exist, return an error
        if (!$customer) {
            return response()->json(['message' => 'Customer not found.'], 404);
        }

        // Update only provided fields
        $customer->fill($request->only([
            'store_id', 'first_name', 'last_name', 'email', 'address_id', 'active'
        ]));

        $customer->last_update = now();
        $customer->save();

        return response()->json($customer);
    }

    /**
     * Delete a customer by its ID.
     *
     * @param int $id : The customer ID.
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        // Search the customer by its ID
        $customer = Customer::where('customer_id', $id)->first();

        // If the customer does not exist, return an error
        if (!$customer) {
            return response()->json(['message' => 'Customer not found.'], 404);
        }

        // Delete the customer
        $customer->delete();

        return response()->json(['message' => 'Customer deleted.']);
    }
}