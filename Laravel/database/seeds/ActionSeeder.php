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
            'description' => 'Criação',
        ]);

        // Seed 2
        DB::table('actions')->insert([
            'description' => 'Atualização',
        ]);

        // Seed 3
        DB::table('actions')->insert([
            'description' => 'Remoção',
        ]);
        // Seed 4
        DB::table('actions')->insert([
            'description' => 'Restauro',
        ]);

    }
}
