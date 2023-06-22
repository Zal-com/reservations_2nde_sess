<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();

        Schema::enableForeignKeyConstraints();

        $faker = Faker::create();

        DB::table('roles')->insert($record);
    }
}
