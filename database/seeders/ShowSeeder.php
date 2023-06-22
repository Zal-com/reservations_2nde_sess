<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('shows')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        //Define data
        $shows = [
            [
                'slug' => null,
                'title' => 'Un berbère en Europe',
                'description' => "Un homme est bloqué europe.\n "
                                .'Questionné par l\'armée, il doit alors justifier son identité, '
                                .'et surtout prouver qu\'il est berbère – qu\'est-ce qu\'être berbère ?',
                'poster_url' => 'ayiti.jpg',
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => 1,
                'price' => 10.99,
            ],
            [
                'slug' => null,
                'title' => 'Nasri et le mur des lamentations',
                'description' => 'Dans ce « thriller d’anticipation », des adultes semblent alimenter '
                                 .'et véhiculer une crainte féroce envers les enfants âgés entre 10 et 12 ans.',
                'poster_url' => 'cible.jpg',
                'location_slug' => 'dexia-art-center',
                'bookable' => 1,
                'price' => 8.99,
            ],
            [
                'slug' => null,
                'title' => 'Le merland frit de Nasri',
                'description' => "Non peut-être ?!\nEntre Magritte (pour le surréalisme comique) "
                                .'et Maigret (pour le réalisme mélancolique), ce dixième opus semalien propose '
                                .'quatorze nouvelles chansons mêlées à de petits textes humoristiques et '
                                .'à quelques fortes images poétiques.',
                'poster_url' => 'claudebelgesaison220.jpg',
                'location_slug' => null,
                'bookable' => 0,
                'price' => 9.99,
            ],
            [
                'slug' => null,
                'title' => 'Les malheurs du petit Nasri... !',
                'description' => 'A tour de rôle, Nasri se joue de ses collocs, '
                                    .'ne fait pas ci, ne fait pas ça. Si Nasri ne fait pas, tu ne peux pas',
                'poster_url' => 'wayburn.jpg',
                'location_slug' => 'la-samaritaine',
                'bookable' => 1,
                'price' => 5.99,
            ],
            [
                'slug' => null,
                'title' => 'Le coeur gris de Nasri',
                'description' => 'oh qu il est gris et tout petit',
                'poster_url' => 'wayburn.jpg',
                'location_slug' => 'dexia-art-center',
                'bookable' => 1,
                'price' => 5.99,
            ],
        ];

        //Prepare the data
        foreach ($shows as &$data) {
            //Search the location for a given location's slug
            $location = Location::firstWhere('slug', $data['location_slug']);
            unset($data['location_slug']);

            $data['slug'] = Str::slug($data['title']);
            $data['location_id'] = $location->id ?? null;
        }
        unset($data);

        //Insert data in the table
        DB::table('shows')->insert($shows);
    }
}
