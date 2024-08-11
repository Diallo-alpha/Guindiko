<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRessourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'session_mentorat_id' => 'required|exists:session_mentorats,id',
            'titre' => 'required|string|max:255',
            'lien' => 'required|url',
        ];
    }
}
