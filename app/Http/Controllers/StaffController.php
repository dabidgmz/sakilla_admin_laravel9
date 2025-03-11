<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffPostRequest;
use App\Http\Requests\StaffPutRequest;
use App\Models\Staff;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Get all staff members with pagination.
     * The staff members are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index() {
        // Get all staff members with pagination
        $perPage = 810;
        $staff = Staff::paginate($perPage);

        return View('Staff', compact('staff'));
    }

    /**
     * Get a staff member by its ID.
     *
     * @param int $id : The staff ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the staff member by its ID
        $staff = Staff::where('staff_id', $id)->first();

        // If the staff member does not exist, return an error
        if (!$staff) {
            return response()->json(['message' => 'Staff member not found.'], 404);
        }

        return response()->json($staff);
    }

    /**
     * Create a new staff member.
     *
     * @param StaffPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(Request $request) {
        $staff = Staff::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address_id' => $request->input('address_id'),
            'picture' => $request->input('picture') ?? null, 
            'email' => $request->input('email'),
            'store_id' => $request->input('store_id'),
            'active' => $request->input('active'),
            'username' => $request->input('username'),
            'password' => $request->filled('password') ? sha1($request->input('password')) : null, 
            'last_update' => now(),
        ]);
    
        return redirect()->route('Staff');
    }

    /**
     * Update a staff member by its ID.
     *
     * @param StaffPutRequest $request : The request object.
     * @param int $id : The staff ID.
     * @return JsonResponse
     */
    public function update(Request $request, int $id) {
        $staff = Staff::findOrFail($id);
    
        $staff->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address_id' => $request->input('address_id'),
            'picture' => $request->input('picture'),
            'email' => $request->input('email'),
            'store_id' => (int) $request->input('store_id'), // Convertir a int si es necesario
            'active' => (bool) $request->input('active'), // Convertir a booleano si es necesario
            'username' => $request->input('username'),
            'password' => $request->filled('password') ? sha1($request->input('password')) : $staff->password,
            'last_update' => now(),
        ]);
    
        return redirect()->route('Staff');
    }
    


    /**
     * Delete a staff member by its ID.
     *
     * @param int $id : The staff ID.
     * @return JsonResponse
     */
    public function destroy(int $id) {
        // Search the staff member by its ID
        $staff = Staff::findOrFail($id); 
        $staff->delete();
        return redirect()->route('Staff');
    }
}