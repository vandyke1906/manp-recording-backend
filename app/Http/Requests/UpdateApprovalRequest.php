<?php

namespace App\Http\Requests;

use App\Http\Requests\CommonFormRequest;
use Illuminate\Validation\Rule;

class UpdateApprovalRequest extends CommonFormRequest
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
            'application_id' => 'required',
            'comment' => 'string',
            'status' => ['required', 'string', Rule::in(['pending', 'approved', 'rejected', 're_submit'])]
        ];
    }

    public function messages(): array
    {
        return [
            'application_id.required' => 'An application is required'
        ];
    }
}
