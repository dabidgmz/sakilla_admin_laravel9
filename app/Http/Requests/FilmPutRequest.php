<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmPutRequest extends FormRequest
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
            'title' => 'nullable|string|max:128',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer',
            'language_id' => 'nullable|integer|exists:language,language_id',
            'original_language_id' => 'nullable|integer|exists:language,language_id',
            'rental_duration' => 'nullable|integer',
            'rental_rate' => 'nullable|numeric',
            'length' => 'nullable|integer',
            'replacement_cost' => 'nullable|numeric',
            'rating' => 'nullable|string',
            'special_features' => 'nullable|string',
        ];
    }
}