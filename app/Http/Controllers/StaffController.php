<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffPostRequest;
use App\Http\Requests\StaffPutRequest;
use App\Models\Staff;
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
    public function index(): JsonResponse {
        // Get all staff members with pagination
        $staff = Staff::paginate(20);

        return response()->json($staff);
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
    public function store(StaffPostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the staff member
        $staff = Staff::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address_id' => $request->input('address_id'),
            'picture' => $request->input('picture'),
            'email' => $request->input('email'),
            'store_id' => $request->input('store_id'),
            'active' => $request->input('active'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'last_update' => now(),
        ]);

        return response()->json($staff, 201);
    }

    /**
     * Update a staff member by its ID.
     *
     * @param StaffPutRequest $request : The request object.
     * @param int $id : The staff ID.
     * @return JsonResponse
     */
    public function update(StaffPutRequest $request, int $id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Check if at least one field is filled
        if (empty($request->all())) {
            return response()->json(['message' => 'You must specify at least one field to update.'], 400);
        }

        // Search the staff member by its ID
        $staff = Staff::where('staff_id', $id)->first();

        // If the staff member does not exist, return an error
        if (!$staff) {
            return response()->json(['message' => 'Staff member not found.'], 404);
        }

        // Update only provided fields
        $staff->fill($request->only([
            'first_name', 'last_name', 'address_id', 'picture', 
            'email', 'store_id', 'active', 'username'
        ]));

        if ($request->has('password')) {
            $staff->password = bcrypt($request->input('password'));
        }

        $staff->last_update = now();
        $staff->save();

        return response()->json($staff);
    }

    /**
     * Delete a staff member by its ID.
     *
     * @param int $id : The staff ID.
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        // Search the staff member by its ID
        $staff = Staff::where('staff_id', $id)->first();

        // If the staff member does not exist, return an error
        if (!$staff) {
            return response()->json(['message' => 'Staff member not found.'], 404);
        }

        // Delete the staff member
        $staff->delete();

        return response()->json(['message' => 'Staff member deleted.']);
    }
}