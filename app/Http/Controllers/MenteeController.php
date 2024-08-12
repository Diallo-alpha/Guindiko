<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenteeRequest;
use App\Http\Requests\UpdateMenteeRequest;
use App\Models\Mentee;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MenteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Votre code ici
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Votre code ici
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenteeRequest $request)
    {
        // Votre code ici
    }

    /**
     * Display the specified resource.
     */
    public function show(Mentee $mentee)
    {
        // Votre code ici
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mentee $mentee)
    {
        // Votre code ici
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenteeRequest $request, Mentee $mentee)
    {
        // Votre code ici
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentee $mentee)
    {
        // Votre code ici
    }

    /**
     * Récupérer les notifications pour un mentee spécifique.
     */
    public function getNotifications($mentee_id): JsonResponse
    {
        $notifications = Notification::where('mentee_id', $mentee_id)
                                      ->orderBy('created_at', 'desc')
                                      ->get();

        return response()->json($notifications);
    }
}
