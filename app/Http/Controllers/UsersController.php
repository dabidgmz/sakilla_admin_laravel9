<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserPutRequest;
use App\Models\Staff;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Get all users with pagination.
     * The users are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     * 
     * @param int page : The page number.
     * @return JsonResponse 
     */
    public function index() {
        // Get all users with pagination
        $perPage = 20;
        $users = Staff::whereIn('role_id', [2,3])->paginate($perPage);

        return response()->json($users); // Por corregir
        // return View('Users', compact('users'));
    }

    /**
     * Get a user by its ID.
     * 
     * @param int $id : The user ID.
     * @return JsonResponse 
     */
    public function show(int $id) {
        // Search the user by its ID
        $user = Staff::where('staff_id', $id)->first();

        // If the user does not exist, return an error
        if (!$user)
            return redirect()->back()->with('user', 'User not found.');

        return response()->json($user); // Por corregir
        // return View('User', compact('user'));
    }

    /**
     * Create a new user.
     * 
     * @param UserPostRequest $request : The request object.
     * @return JsonResponse 
     */
    public function store(UserPostRequest $request) {
        $user = Staff::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address_id' => $request->input('address_id'),
            'picture' => $request->input('picture') ?? null, 
            'email' => $request->input('email'),
            'store_id' => $request->input('store_id'),
            'active' => $request->input('active'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role_id' => $request->input('role_id')
        ]);

        return response()->json($user); // Por corregir
    }

    /**
     * Update a user by its ID.
     * 
     * @param UserPutRequest $request : The request object.
     * @param int $id : The user ID.
     * @return JsonResponse 
     */
    public function update(UserPutRequest $request, int $id) {
        $user = Staff::where('staff_id', $id)->first();

        if (!$user)
            return redirect()->back()->with('user', 'User not found.');

        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address_id' => $request->input('address_id'),
            'picture' => $request->input('picture') ?? null, 
            'email' => $request->input('email'),
            'store_id' => $request->input('store_id'),
            'active' => $request->input('active'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role_id' => $request->input('role_id')
        ]);

        return response()->json($user); // Por corregir
    }

    /**
     * Delete a user by its ID.
     * 
     * @param int $id : The user ID.
     * @return JsonResponse 
     */
    public function destroy(int $id) {
        $user = Staff::where('staff_id', $id)->first();

        if (!$user)
            return redirect()->back()->with('user', 'User not found.');

        $user->delete();

        return response()->json($user); // Por corregir
    }
}