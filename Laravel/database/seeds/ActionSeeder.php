<?php

use Illuminate\Database\Seeder;

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
        ]);

        // Seed 2
        DB::table('actions')->insert([
            'description' => 'UPDATE',
        ]);

        // Seed 3
        DB::table('actions')->insert([
            'description' => 'DELETE',
        ]);
    }
}
