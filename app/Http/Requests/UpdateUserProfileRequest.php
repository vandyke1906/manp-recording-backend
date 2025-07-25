<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'middle_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'mobile_number' => ['required','string'],
            'address' => ['required','string'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.string' => 'First name must be a string.',

            'middle_name.required' => 'Middle name is required.',
            'middle_name.string' => 'Middle name must be a string.',

            'last_name.required' => 'Last name is required.',
            'last_name.string' => 'Last name must be a string.',

            'mobile_number.required' => 'Mobile number is required.',
            'mobile_number.string' => 'Mobile number must be a string.',

            'address.required' => 'Address is required.',
            'address.string' => 'Address must be a string.',
        ];
    }
}
