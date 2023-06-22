<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalitySeeder extends Seeder
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
        DB::table('localities')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $localities = [
            ['postcode' => '1000', 'locality_fr' => 'Bruxelles', 'locality_nl' => 'Brussel'],
            ['postcode' => '1020', 'locality_fr' => 'Laeken', 'locality_nl' => 'Laeken'],
            ['postcode' => '1050', 'locality_fr' => 'Ixelles', 'locality_nl' => 'Elsene'],
            ['postcode' => '1080', 'locality_fr' => 'Etterbeek', 'locality_nl' => 'Etterbeek'],
            ['postcode' => '1170', 'locality_fr' => 'Watermael-Boitsfort', 'locality_nl' => 'Watermael-Bosvoorde'],
            ['postcode' => '1210', 'locality_fr' => 'Saint-Josse-ten-Node', 'locality_nl' => 'Sint-Joost-ten-Node'],
            ['postcode' => '1932', 'locality_fr' => 'Woluwe-Saint-Etienne', 'locality_nl' => 'Sint-Steven-Woluwe'],
        ];

        //Insert data in the table
        DB::table('localities')->insert($localities);
    }
}
