<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionMentoratMenteeRequest extends FormRequest
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
            'session_mentorat_id' => 'required|exists:session_mentorats,id',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'session_mentorat_id.required' => 'Le champ session_mentorat_id est obligatoire.',
            'session_mentorat_id.exists' => 'La session de mentorat sélectionnée est invalide.',
            'user_id.required' => 'Le champ user_id est obligatoire.',
            'user_id.exists' => 'Le user sélectionné est invalide.',
        ];
    }
}
