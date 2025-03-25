<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Clean the input data before validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => cleanStringSpaces($this->first_name),
            'last_name' => cleanStringSpaces($this->last_name),
            'email' => strtolower($this->email),
            'password' => trim($this->password),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'first_name' => [
                'required',
                'string',
                'min:3',
                'max:45',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'last_name' => [
                'required',
                'string',
                'min:3',
                'max:45',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'address_id' => [
                'required',
                'integer',
                'exists:address,address_id',
            ],
            'picture' => [
                'nullable',
                'string',
                'max:45',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:50',
                'lowercase',
            ],
            'store_id' => [
                'required',
                'integer',
                'exists:store,store_id',
            ],
            'active' => [
                'required',
                'boolean',
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:16',
                'regex:/^[a-zA-Z0-9_]+$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
            ],
            'role_id' => [
                'required',
                'integer',
                'exists:roles,id',
                Rule::in([2, 3]),
            ],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages()
    {
        return [
            '*.required' => ':attribute is required.',
            '*.string' => ':attribute must be a string.',
            '*.integer' => ':attribute must be an integer.',
            '*.boolean' => ':attribute must be true or false.',
            '*.exists' => ':attribute is invalid.',
            '*.min' => ':attribute must be at least :min characters.',
            '*.max' => ':attribute must not be greater than :max characters.',
            '*.regex' => ':attribute format is invalid.',
            '*.lowercase' => ':attribute must be in lowercase.',
            'email.email' => 'Email must be a valid address.',
            'password.regex' => 'The password does not meet the security requirements.',
        ];
    }
}