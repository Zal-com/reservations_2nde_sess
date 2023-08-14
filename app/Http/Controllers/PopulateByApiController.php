<?php

namespace App\Http\Controllers;

use App\Models\Locality;
use App\Models\Location;
use App\Models\Representation;
use App\Models\Show;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PopulateByApiController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer 3889e201-45ca-3cc8-93ed-37cae78f381a'
        ])->get('https://api.brussels:443/api/agenda/0.0.1/events/category?mainCategory=49&subCategory=50&page=1');

        $data = $response->json();

        foreach ($data['response']['results']['event'] as $event) {
            //var_dump($event);
            //continue;

            $locality = new Locality();
            $location = new Location();
            $show = new Show();

            /**
             * $show;
             * $locality;
             * $location;
             * $respresentations;
             */

            //Crée la Localité si non existante dans la base de données
            $existingLocalities = Locality::where('postcode', $event['place']['translations']['fr']['address_zip'])->get();

            if (count($existingLocalities) == 0) {
                $locality->postcode = $event['place']['translations']['fr']['address_zip'];
                $locality->locality_fr = $event['place']['translations']['fr']['address_city'];
                $locality->locality_nl = $event['place']['translations']['nl']['address_city'];

                $locality->save();
            } else {
                $locality = $existingLocalities->first();
            }

            //Crée la Location (salle de spectacle) si elle n'existe pas dans la db

            $existingLocations = Location::where('designation', $event['place']['translations']['fr']['name'])->get();

            if (count($existingLocations) == 0) {
                $location->designation = $event['place']['translations']['fr']['name'];
                $location->address = $event['place']['translations']['fr']['address_line1'];
                $location->locality_id = $locality->id;
                $location->website = $event['place']['translations']['fr']['website'];
                $location->phone = $event['place']['translations']['fr']['phone_booking'];
                $location->slug = $this->slugify($event['place']['translations']['fr']['name']);

                $location->save();
            } else {
                $locality = $existingLocalities->first();
            }


            //Crée le spectacle si il n'existe pas encore dans la database

            $existingShows = Show::where('title', $event['translations']['fr']['name'])->get();

            if (count($existingShows) == 0) {

                //traiter les medias comme des array
                if (array_key_exists('media', $event)) {

                    if (array_key_exists(0, $event['media'])) {

                        foreach ($event['media'] as $media){
                            if($media['type'] == 'photo'){
                                $path = $media['link'];
                                $fileName = explode('/', $path);
                                $fileName = $fileName[count($fileName) - 1];

                                Storage::disk('public')->put($fileName, file_get_contents($path));

                                $show->poster_url = $fileName;
                                break;
                            }
                        }
                    }
                    else {
                        $path = $event['media']['link'];
                        $fileName = explode('/', $path);
                        $fileName = $fileName[count($fileName) - 1];

                        Storage::disk('public')->put($fileName, file_get_contents($path));

                        $show->poster_url = $fileName;
                    }

                }


                $show->title = $event['translations']['fr']['name'];
                $show->description = $event['translations']['fr']['longdescr'];
                $show->location_id = $location->id;
                $show->bookable = 1;


                //Détermine les prix
                if (array_key_exists('prices', $event)) {
                    if (count($event['prices']) > 2) {
                        foreach ($event['prices'] as $price) {
                            if ($price['translations']['fr']['name'] == 'Normal') {
                                $show->price = $price['value'];
                                break;
                            }
                        }
                    }
                    else {
                        foreach ($event['prices'] as $price) {
                            try {
                                if ($price['fr']['name'] == 'Normal') {
                                    $show->price = $event['prices']['value'];
                                    break;
                                } else {
                                    $show->price = 0;
                                }
                            } catch (\Exception $e){
                                //API de merde, y'a rien qui va nikoumouk je mets une valeur random
                                $show->price = random_int(15, 30);
                            }

                        }
                    }
                }


                $show->slug = substr($this->slugify($event['translations']['fr']['name']), 0, 60);


                $show->save();

            } else {
                $show = $existingShows->first();
            }

            //Crée des representations si non existantes dans la DB

            foreach ($event['dates'] as $date) {
                if (!empty($date)) {
                    $representation = new Representation();
                    if (is_string($date)) {
                        $representation->when = '9999-12-12 00:00:00';
                    } else {
                        $representation->when = is_null($date['day']) ? '9999-12-12' : $date['day'] . ' ' . (is_null($date['start']) ? '00:00:00' : $date['start']);
                    }
                    $representation->show_id = $show->id;
                    $representation->location_id = $location->id;

                    $representation->save();
                }
            }
        }

        $nullRepresentations = Representation::where('location_id', null)->get();
        foreach ($nullRepresentations as $nullRepresentation) {
            $nullRepresentation->delete();
        }

    }


    private function slugify($text)
    {
        // Strip html tags
        $text = strip_tags($text);
        // Replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // Transliterate
        setlocale(LC_ALL, 'en_US.utf8');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // Remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // Trim
        $text = trim($text, '-');
        // Remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // Lowercase
        $text = strtolower($text);
        // Check if it is empty
        if (empty($text)) {
            return 'n-a';
        }
        // Return result
        return $text;
    }

}
