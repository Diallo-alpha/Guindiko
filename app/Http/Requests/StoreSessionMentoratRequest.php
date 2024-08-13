<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionMentoratRequest extends FormRequest
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
            'mentor_id' => ['required', 'exists:mentors,id'],
            'mentee_id' => ['required', 'exists:mentees,id'],
            'date' => ['required', 'date'],
            'statut' => ['required', 'in:en attente,confirmée,terminée'],
        ];
    }

    public function messages(): array
    {
        return [
            'mentor_id.required' => 'Le mentor est requis.',
            'mentor_id.exists' => 'Le mentor sélectionné n\'existe pas.',
            'mentee_id.required' => 'Le mentee est requis.',
            'mentee_id.exists' => 'Le mentee sélectionné n\'existe pas.',
            'date.required' => 'La date de la session est requise.',
            'date.date' => 'La date de la session doit être une date valide.',
            'statut.required' => 'Le statut de la session est requis.',
            'statut.in' => 'Le statut doit être l\'une des valeurs suivantes : en attente, confirmée, terminée.',
        ];
    }
}
