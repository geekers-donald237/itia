<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\User;
use Illuminate\Http\Request;


class AssuranceController extends Controller
{
    public function index()
    {
        $assurances = Assurance::whereIsDeleted(false)->get();
        $clients = User::whereIsDeleted(false)->get();

        return view('assurances.index', compact('assurances', 'clients'));
    }

    public function create()
    {
        $clients = User::whereIsDeleted(false)->get();
        return view('assurances.create', compact('clients'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'type' => 'required',
            'montant' => 'required|numeric',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'client_id' => 'exists:users,id', // Client est facultatif, donc exists sans required
        ]);

        $assurance = new Assurance([
            'type' => $request->input('type'),
            'montant' => $request->input('montant'),
            'date_debut' => $request->input('date_debut'),
            'date_fin' => $request->input('date_fin'),
        ]);

        if ($request->input('client_id') != null) {
            $assurance->user_id = $request->input('client_id');
        }
        $assurance->save();
        return redirect()->back()->with('success', 'Assurance enregistrée avec succès!');
    }

    public function edit($id)
    {
        $assurance = Assurance::findOrFail($id);
        $clients = User::whereIsDeleted(false)->get();
        return view('assurances.edit', compact('assurance', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $assurance = Assurance::findOrFail($id);

        $request->validate([
            'type' => 'required',
            'montant' => 'required|numeric',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'client_id' => 'required|exists:clients,id',
            // Ajoutez d'autres règles de validation selon vos besoins
        ]);

        $assurance->update([
            'type' => $request->input('type'),
            'montant' => $request->input('montant'),
            'date_debut' => $request->input('date_debut'),
            'date_fin' => $request->input('date_fin'),
        ]);

        $client = User::findOrFail($request->input('client_id'));
        $assurance->client()->associate($client);
        $assurance->save();

        return redirect('/assurance')->with('success', 'Assurance mise à jour avec succès!');
    }

    public function destroy($id)
    {
        $assurance = Assurance::findOrFail($id);
        $assurance->delete(); // Supprime physiquement l'assurance
        return redirect()->back()->with('success', 'Assurance supprimée avec succès!');
    }
}
