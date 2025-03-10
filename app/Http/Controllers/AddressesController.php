<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressPostRequest;
use App\Http\Requests\AddressPutRequest;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Log;

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
    public function index() {
        $perPage = 40;
        $addss = Address::paginate($perPage);
    
        return view('Address', compact('addss')); 
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
    public function store(Request $request)
    {
    
    
    // Validar los datos
    $validatedData = $request->validate([
        'address' => 'required|string',
        'address2' => 'nullable|string',
        'district' => 'required|string',
        'city_id' => 'required|integer',
        'postal_code' => 'required|string',
        'phone' => 'required|string',
    ]);
    
    
    
    Address::create([
        'address' => $request->input('address'),
        'address2' => $request->input('address2'),
        'district' => $request->input('district'),
        'city_id' => $request->input('city_id'),
        'postal_code' => $request->input('postal_code'),
        'phone' => $request->input('phone'),
        'last_update' => now(),
    ]);
    
    $addresses = Address::paginate(40);
    
    return redirect()->route('Address'); 
    }


    /**
     * Update an address by its ID.
     *
     * @param AddressPutRequest $request : The request object.
     * @param int $id : The address ID.
     * @return JsonResponse
     */
    public function update(Request $request, $id)
{
    $address = Address::findOrFail($id);

    $validatedData = $request->validate([
        'address' => 'required|string',
        'address2' => 'nullable|string',
        'district' => 'required|string',
        'city_id' => 'required|integer',
        'postal_code' => 'required|string',
        'phone' => 'required|string',
    ]);


    $address->update([
        'address' => $request->input('address'),
        'address2' => $request->input('address2'),
        'district' => $request->input('district'),
        'city_id' => $request->input('city_id'),
        'postal_code' => $request->input('postal_code'),
        'phone' => $request->input('phone'),
        'last_update' => now(),
    ]);

    return redirect()->route('Address'); 
}


    /**
     * Delete an address by its ID.
     *
     * @param int $id : The address ID.
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
    
        return redirect()->route('Address');
    }

}