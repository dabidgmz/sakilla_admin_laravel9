<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalPostRequest extends FormRequest
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
            'rental_date' => 'required|date',
            'inventory_id' => 'required|integer|exists:inventory,inventory_id',
            'customer_id' => 'required|integer|exists:customer,customer_id',
            'return_date' => 'required|date',
            'staff_id' => 'required|integer|exists:staff,staff_id',
        ];
    }
}