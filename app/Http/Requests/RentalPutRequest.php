<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalPutRequest extends FormRequest
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
            'rental_date' => 'nullable|date',
            'inventory_id' => 'nullable|integer|exists:inventory,inventory_id',
            'customer_id' => 'nullable|integer|exists:customer,customer_id',
            'return_date' => 'nullable|date',
            'staff_id' => 'nullable|integer|exists:staff,staff_id',
        ];
    }
}