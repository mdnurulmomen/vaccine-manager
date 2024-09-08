<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPoliticalPartyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => request()->user()->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'political_party_id' => [
                'required', 'integer', 'exists:political_parties,id'
            ],

            'user_id' => [
                'required', 'integer', 'exists:users,id'
            ]
        ];
    }
}
