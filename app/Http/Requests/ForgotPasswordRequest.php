<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
     * Clean the input data before validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'email' => strtolower($this->email),
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
            'email' => [
                'required',
                'string',
                'email',
                'max:50',
                'lowercase',
            ],
            'h-captcha-response' => [
                'required',
                'string',
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
            '*.email' => ':attribute must be a valid email address.',
            '*.max' => ':attribute must not exceed :max characters.',
            '*.lowercase' => ':attribute must be in lowercase.',
            'h-captcha-response.required' => 'Captcha verification is required.',
            'h-captcha-response.string' => 'Captcha verification must be a string.',
        ];
    }
}
