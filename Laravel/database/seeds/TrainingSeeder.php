<?php

use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('trainings')->insert([
            'name' => 'Soldadura - Formação de Formadores',
            'description' => 'Soldadura - Formação de Formadores',
            'category' => 'Soldadura',
        ]);

        // Seed 2
        DB::table('trainings')->insert([
            'name' => 'Mecânica de Fluidos',
            'description' => 'Mecânica de Fluidos',
            'category' => 'Mecânica',
        ]);

        // Seed 3
        DB::table('trainings')->insert([
            'name' => 'Cybersegurança',
            'description' => 'Cybersegurança',
            'category' => 'Tecnologias de Informação',
        ]);

        // Seed 4
        DB::table('trainings')->insert([
            'name' => 'Higiene e Segurança',
            'description' => 'Higiene e Segurança',
            'category' => 'Higiene e Segurança no trabalho',
        ]);

        // Seed 5
        DB::table('trainings')->insert([
            'name' => 'Pneumática',
            'description' => 'Sistemas Pneumáticos',
            'category' => 'Sistemas Pneumáticos',
        ]);
    }
}
