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
            'user_id' => 'required|exists:users,id', 
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
            'session_mentorat_id.required' => 'La session de mentorat est requise.',
            'session_mentorat_id.exists' => 'La session de mentorat n\'existe pas.',
            'user_id.required' => 'L\'utilisateur est requis.',
            'user_id.exists' => 'L\'utilisateur n\'existe pas.',
            'contenu.required' => 'Le contenu du commentaire est requis.',
            'contenu.string' => 'Le contenu du commentaire doit être une chaîne de caractères.',
        ];
    }
}
