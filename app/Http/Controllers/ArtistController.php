<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  Response
     */
    public function index()
    {
        $artists = Artist::all();

        return view('artist.index', [
            'artists' => $artists,
            'resource' => 'artistes',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (! Gate::allows('create-artist')) {
            abort(403);
        }

        return view('artist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Gate::allows('create-artist')) {
            abort(403);
        }

        //Validation des données du formulaire
        $validated = $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
        ]);

        //Le formulaire a été validé, nous créons un nouvel artiste à insérer
        $artist = new Artist();

        //Assignation des données et sauvegarde dans la base de données
        $artist->firstname = $validated['firstname'];
        $artist->lastname = $validated['lastname'];

        $artist->save();

        return redirect()->route('artist.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id): View|Factory|Application
    {
        $artist = Artist::find($id);

        //Récupérer les shows de l'artiste et les grouper par type
        $prestations = [];

        /*        foreach($artist->shows as $show) {
                    dump($show);
                    //$prestations[] = $at->show->title;
                }*/
        //dd($artist);
        return view('artist.show', [
            'artist' => $artist,
            'prestations' => $prestations,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (! Gate::allows('update-artist')) {
            abort(403);
        }

        $artist = Artist::find($id);

        return view('artist.edit', [
            'artist' => $artist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('update-artist')) {
            abort(403);
        }

        //Validation des données du formulaire
        $validated = $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
        ]);

        //Le formulaire a été validé, nous récupérons l’artiste à modifier
        $artist = Artist::find($id);

        //Mise à jour des données modifiées et sauvegarde dans la base de données
        $artist->update($validated);

        return view('artist.show', [
            'artist' => $artist,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('delete-artist')) {
            abort(403);
        }

        Artist::destroy($id);

        return redirect()->route('artist.index');
    }
}
