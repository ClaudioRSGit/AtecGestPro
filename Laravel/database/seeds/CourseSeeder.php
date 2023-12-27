<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('courses')->insert([
            'description' => 'Técnico/a especialista em gestão de redes e sistemas informáticos',
            'code' => 'GRSI',
        ]);

        // Seed 2
        DB::table('courses')->insert([
            'description' => 'Técnico/a especialista em mecatrónica automóvel, planeamento e controlo de processos',
            'code' => 'MAPCP',
        ]);

        // Seed 3
        DB::table('courses')->insert([
            'description' => 'Técnico/a especialista em tecnologia mecatrónica',
            'code' => 'TM',
        ]);

        // Seed 4
        DB::table('courses')->insert([
            'description' => 'Técnico/a de Soldadura',
            'code' => 'TS',
        ]);

        // Seed 5
        DB::table('courses')->insert([
            'description' => 'Técnico/a especialista em tecnologias e programação de sistemas de informação',
            'code' => 'TPSI',
        ]);
    }
}
