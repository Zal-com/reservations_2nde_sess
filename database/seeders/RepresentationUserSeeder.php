<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Representation;
use App\Models\Show;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepresentationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('representation_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $representationUsers = [
            [
                'location_slug' => 'espace-delvaux-la-venerie',
                'show_slug' => 'un-berbere-en-europe',
                'user_id' => 1,
                'seats' => 3,
            ],
            [
                'location_slug' => 'espace-delvaux-la-venerie',
                'show_slug' => 'nasri-et-le-mur-des-lamentations',
                'user_id' => '2',
                'seats' => 2,
            ],
        ];

        //Prepare the data
        foreach ($representationUsers as &$data) {
            // location
            $location = Location::firstWhere('slug', $data['location_slug']);
            // show
            $show = Show::firstWhere('slug', $data['show_slug']);
            //Search the representation for the location and show found
            $representation = Representation::where([
                ['location_id', '=', $location->id],
                ['show_id', '=', $show->id],
            ])->first();

            // user
            $user = User::firstWhere('id', $data['user_id']);

            unset($data['location_slug'], $data['show_slug'], $data['user_login']);

            $data['representation_id'] = $representation->id;
            $data['user_id'] = $user->id;
        }
        unset($data);

        //Insert data in the table
        DB::table('representation_user')->insert($representationUsers);
    }
}
