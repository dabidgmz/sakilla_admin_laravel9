<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressPutRequest extends FormRequest
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
            'address' => 'nullable|string|max:50',
            'address2' => 'nullable|string|max:50',
            'district' => 'nullable|string|max:20',
            'city_id' => 'nullable|integer|exists:city,city_id',
            'postal_code' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|json',
        ];
    }
}