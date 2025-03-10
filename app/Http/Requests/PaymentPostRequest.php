<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SebastianBergmann\Type\TrueType;

class PaymentPostRequest extends FormRequest
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
            'customer_id' => 'required|integer|exists:customer,customer_id',
            'staff_id' => 'required|integer|exists:staff,staff_id',
            'rental_id' => 'required|integer|exists:rental,rental_id',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
        ];
    }
}