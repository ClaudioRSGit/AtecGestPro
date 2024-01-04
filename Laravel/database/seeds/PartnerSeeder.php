<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partners')->insert([
            'name' => 'Amkor Technology Portugal (ATEP)',
            'description' => 'Description',
            'address' => 'Avenida 1º De Maio, 801 Mindelo, 4485-629 Porto',
        ]);

        DB::table('partners')->insert([
            'name' => 'ENGIE - Douro',
            'description' => 'Description',
            'address' => 'Barragem do Picote-Sendim, 5225-072 Miranda Do Douro',
        ]);

        DB::table('partners')->insert([
            'name' => 'Ordem dos Engenheiros - Região Centro',
            'description' => 'Description',
            'address' => 'Rua Antero de Quental, 107, 3000-032 Coimbra',
        ]);

        DB::table('partners')->insert([
            'name' => 'Netos Shoes',
            'description' => 'Description',
            'address' => 'R. António Luís da Costa 100, 3700-310 São João da Madeira',
        ]);

        DB::table('partners')->insert([
            'name' => 'GRANCRUZ',
            'description' => 'Description',
            'address' => 'Rua José Mariani 390, 4400-195 VNGaia',
        ]);

        DB::table('partners')->insert([
            'name' => 'Without Contact',
            'description' => 'No Contact',
            'address' => 'R. António Luís da Costa 100, 3700-310 São João da Madeira',
        ]);
        }
}
