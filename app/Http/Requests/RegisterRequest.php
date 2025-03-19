<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'second_name' => [
                'nullable',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'last_name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:254',
                'lowercase',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:64',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/'
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
            '*.unique' => ':attribute is already in use.',
            '*.lowercase' => ':attribute must be in lowercase.',
            '*.regex' => ':attribute format is invalid.',
            'email.email' => 'Email must be a valid address.',
            'password.confirmed' => 'The passwords do not match.',
            'password.regex' => 'The password does not meet the security requirements.',
            'h-captcha-response.required' => 'Captcha verification is required.',
        ];
    }

    /**
     * Clean the input data before validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => cleanStringSpaces($this->first_name),
            'second_name' => cleanStringSpaces($this->second_name),
            'last_name' => cleanStringSpaces($this->last_name),
            'password' => trim($this->password),
            'email' => strtolower($this->email),
        ]);
    }
}
