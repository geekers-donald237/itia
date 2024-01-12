<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            // Ajoutez d'autres règles de validation selon vos besoins
        ]);

        $client = new User([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
        ]);

        $client->save();

        return redirect()->back()->with('success', 'Client enregistré avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = User::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function destroy($id)
    {
        $client = User::findOrFail($id);
        $client->update(['is_deleted' => true]);
        return redirect()->back()->with('success', 'Client supprimé avec succès!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}
