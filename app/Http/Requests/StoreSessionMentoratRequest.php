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
            'mentort_id' => ['required', 'exists:mentorts,id'],
            'date' => ['required', 'date'],
            'statut' => ['required', 'in:en attente,confirmée,terminée'],
            'duree' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'mentort_id.required' => 'Le mentor est requis.',
            'mentort_id.exists' => 'Le mentor sélectionné n\'existe pas.',
            'date.required' => 'La date de la session est requise.',
            'date.date' => 'La date de la session doit être une date valide.',
            'statut.required' => 'Le statut de la session est requis.',
            'statut.in' => 'Le statut doit être l\'une des valeurs suivantes : en attente, confirmée, terminée.',
            'duree.required' => "la durrée de la session est requit",
        ];
    }
}
