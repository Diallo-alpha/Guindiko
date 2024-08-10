<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRessourcesRequest;
use App\Http\Requests\UpdateRessourcesRequest;
use App\Models\Ressources;

class RessourcesController extends Controller
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
    public function store(StoreRessourcesRequest $request)
    {
        // Validation est déjà faite par StoreRessourcesRequest
        $ressource = Ressources::create($request->validated());
        return response()->json($ressource, 201); // 201 Created
    }


    /**
    * Display the specified resource.
    */
    public function show(Ressources $ressources)
    {
        return response()->json($ressources);
    }


    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Ressources $ressources)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(UpdateRessourcesRequest $request, Ressources $ressources)
    {
        // Validation est déjà faite par UpdateRessourcesRequest
        $ressources->update($request->validated());
        return response()->json($ressources);
    }


    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Ressources $ressources)
    {
        $ressources->delete();
        return response()->json(null, 204); // 204 No Content
    }

}
