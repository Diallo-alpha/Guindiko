<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'parcours_academique' => 'required|string',
            'diplome' => 'required|string',
            'langue' => 'required|string',
            'cv' => 'nullable|string',
            'experience' => 'nullable|string',
            'domaine' => 'required|string',
            'formation_id' => 'required|exists:formations,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'parcours_academique' => $request->parcours_academique,
            'diplome' => $request->diplome,
            'langue' => $request->langue,
            'cv' => $request->cv,
            'experience' => $request->experience,
            'domaine' => $request->domaine,
            'formation_id' => $request->formation_id,
        ]);

        // Assigner le rôle de mentee
        $user->assignRole('mentee');

        // Générer un jeton JWT
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    // Ajout de la méthode unauthenticated
    protected function unauthenticated($request, array $guards)
    {
        return response()->json(['message' => 'Unauthenticated.'], 401);

    }
    //mettre a jour le profil de l'utilisateur
    public function updateProfile(Request $request)
{
    // Validate the input data
    $validator = Validator::make($request->all(), [
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|string|email|max:255|unique:users,email,' . auth()->id(),
        'password' => 'nullable|string|min:6|confirmed',
        'parcours_academique' => 'nullable|string',
        'diplome' => 'nullable|string',
        'langue' => 'nullable|string',
        'cv' => 'nullable|string',
        'experience' => 'nullable|string',
        'domaine' => 'nullable|string',
        'formation_id' => 'nullable|exists:formations,id',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Update user profile data
    $user = auth()->user();
    $user->name = $request->get('name', $user->name);
    $user->email = $request->get('email', $user->email);

    if ($request->has('password') && $request->password) {
        $user->password = Hash::make($request->password);
    }

    $user->parcours_academique = $request->get('parcours_academique', $user->parcours_academique);
    $user->diplome = $request->get('diplome', $user->diplome);
    $user->langue = $request->get('langue', $user->langue);
    $user->cv = $request->get('cv', $user->cv);
    $user->experience = $request->get('experience', $user->experience);
    $user->domaine = $request->get('domaine', $user->domaine);
    $user->formation_id = $request->get('formation_id', $user->formation_id);

    $user->save();

    return response()->json(['message' => 'Profile updated successfully', 'user' => $user], 200);
}

//supprimer les donneés d'un profile
public function clearProfileFields(Request $request)
{
    // Define the fields that the user can clear
    $fieldsToClear = [
        'name',
        'parcours_academique',
        'diplome',
        'langue',
        'cv',
        'experience',
        'domaine',
        'formation_id'
    ];

    $user = auth()->user();

    foreach ($fieldsToClear as $field) {
        // Clear the fields only if the user has requested it in the payload
        if ($request->has($field)) {
            $user->{$field} = null;
        }
    }

    $user->save();

    return response()->json(['message' => 'Profile fields cleared successfully', 'user' => $user], 200);
}

}
