<?php

namespace App\Http\Controllers;

use App\Models\Locality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LocalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localities = Locality::all();

        return view('locality.index', [
            'localities' => $localities,
            'resource' => 'localities',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('create-locality')) {
            abort(403);
        }

        return view('locality.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('create-locality')) {
            abort(403);
        }

        //Validation des données du formulaire
        $validated = $request->validate([
            'postcode' => 'required|max:6',
            'locality_fr' => 'required|max:60',
            'locality_nl' => 'required|max:60',
        ]);

        //Le formulaire a été validé, nous créons un nouvel artiste à insérer
        $locality = new Locality();

        //Assignation des données et sauvegarde dans la base de données
        $locality->postcode = $validated['postcode'];
        $locality->locality_fr = $validated['locality_fr'];
        $locality->locality_nl = $validated['locality_nl'];
        $locality->save();

        return redirect()->route('locality.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locality = Locality::find($id);

        return view('locality.show', [
            'locality' => $locality,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('update-locality')) {
            abort(403);
        }

        $locality = Locality::find($id);

        return view('locality.edit', [
            'locality' => $locality,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('update-locality')) {
            abort(403);
        }

        //Validation des données du formulaire
        $validated = $request->validate([
            'postcode' => 'required|max:6',
            'locality_fr' => 'required|max:60',
            'locality_nl' => 'required|max:60',
        ]);

        //Le formulaire a été validé, nous récupérons l’artiste à modifier
        $locality = Locality::find($id);

        //Mise à jour des données modifiées et sauvegarde dans la base de données
        $locality->update($validated);

        return view('locality.show', [
            'locality' => $locality,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('delete-locality')) {
            abort(403);
        }

        Locality::destroy($id);

        return redirect()->route('locality.index');
    }
}
