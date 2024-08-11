<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRessourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'session_mentorat_id' => 'sometimes|exists:session_mentorats,id',
            'titre' => 'sometimes|string|max:255',
            'lien' => 'sometimes|url',
        ];
    }
}
