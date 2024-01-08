<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('role__users')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);

        // Seed 2
        DB::table('role__users')->insert([
            'role_id' => 2,
            'user_id' => 2,
        ]);

        // Seed 3
        DB::table('role__users')->insert([
            'role_id' => 4,
            'user_id' => 3,
        ]);

        // Seed 4
        DB::table('role__users')->insert([
            'role_id' => 3,
            'user_id' => 4,
        ]);

        // Seed 5
        DB::table('role__users')->insert([
            'role_id' => 3,
            'user_id' => 5,
        ]);

        // Seed 6
        DB::table('role__users')->insert([
            'role_id' => 4,
            'user_id' => 6,
        ]);
        // Seed 7
        DB::table('role__users')->insert([
            'role_id' => 4,
            'user_id' => 7,
        ]);
        // Seed 8
        DB::table('role__users')->insert([
            'role_id' => 4,
            'user_id' => 8,
        ]);
        // Seed 9
        DB::table('role__users')->insert([
            'role_id' => 4,
            'user_id' => 9,
        ]);
        // Seed 10
        DB::table('role__users')->insert([
            'role_id' => 4,
            'user_id' => 10,
        ]);

    }
}
