<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * @param $id - ID du spectacle
 * @return $show - JSON de la réponse
 * Recherche un spectacle avec son ID et récupère l'entièreté des informations liées
 *
 */
Route::get('/show/{id}', function ($id){

    $show = \App\Models\Show::find($id);
    $show->location = \App\Models\Location::find($show->location_id);
    $show->location->locality = \App\Models\Locality::find($show->location->locality_id);
    $show->representations = \App\Models\Representation::where('show_id', $show->id)->get();

    unset($show->location_id, $show->location->locality_id);
    foreach ($show->representations as $representation) {
        $representation->location = \App\Models\Location::find($representation->location_id);
        $representation->locality = \App\Models\Locality::find($representation->location->locality_id);
        unset($representation->show_id, $representation->location_id, $representation->location->locality_id);
    }

    return response()->json($show);
});

/**
 * @param $id - ID du spectacle
 * @return $representation - JSON de la réponse
 * Recherche un spectacle avec son ID et renvoie uniquement les représentations de ce spectacle
 *
 */
Route::get('/show/{id}/representations', function($id){

    $representations = \App\Models\Representation::where('show_id', $id)->get();

        foreach ($representations as $representation) {
            $representation->location = \App\Models\Location::find($representation->location_id);
            $representation->location->locality = \App\Models\Locality::find($representation->location->locality_id);

            unset($representation->location_id, $representation->location->locality_id);
        }

        return response()->json($representations);
});


/**
 * @param $id - ID de la représentation
 * @return $representation - JSON de la réponse
 * Recherche une représentation avec son ID et renvoie l'entièreté des informations liées
 *
 */
Route::get('/representation/{id}', function($id){
    $representation = \App\Models\Representation::find($id);
    $representation->location = \App\Models\Location::find($representation->location_id);
    $representation->location->locality = \App\Models\Locality::find($representation->location->locality_id);

    $representation->show = \App\Models\Show::find($representation->show_id);
    $representation->show->poster = url('/storage/' . $representation->show->poster_url);

    unset(
        $representation->location_id,
        $representation->show_id,
        $representation->location->locality_id,
        $representation->show->location_id,
        $representation->show->poster_url

    );
    return response()->json($representation);
});

Route::get('/search/representations/{date}', function($date){
    $date = \Carbon\Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
    //dd($date->format(('Y-m-d')));
    $representations = \App\Models\Representation::whereDate('when', $date)->get();

    foreach ($representations as $representation) {
        $representation->show = \App\Models\Show::find($representation->show_id);
        $representation->location = \App\Models\Location::find($representation->location_id);
        $representation->location->locality = \App\Models\Locality::find($representation->location->locality_id);

        unset($representation->show_id,
            $representation->show->location_id,
            $representation->location_id,
            $representation->location->locality_id
        );
    }

    return response()->json($representations);

})->where('date', '[0-9]{2}-[0-9]{2}-[0-9]{4}');
