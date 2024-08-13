<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRessourceRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'session_mentorat_id' => 'sometimes|exists:session_mentorats,id',
            'titre' => 'sometimes|string|max:255',
            'lien' => 'sometimes|url',
        ];
    }
}
