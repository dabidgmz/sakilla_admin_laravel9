<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Log::info('Authorize method called in RegisterRequest.');
        return true;
    }

    /**
     * Clean the input data before validation.
     *
     * @return void
     */
    // protected function prepareForValidation()
    // {
    //     Log::info('Preparing data for validation in RegisterRequest.', [
    //         'original_data' => $this->all(),
    //     ]);

    //     $this->merge([
    //         'first_name' => cleanStringSpaces($this->first_name),
    //         'second_name' => cleanStringSpaces($this->second_name),
    //         'last_name' => cleanStringSpaces($this->last_name),
    //         'password' => trim($this->password),
    //         'email' => strtolower($this->email),
    //     ]);

    //     Log::info('Data after preparation in RegisterRequest.', [
    //         'prepared_data' => $this->all(),
    //     ]);
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        Log::info('Validation rules method called in RegisterRequest.');
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
            'email' => [
                'required',
                'string',
                'email',
                'max:50',
                'lowercase',
                'unique:staff,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/'
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:16',
                'regex:/^[a-zA-Z0-9_]+$/',
                'unique:staff,username',
            ],
            'address_id' => [
                'required',
                'integer',
                'exists:address,address_id',
            ],
            'store_id' => [
                'required',
                'integer',
                'exists:store,store_id',
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
        Log::info('Validation messages method called in RegisterRequest.');
        return [
            '*.required' => ':attribute is required.',
            '*.string' => ':attribute must be a string.',
            '*.integer' => ':attribute must be an integer.',
            '*.exists' => ':attribute is invalid.',
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
}
