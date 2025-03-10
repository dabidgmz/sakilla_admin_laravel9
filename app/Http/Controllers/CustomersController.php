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
    public function index() {
        $perPage = 70;
        $customers = Customer::paginate($perPage);
        return view('Customers', compact('customers'));
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
    public function store(CustomerPostRequest $request) {
        
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

        return redirect()->route('Customers');
    }

    /**
     * Update a customer by its ID.
     *
     * @param CustomerPutRequest $request : The request object.
     * @param int $id : The customer ID.
     * @return JsonResponse
     */
    public function update(Request $request, int $id) {
        // Search the customer by its ID
        $customer = Customer::findOrfail($id);


        $customer->store_id = $request->input('store_id');
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->email = $request->input('email');
        $customer->address_id = $request->input('address_id');
        $customer->active = $request->input('active');
        $customer->last_update = now();
        $customer->save();

        return redirect()->route('Customers');
    }

    /**
     * Delete a customer by its ID.
     *
     * @param int $id : The customer ID.
     * @return JsonResponse
     */
    public function destroy(int $id){
        // Search the customer by its ID
        $customer = Customer::where('customer_id', $id)->first();
        $customer->delete();
        return redirect()->route('Customers');
    }
}