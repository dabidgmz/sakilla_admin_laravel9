<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'address_id' => 'required|integer|exists:address,address_id',
            'picture' => 'nullable|string|max:45',
            'email' => 'required|string|max:50',
            'store_id' => 'required|integer|exists:store,store_id',
            'active' => 'required|boolean',
            'username' => 'required|string|max:16',
            'password' => 'nullable|string|max:40',
        ];
    }
}