<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentPutRequest extends FormRequest
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
            'customer_id' => 'nullable|integer|exists:customer,customer_id',
            'staff_id' => 'nullable|integer|exists:staff,staff_id',
            'rental_id' => 'nullable|integer|exists:rental,rental_id',
            'amount' => 'nullable|numeric',
            'payment_date' => 'nullable|date',
        ];
    }
}