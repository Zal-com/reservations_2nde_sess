<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\ArtistType;
use App\Models\Show;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistTypeShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('artist_type_show')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $artistTypeShows = [
            [
                'artist_firstname' => 'Nasri',
                'artist_lastname' => 'Mohamed',
                'type' => 'comédien',
                'show_slug' => 'un-berbere-en-europe',
            ],
            [
                'artist_firstname' => 'Guillaume',
                'artist_lastname' => 'Vanderstiechel',
                'type' => 'comédien',
                'show_slug' => 'un-berbere-en-europe',
            ],
            [
                'artist_firstname' => 'Franck',
                'artist_lastname' => 'Deneyer',
                'type' => 'comédien',
                'show_slug' => 'un-berbere-en-europe',
            ],
            [
                'artist_firstname' => 'Robin',
                'artist_lastname' => 'Lequere',
                'type' => 'scénographe',
                'show_slug' => 'un-berbere-en-europe',
            ],
            [
                'artist_firstname' => 'Cédric',
                'artist_lastname' => 'Dujardin',
                'type' => 'auteur',
                'show_slug' => 'un-berbere-en-europe',
            ],
            [
                'artist_firstname' => 'Nasri',
                'artist_lastname' => 'Mohamed',
                'type' => 'comédien',
                'show_slug' => 'nasri-et-le-mur-des-lamentations',
            ],
            [
                'artist_firstname' => 'Guillaume',
                'artist_lastname' => 'Vanderstiechel',
                'type' => 'comédien',
                'show_slug' => 'nasri-et-le-mur-des-lamentations',
            ],
            [
                'artist_firstname' => 'Franck',
                'artist_lastname' => 'Deneyer',
                'type' => 'comédien',
                'show_slug' => 'nasri-et-le-mur-des-lamentations',
            ],
            [
                'artist_firstname' => 'Robin',
                'artist_lastname' => 'Lequere',
                'type' => 'scénographe',
                'show_slug' => 'nasri-et-le-mur-des-lamentations',
            ],
            [
                'artist_firstname' => 'Cédric',
                'artist_lastname' => 'Dujardin',
                'type' => 'auteur',
                'show_slug' => 'nasri-et-le-mur-des-lamentations',
            ],
            [
                'artist_firstname' => 'Nasri',
                'artist_lastname' => 'Mohamed',
                'type' => 'comédien',
                'show_slug' => 'le-merland-frit-de-nasri',
            ],
            [
                'artist_firstname' => 'Guillaume',
                'artist_lastname' => 'Vanderstiechel',
                'type' => 'comédien',
                'show_slug' => 'le-merland-frit-de-nasri',
            ],
            [
                'artist_firstname' => 'Franck',
                'artist_lastname' => 'Deneyer',
                'type' => 'comédien',
                'show_slug' => 'le-merland-frit-de-nasri',
            ],
            [
                'artist_firstname' => 'Robin',
                'artist_lastname' => 'Lequere',
                'type' => 'scénographe',
                'show_slug' => 'le-merland-frit-de-nasri',
            ],
            [
                'artist_firstname' => 'Cédric',
                'artist_lastname' => 'Dujardin',
                'type' => 'auteur',
                'show_slug' => 'le-merland-frit-de-nasri',
            ],
            [
                'artist_firstname' => 'Nasri',
                'artist_lastname' => 'Mohamed',
                'type' => 'comédien',
                'show_slug' => 'les-malheurs-du-petit-nasri',
            ],
            [
                'artist_firstname' => 'Guillaume',
                'artist_lastname' => 'Vanderstiechel',
                'type' => 'comédien',
                'show_slug' => 'les-malheurs-du-petit-nasri',
            ],
            [
                'artist_firstname' => 'Franck',
                'artist_lastname' => 'Deneyer',
                'type' => 'comédien',
                'show_slug' => 'les-malheurs-du-petit-nasri',
            ],
            [
                'artist_firstname' => 'Robin',
                'artist_lastname' => 'Lequere',
                'type' => 'scénographe',
                'show_slug' => 'les-malheurs-du-petit-nasri',
            ],
            [
                'artist_firstname' => 'Cédric',
                'artist_lastname' => 'Dujardin',
                'type' => 'auteur',
                'show_slug' => 'les-malheurs-du-petit-nasri',
            ],
            [
                'artist_firstname' => 'Nasri',
                'artist_lastname' => 'Mohamed',
                'type' => 'comédien',
                'show_slug' => 'le-coeur-gris-de-nasri',
            ],
            [
                'artist_firstname' => 'Nasri',
                'artist_lastname' => 'Mohamed',
                'type' => 'scénographe',
                'show_slug' => 'le-coeur-gris-de-nasri',
            ],
            [
                'artist_firstname' => 'Cédric',
                'artist_lastname' => 'Dujardin',
                'type' => 'auteur',
                'show_slug' => 'le-coeur-gris-de-nasri',
            ],
            /**[
                'artist_firstname' => 'Marius',
                'artist_lastname' => 'Von Mayenburg',
                'type' => 'auteur',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Olivier',
                'artist_lastname' => 'Boudon',
                'type' => 'scénographe',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Anne Marie',
                'artist_lastname' => 'Loop',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Pietro',
                'artist_lastname' => 'Varasso',
                'type' =>' comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Laurent',
                'artist_lastname' => 'Caron',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Élena',
                'artist_lastname' => 'Perez',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Guillaume',
                'artist_lastname' => 'Alexandre',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Claude',
                'artist_lastname' => 'Semal',
                'type' => 'auteur',
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
            ],
            [
                'artist_firstname' => 'Laurence',
                'artist_lastname' => 'Warin',
                'type' => 'scénographe',
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
            ],
            [
                'artist_firstname' => 'Claude',
                'artist_lastname' => 'Semal',
                'type' => 'comédien',
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'auteur',
                'show_slug' => 'manneke',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'scénographe',
                'show_slug' => 'manneke',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'comédien',
                'show_slug' => 'manneke',
            ],**/
        ];

        //Prepare the data
        foreach ($artistTypeShows as &$data) {
            dump($data);
            // artist
            $artist = Artist::where([
                ['firstname', '=', $data['artist_firstname']],
                ['lastname', '=', $data['artist_lastname']],
            ])->first();

            // type
            $type = Type::firstWhere('type', $data['type']);

            //Search the artistType for the artist and type found
            $artistType = ArtistType::where([
                ['artist_id', '=', $artist->id],
                ['type_id', '=', $type->id],
            ])->first();
            // show
            $show = Show::firstWhere('slug', $data['show_slug']);

            unset($data['artist_firstname'], $data['artist_lastname'], $data['type'], $data['show_slug']);

            $data['artist_type_id'] = $artistType->id;
            $data['show_id'] = $show->id;
        }
        unset($data);

        //Insert data in the table
        DB::table('artist_type_show')->insert($artistTypeShows);
    }
}
