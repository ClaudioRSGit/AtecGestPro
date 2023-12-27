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
    }
}
