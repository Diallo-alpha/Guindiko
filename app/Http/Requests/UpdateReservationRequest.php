<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autoriser l'utilisateur à effectuer cette requête
    }

    public function rules()
    {
        return [
            'user_id' => 'exists:users,id',
            'session_mentorat_id' => 'exists:session_mentorats,id',
            'statut' => 'in:en attente,confirmée,annulée',
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
