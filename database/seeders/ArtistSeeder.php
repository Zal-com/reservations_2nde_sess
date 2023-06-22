<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('artists')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $artists = [
            [
                'firstname' => 'Nasri',
                'lastname' => 'Mohamed',
            ],
            [
                'firstname' => 'Guillaume',
                'lastname' => 'Vanderstiechel',
            ],
            [
                'firstname' => 'Franck',
                'lastname' => 'Deneyer',
            ],
            [
                'firstname' => 'Robin',
                'lastname' => 'Lequere',
            ],
            [
                'firstname' => 'Cédric',
                'lastname' => 'Dujardin',
            ],
            /**[
                'firstname' => 'Pietro',
                'lastname' => 'Varasso'
            ],
            [
                'firstname' => 'Laurent',
                'lastname' => 'Caron'
            ],
            [
                'firstname' => 'Élena',
                'lastname' => 'Perez'
            ],
            [
                'firstname' => 'Guillaume',
                'lastname' => 'Alexandre'
            ],
            [
                'firstname' => 'Claude',
                'lastname' => 'Semal'
            ],
            [
                'firstname' => 'Laurence',
                'lastname' => 'Warin'
            ],**/
        ];

        //Insert data in the table
        DB::table('artists')->insert($artists);
    }
}
