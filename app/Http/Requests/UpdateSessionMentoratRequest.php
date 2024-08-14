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
            'user_id' => ['sometimes', 'exists:users,id'],
            'formation_mentor_id' => ['sometimes', 'exists:mentors,id'],
            'date' => ['sometimes', 'date'],
            'statut' => ['sometimes', 'in:en attente,confirmée,terminée'],
            'duree' => ['sometimes', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
             'user_id.exists' => 'Le user sélectionné n\'existe pas.',
            'formation_mentor_id.exists' => 'Le mentor sélectionné n\'existe pas.',
            'date.date' => 'La date de la session doit être une date valide.',
            'statut.in' => 'Le statut doit être l\'une des valeurs suivantes : en attente, confirmée, terminée.',
            'dure.in' => 'Leoit être en entier',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'errors'      => $validator->errors()
        ], 422));
    }
}
