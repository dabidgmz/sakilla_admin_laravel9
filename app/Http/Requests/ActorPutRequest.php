<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActorPutRequest extends FormRequest
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
            'first_name' => 'nullable|string|max:45',
            'last_name' => 'nullable|string|max:45',
        ];
    }
}
