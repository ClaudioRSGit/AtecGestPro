<?php

use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('materials')->insert([
            'name' => 'Martelo',
            'description' => 'Para martelar',
            'isInternal' => 1,
            'quantity' => 5,
            'acquisition_date' => '2020-12-09 21:04:24',
            'supplier' => 'Ferragens do Zé',
            'isClothing' => 0,
            'gender' => null,

        ]);

        // Seed 2
        DB::table('materials')->insert([
            'name' => 'Chave de Fendas',
            'description' => 'Para apertar/desapertar parafusos',
            'isInternal' => 0,
            'quantity' => 5,
            'acquisition_date' => '2020-12-09 21:04:24',
            'supplier' => 'Ferragens do Zé',
            'isClothing' => 0,
            'gender' => null,

        ]);

        // Seed 3
        DB::table('materials')->insert([
            'name' => 'Chave Inglesa',
            'description' => 'Para apertar/desapertar fêmeas',
            'isInternal' => 0,
            'quantity' => 5,
            'acquisition_date' => '2020-12-09 21:04:24',
            'supplier' => 'Ferragens do Zé',
            'isClothing' => 0,
            'gender' => null,

        ]);

        // Seed 4
        DB::table('materials')->insert([
            'name' => 'Serrote',
            'description' => 'Para cortar',
            'isInternal' => 0,
            'quantity' => 5,
            'acquisition_date' => '2020-12-09 21:04:24',
            'supplier' => 'Ferragens do Zé',
            'isClothing' => 0,
            'gender' => null,

        ]);

        // Seed 5
        DB::table('materials')->insert([
            'name' => 'Alicate',
            'description' => 'Multiusos',
            'isInternal' => 0,
            'quantity' => 5,
            'acquisition_date' => '2020-12-09 21:04:24',
            'supplier' => 'Ferragens do Zé',
            'isClothing' => 0,
            'gender' => null,

        ]);

        // Seed 6
        DB::table('materials')->insert([
            'name' => 'Lampada',
            'description' => 'T18 36W',
            'isInternal' => 1,
            'quantity' => 3,
            'acquisition_date' => null,
            'supplier' => 'lampadas.com',
            'isClothing' => 0,
            'gender' => null,

        ]);

        // Seed 7
        DB::table('materials')->insert([
            'name' => 'Compressor',
            'description' => '50L',
            'isInternal' => 0,
            'quantity' => 3,
            'acquisition_date' => null,
            'supplier' => null,
            'isClothing' => 0,
            'gender' => null,

        ]);

        // Seed 8
        DB::table('materials')->insert([
            'name' => 'Televisão',
            'description' => '32 Polegadas',
            'isInternal' => 0,
            'quantity' => 8,
            'acquisition_date' => null,
            'supplier' => 'Worten',
            'isClothing' => 0,
            'gender' => null,

        ]);

        // Seed 9
        DB::table('materials')->insert([
            'name' => 'Tshirt',
            'description' => 'T-shirt Homem',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => 1,

        ]);

        // Seed 10
        DB::table('materials')->insert([
            'name' => 'Tshirt',
            'description' => 'T-shirt Senhora',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => 0,

        ]);

        // Seed 11
        DB::table('materials')->insert([
            'name' => 'Sweat azul',
            'description' => 'Sweat azul Homem',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => 1,

        ]);

        // Seed 12
        DB::table('materials')->insert([
            'name' => 'Polar',
            'description' => 'Polar Homem',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => 1,

        ]);


        // Seed 13
        DB::table('materials')->insert([
            'name' => 'Camisa soldador',
            'description' => 'Camisa soldador Homem',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => 1,

        ]);

        // Seed 14
        DB::table('materials')->insert([
            'name' => 'Calças castanhas mécatrónica',
            'description' => 'Calças castanhas mécatrónica Homem',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => 1,

        ]);

        // Seed 15
        DB::table('materials')->insert([
            'name' => 'Sapato de segurança',
            'description' => 'Sapato de segurança',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => null,

        ]);

        // Seed 16
        DB::table('materials')->insert([
            'name' => 'Avental soldadura',
            'description' => 'Avental soldadura',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => null,

        ]);

        // Seed 17
        DB::table('materials')->insert([
            'name' => 'Capuz soldadura',
            'description' => 'Capuz soldadura',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => null,

        ]);

        // Seed 18
        DB::table('materials')->insert([
            'name' => 'Luvas soldadura',
            'description' => 'Luvas soldadura',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => null,

        ]);

        // Seed 19
        DB::table('materials')->insert([
            'name' => 'Calças cinzas de soldador',
            'description' => 'Calças cinzas de soldador Homem',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => 1,

        ]);

        // Seed 20
        DB::table('materials')->insert([
            'name' => 'Botas de soldador',
            'description' => 'Botas de soldador',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => null,

        ]);

        // Seed 21
        DB::table('materials')->insert([
            'name' => 'Casaco de croute',
            'description' => 'Casaco de croute Homem',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => 1,

        ]);

        // Seed 22
        DB::table('materials')->insert([
            'name' => 'Bata beje',
            'description' => 'Bata beje Homem',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => 'Fardas e Companhia',
            'isClothing' => 1,
            'gender' => 1,

        ]);

        // Seed 23
        DB::table('materials')->insert([
            'name' => 'Bata beje',
            'description' => 'Bata beje Senhora',
            'isInternal' => 1,
            'quantity' => 0,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => 'Fardas e Companhia',
            'isClothing' => 1,
            'gender' => 0,
        ]);
    }
}
