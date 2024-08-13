<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentaireRequest extends FormRequest
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
            'session_mentorat_id' => 'required|exists:session_mentorats,id',
            'mentee_id' => 'required|exists:mentees,id',
            'contenu' => 'required|string',
        ];
    }

    /**
     * Obtenez les messages de validation personnalisés.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'session_mentorat_id.required' => 'Le champ ID de la session de mentorat est obligatoire.',
            'session_mentorat_id.exists' => 'L\'ID de la session de mentorat spécifiée n\'existe pas.',
            'mentee_id.required' => 'Le champ ID du mentee est obligatoire.',
            'mentee_id.exists' => 'L\'ID du mentee spécifié n\'existe pas.',
            'contenu.required' => 'Le champ contenu est obligatoire.',
            'contenu.string' => 'Le contenu doit être une chaîne de caractères.',
        ];
    }
}
