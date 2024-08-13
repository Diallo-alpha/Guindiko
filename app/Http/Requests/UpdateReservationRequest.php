<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autoriser l'utilisateur à effectuer cette requête
    }

    public function rules()
    {
        return [
            'mentee_id' => 'exists:mentees,id',
            'session_mentorat_id' => 'exists:session_mentorats,id',
            'statut' => 'in:en attente,confirmée,annulée',
        ];
    }
}
