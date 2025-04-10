<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePutRequest extends FormRequest
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
            'manager_staff_id' => 'nullable|integer|exists:staff,staff_id',
            'address_id' => 'nullable|integer|exists:address,address_id',
        ];
    }
}