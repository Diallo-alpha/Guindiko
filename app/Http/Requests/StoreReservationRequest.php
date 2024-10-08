<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autoriser l'utilisateur à effectuer cette requête
    }

    public function rules()
    {
        return [

            // 'user_id' => 'required|exists:users,id',
            'session_mentorat_id' => 'required|exists:session_mentorats,id',
            'statut' => 'required|in:en attente,confirmée,annulée',
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
