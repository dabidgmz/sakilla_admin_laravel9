<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'role_id' => $this->input('role', '2'),
            'email' => strtolower($this->email),
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
            'role_id' => [
                'required',
                'integer',
                'exists:roles,id',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:50',
                'lowercase',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
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
            '*.min' => ':attribute must be at least :min characters.',
            '*.max' => ':attribute must not be greater than :max characters.',
            '*.lowercase' => ':attribute must be lowercase.',
            'email.email' => 'Email must be a valid address.',
            'h-captcha-response.required' => 'Captcha verification is required.',
            'h-captcha-response.string' => 'Captcha verification must be a string.',
        ];
    }
}