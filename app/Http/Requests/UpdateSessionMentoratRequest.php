<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionMentoratRequest extends FormRequest
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
            'mentor_id' => 'sometimes|required|exists:mentors,id',
            'date' => 'sometimes|required|date',
            'statut' => 'sometimes|required|in:en attente,confirmée,terminée',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Le user est requis.',
            'user_id.exists' => 'Le user sélectionné n\'existe pas.',
            'date.required' => 'La date de la session est requise.',
            'date.date' => 'La date de la session doit être une date valide.',
            'statut.required' => 'Le statut de la session est requis.',
            'statut.in' => 'Le statut doit être l\'une des valeurs suivantes : en attente, confirmée, terminée.',
        ];
    }
}
