<?php

use Illuminate\Database\Seeder;

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
            'description' => '',
            'address' => 'Avenida 1º De Maio, 801 Mindelo, 4485-629 Porto',
        ]);

        DB::table('partners')->insert([
            'name' => 'ENGIE - Douro',
            'description' => '',
            'address' => 'Barragem do Picote-Sendim, 5225-072 Miranda Do Douro',
        ]);

        DB::table('partners')->insert([
            'name' => 'Ordem dos Engenheiros - Região Centro',
            'description' => '',
            'address' => 'Rua Antero de Quental, 107, 3000-032 Coimbra',
        ]);

        DB::table('partners')->insert([
            'name' => 'Netos Shoes',
            'description' => '',
            'address' => 'R. António Luís da Costa 100, 3700-310 São João da Madeira',
        ]);

        DB::table('partners')->insert([
            'name' => 'GRANCRUZ',
            'description' => '',
            'address' => 'Rua José Mariani 390, 4400-195 VNGaia',
        ]);    }
}
