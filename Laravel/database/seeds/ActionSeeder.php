<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('actions')->insert([
            'description' => 'CREATE',
            'user_id' => 1,
        ]);

        // Seed 2
        DB::table('actions')->insert([
            'description' => 'UPDATE',
            'user_id' => 2,
        ]);

        // Seed 3
        DB::table('actions')->insert([
            'description' => 'DELETE',
            'user_id' => 3,
        ]);


    }
}
