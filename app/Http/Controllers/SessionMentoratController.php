<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionMentoratRequest;
use App\Http\Requests\UpdateSessionMentoratRequest;
use App\Models\SessionMentorat;
use App\Models\Notification;
use App\Models\Mentee;
use Illuminate\Http\Request;

class SessionMentoratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSessionMentoratRequest $request)
    {
        // Créer la session
        $session = SessionMentorat::create([
            'mentor_id' => $request->mentor_id,
            'title' => $request->title,
            'description' => $request->description,
            'scheduled_at' => $request->scheduled_at,
        ]);

        // Récupérer tous les mentees du mentor
        $mentees = Mentee::where('mentor_id', $request->mentor_id)->get();

        // Envoyer une notification à chaque mentee
        foreach ($mentees as $mentee) {
            Notification::create([
                'mentee_id' => $mentee->id,
                'mentor_id' => $request->mentor_id,
                'session_id' => $session->id,
                'message' => "Une nouvelle session '{$session->title}' a été ajoutée.",
            ]);
        }

        return response()->json(['message' => 'Session créée et notifications envoyées.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(SessionMentorat $sessionMentorat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SessionMentorat $sessionMentorat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSessionMentoratRequest $request, SessionMentorat $sessionMentorat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SessionMentorat $sessionMentorat)
    {
        //
    }
}
