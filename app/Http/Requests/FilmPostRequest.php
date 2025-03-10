<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmPostRequest extends FormRequest
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
            'title' => 'required|string|max:128',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer',
            'language_id' => 'required|integer|exists:language,language_id',
            'original_language_id' => 'nullable|integer|exists:language,language_id',
            'rental_duration' => 'required|integer',
            'rental_rate' => 'required|numeric',
            'length' => 'nullable|integer',
            'replacement_cost' => 'required|numeric',
            'rating' => 'nullable|string',
            'special_features' => 'nullable|string',
        ];
    }
}