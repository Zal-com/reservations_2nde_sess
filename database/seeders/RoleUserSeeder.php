<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\RoleUser;

class RoleUserSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        RoleUser::truncate();

        Schema::enableForeignKeyConstraints();

        $faker = Faker::create();


        $record = [
            'role_id' => 1,
            'user_id' => 1

        ];

        DB::table('role_users')->insert($record);
    }
}
