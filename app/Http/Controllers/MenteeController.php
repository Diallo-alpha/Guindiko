<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMenteeRequest;
use App\Http\Requests\UpdateMenteeRequest;

class MenteeController extends Controller
{
    public function __construct()
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
    public function store(StoreMenteeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mentee $mentee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mentee $mentee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenteeRequest $request, Mentee $mentee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentee $mentee)
    {
        //
    }
}
