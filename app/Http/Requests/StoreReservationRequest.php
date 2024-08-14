<?php

namespace App\Http\Requests;

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
            'session_mentorat_id' => 'required|exists:session_mentorats,id',
            'statut' => 'required|in:en attente,confirmée,annulée',
        ];
    }
}
