<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'password' => trim($this->password),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'staff_id' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/'
            ],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            '*.required' => ':attribute is required.',
            '*.string' => ':attribute must be a string.',
            '*.min' => ':attribute must be at least :min characters.',
            '*.max' => ':attribute must not exceed :max characters.',
            '*.confirmed' => 'The :attribute confirmation does not match.',
            '*.regex' => ':attribute format is invalid.',
        ];
    }
}
