<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormationRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Autorise toutes les requêtes
    }

    /**
     * Obtenez les règles de validation qui s'appliquent à la requête.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'domaine_id' => 'required|exists:domaines,id',
        ];
    }

    /**
     * Obtenez les messages de validation personnalisés.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la formation est requis.🫡🫡🫡',
            'nom.string' => 'Le nom doit être une chaîne de caractères.🫡🫡🫡',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.🫡🫡🫡',
            'description.string' => 'La description doit être une chaîne de caractères.🫡🫡🫡',
            'domaine_id.required' => 'L\'ID du domaine est requis.🫡🫡🫡',
            'domaine_id.exists' => 'Le domaine sélectionné n\'existe pas.🫡🫡🫡',
        ];
    }
}
