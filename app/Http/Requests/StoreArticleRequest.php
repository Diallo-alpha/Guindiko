<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'formation_id' => 'required|exists:formations,id',
            'image' => 'nullable|string|max:255',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
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
            'formation_id.required' => 'Le champ ID de la formation est obligatoire.',
            'formation_id.exists' => 'L\'ID de la formation spécifiée n\'existe pas.',
            'image.string' => 'Le champ image doit être une chaîne de caractères.',
            'image.max' => 'Le champ image ne peut pas dépasser 255 caractères.',
            'titre.required' => 'Le champ titre est obligatoire.',
            'titre.string' => 'Le titre doit être une chaîne de caractères.',
            'titre.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'description.required' => 'Le champ description est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ];
    }
}
