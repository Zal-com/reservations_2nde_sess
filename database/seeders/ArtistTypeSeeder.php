<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('artist_type')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $artistTypes = [
            [
                'artist_firstname' => 'Nasri',
                'artist_lastname' => 'Mohamed',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Guillaume',
                'artist_lastname' => 'Vanderstiechel',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Franck',
                'artist_lastname' => 'Deneyer',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Robin',
                'artist_lastname' => 'Lequere',
                'type' => 'scénographe',
            ],
            [
                'artist_firstname' => 'Cédric',
                'artist_lastname' => 'Dujardin',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Nasri',
                'artist_lastname' => 'Mohamed',
                'type' => 'scénographe',
            ],
            [
                'artist_firstname' => 'Nasri',
                'artist_lastname' => 'Mohamed',
                'type' => 'auteur',
            ],
            /**[
                'artist_firstname' => 'Marius',
                'artist_lastname' => 'Von Mayenburg',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Olivier',
                'artist_lastname' => 'Boudon',
                'type' => 'scénographe',
            ],
            [
                'artist_firstname' => 'Anne Marie',
                'artist_lastname' => 'Loop',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Pietro',
                'artist_lastname' => 'Varasso',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Laurent',
                'artist_lastname' => 'Caron',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Élena',
                'artist_lastname' => 'Perez',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Guillaume',
                'artist_lastname' => 'Alexandre',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Claude',
                'artist_lastname' => 'Semal',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Claude',
                'artist_lastname' => 'Semal',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Laurence',
                'artist_lastname' => 'Warin',
                'type' => 'scénographe',
            ],**/
        ];

        //Prepare the data
        foreach ($artistTypes as &$data) {
            //Search the artist for a given artist's firstname and lastname
            $artist = Artist::where([
                ['firstname', '=', $data['artist_firstname']],
                ['lastname', '=', $data['artist_lastname']],
            ])->first();

            //Search the type for a given type
            $type = Type::firstWhere('type', $data['type']);

            unset($data['artist_firstname'], $data['artist_lastname'], $data['type']);

            $data['artist_id'] = $artist->id;
            $data['type_id'] = $type->id;
        }
        unset($data);

        //Insert data in the table
        DB::table('artist_type')->insert($artistTypes);
    }
}
