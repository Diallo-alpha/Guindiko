<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateForumRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette demande.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtenez les règles de validation qui s'appliquent à la demande.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'formation_id' => 'sometimes|exists:formations,id',
            'titre' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
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
            'formation_id.sometimes' => 'Le champ ID de la formation est obligatoire.',
            'formation_id.exists' => 'L\'ID de la formation spécifiée n\'existe pas.',
            'titre.sometimes' => 'Le champ titre est obligatoire.',
            'titre.string' => 'Le titre doit être une chaîne de caractères.',
            'titre.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ];
    }
}
