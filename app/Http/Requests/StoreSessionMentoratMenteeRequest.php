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
            'mentee_id' => 'required|exists:mentees,id',
        ];
    }

    public function messages(): array
    {
        return [
            'session_mentorat_id.required' => 'Le champ session_mentorat_id est obligatoire.',
            'session_mentorat_id.exists' => 'La session de mentorat sélectionnée est invalide.',
            'mentee_id.required' => 'Le champ mentee_id est obligatoire.',
            'mentee_id.exists' => 'Le mentee sélectionné est invalide.',
        ];
    }
}
