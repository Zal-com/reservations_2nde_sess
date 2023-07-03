<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function index()
    {
        debugbar()->info('Some information');

        return view('request.index');
    }

    public function resolver(int $id)
    {
        $shows = [];
        $uniqueResult = null;

        switch($id) {
            case 1:
                $shows = DB::table('shows')
                    ->where('bookable', 1)
                    ->get();
                //dd($shows);
                break;
            case 2:
                $shows = DB::table('shows')
                    ->where('bookable', 1)
                    ->where('price', '<', 9)
                    ->get();
                //dd($shows);
                break;
            case 3:
                $shows = DB::table('shows')
                    ->where('bookable', 1)
                    ->where('price', '>', 5)
                    ->where('price', '<', 9)
                    ->get();
                //dd($shows);
                break;
            case 4:
                // (location = dexia-art-center)
                $location = DB::table('locations')
                    ->select('id')
                    ->where('slug', 'dexia-art-center')
                    ->first();
                //dd( $location?->id);
                $shows = DB::table('shows')
                    ->where('location_id', '=', $location?->id)
                    ->get();
                //dd($shows);
                break;
            case 5:
                // (locality = bruxelles)
                $locality = DB::table('localities')
                    ->select('id')
                    ->where('postcode', '=', 1000)
                    ->first();
                //dd($locality);
                $location = DB::table('locations')
                    ->select('id')
                    ->where('locality_id', '=', $locality?->id)
                    ->first();
                //dd( $location?->id);
                $shows = DB::table('shows')
                    ->where('location_id', '=', $location?->id)
                    ->get();
                //dd($shows);
                break;
            case 6:
                // (scenographe = 'Nasri Mohamed')
                $artist = DB::table('artists')
                    ->select('id')
                    ->where('firstname', '=', 'Nasri')
                    ->where('lastname', '=', 'Mohamed')
                    ->first();
                //dd($artist);
                $type = DB::table('types')
                    ->select('id')
                    ->where('type', '=', 'scénographe')
                    ->first();
                //dd($type);
                $artistType = DB::table('artist_type')
                    ->select('id')
                    ->where('artist_id', '=', $artist?->id)
                    ->where('type_id', '=', $type?->id)
                    ->first();
                //dd($artistType);
                $artistTypeShow = DB::table('artist_type_show')
                    ->select('show_id')
                    ->where('artist_type_id', '=', $artistType?->id)
                    ->get();
                //dd($artistTypeShow);
                $show = DB::table('shows')
                    ->where('id', '=', $artistTypeShow[0]?->show_id)
                    ->get();
                //dd($show);
                break;
            case 7:
                //

                /*                 $type = DB::table('types')
                                    ->select('id')
                                    ->where('type', '=', "comédien")
                                    ->get();
                                //dd($type);
                                $artistType = DB::table('artist_type')
                                    ->select('show_id')
                                    //->where('id', 1)->count()
                                    ->where(function (Builder $query) use ($type) {
                                        $query->where('type_id', '=', $type[0]->id);

                                    })

                                $artistTypeShow = DB::table('artist_type_show')
                                    ->select('show_id')
                                    ->where('artist_type_id', '=', $artistType?->id)
                                    ->get();
                                //dd($artistTypeShow);
                                $show = DB::table('shows')
                                    ->where('id', '=', $artistTypeShow[0]?->show_id)
                                    ->get();
                                dd($show);
                                break;*/
            default:
        }

        return view('request.index', [
            'shows' => $shows,
            'uniqueResult' => $uniqueResult,
        ]);
    }
}
