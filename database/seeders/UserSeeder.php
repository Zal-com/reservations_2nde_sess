<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $users = [
            [
                'name' => 'Cédric',
                'email' => 'cedric@cedricdujardin.com',
                'password' => 'test123',
                'created_at' => '',
            ],
            [
                'name' => 'Bob',
                'email' => 'bob@sull.com',
                'password' => '12345678',
                'created_at' => '',
            ],
            [
                'name' => 'Anna',
                'email' => 'anna.lyse@sull.com',
                'password' => '12345678',
                'created_at' => '',
            ],
        ];

        foreach ($users as &$user) {
            $user['created_at'] = Carbon::now()->toDateTimeString();    //date('Y-m-d G:i:s');
            $user['password'] = Hash::make($user['password']);
        }

        unset($user);
        //Insert data in the table
        DB::table('users')->insert($users);
    }
}
