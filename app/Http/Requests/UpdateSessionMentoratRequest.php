<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'formation_id' => ['sometimes', 'exists:formations,id'], // Mise à jour ici
            'date' => ['sometimes', 'date'],
            'statut' => ['sometimes', 'in:en attente,confirmée,terminée,annulée'], // Correction ajoutée
            'duree' => ['sometimes', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'formation_id.exists' => 'La formation sélectionnée n\'existe pas.', // Mise à jour ici
            'date.date' => 'La date de la session doit être une date valide.',
            'statut.in' => 'Le statut doit être l\'une des valeurs suivantes : en attente, confirmée, terminée, annulée.',
            'duree.integer' => 'La durée de la session doit être un entier.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422));
    }
}
