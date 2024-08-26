<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'date' => ['required', 'date'],
            'formation_id' => ['required', 'exists:formations,id'],
            'statut' => ['required', 'in:en attente,confirmée,terminée,annulée'],
            'duree' => ['required', 'integer'],

        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'La date de la session est requise.',
            'date.date' => 'La date de la session doit être une date valide.',
            'statut.required' => 'Le statut de la session est requis.',
            'statut.in' => 'Le statut doit être l\'une des valeurs suivantes : en attente, confirmée, terminée, annulée.',
            'duree.required' => 'La durée de la session est requise.',
            'duree.integer' => 'La durée de la session doit être un entier.',
            'formation_id.required' => 'L\'ID de la formation est requis.',
            'formation_id.exists' => 'La formation sélectionnée n\'existe pas.',
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
