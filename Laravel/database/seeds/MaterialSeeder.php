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
        DB::table('materials')->insert([
            'name' => 'Martelo',
            'description' => 'Para martelar',
            'isInternal' => 0,
            'quantity' => 5,
            'acquisition_date' => '2020-12-09 21:04:24',
            'supplier' => 'Ferragens do Zé',
            'isClothing' => 0,
            'gender' => null,

        ]);
        DB::table('materials')->insert([
            'name' => 'Martelo',
            'description' => 'Para martelar',
            'isInternal' => 0,
            'quantity' => 5,
            'acquisition_date' => '2020-12-09 21:04:24',
            'supplier' => 'Ferragens do Zé',
            'isClothing' => 0,
            'gender' => null,

        ]);
        DB::table('materials')->insert([
            'name' => 'Martelo',
            'description' => 'Para martelar',
            'isInternal' => 0,
            'quantity' => 5,
            'acquisition_date' => '2020-12-09 21:04:24',
            'supplier' => 'Ferragens do Zé',
            'isClothing' => 0,
            'gender' => null,

        ]);
        DB::table('materials')->insert([
            'name' => 'Martelo',
            'description' => 'Para martelar',
            'isInternal' => 0,
            'quantity' => 5,
            'acquisition_date' => '2020-12-09 21:04:24',
            'supplier' => 'Ferragens do Zé',
            'isClothing' => 0,
            'gender' => null,

        ]);

        // Seed 3
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
        // Seed 4
        DB::table('materials')->insert([
            'name' => 'Compressor',
            'description' => '50L',
            'isInternal' => 0,
            'quantity' => 8,
            'acquisition_date' => null,
            'supplier' => null,
            'isClothing' => 0,
            'gender' => null,

        ]);
        // Seed 5
        DB::table('materials')->insert([
            'name' => 'Televisão',
            'description' => '32 Polegadas',
            'isInternal' => 0,
            'quantity' => 8,
            'acquisition_date' => null,
            'supplier' => null,
            'isClothing' => 0,
            'gender' => null,

        ]);
        // Seed 6













        DB::table('materials')->insert([
            'name' => 'Tshirt',
            'description' => 'Tshirt homem',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => 0,

        ]);



        DB::table('materials')->insert([
            'name' => 'Tshirt',
            'description' => 'Tshirt mulher',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => null,
            'isClothing' => 1,
            'gender' => 1,

        ]);



        DB::table('materials')->insert([
            'name' => 'Sweat azul',
            'description' => 'Sweat azul homem',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => 0,

        ]);



        DB::table('materials')->insert([
            'name' => 'Polar',
            'description' => 'Polar homem',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => 0,

        ]);



        DB::table('materials')->insert([
            'name' => 'Camisa soldador',
            'description' => 'Camisa soldador homem',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => 0,

        ]);



        DB::table('materials')->insert([
            'name' => 'Calças castanhas mécatrónica',
            'description' => 'Calças castanhas mécatrónica homem',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => 0,

        ]);



        DB::table('materials')->insert([
            'name' => 'Sapato de segurança',
            'description' => 'Sapato de segurança',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => null,

        ]);


        DB::table('materials')->insert([
            'name' => 'Avental soldadura',
            'description' => 'Avental soldadura',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => null,

        ]);

        DB::table('materials')->insert([
            'name' => 'Capuz soldadura',
            'description' => 'Capuz soldadura',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => null,

        ]);



        DB::table('materials')->insert([
            'name' => 'Luvas soldadura',
            'description' => 'Luvas soldadura',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => null,

        ]);


        DB::table('materials')->insert([
            'name' => 'Calças cinzas de soldador',
            'description' => 'Calças cinzas de soldador homem',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => 0,

        ]);



        DB::table('materials')->insert([
            'name' => 'Botas de soldador',
            'description' => 'Botas de soldador',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => null,

        ]);

        DB::table('materials')->insert([
            'name' => 'Casaco de croute',
            'description' => 'Casaco de croute homem',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => 0,

        ]);

        DB::table('materials')->insert([
            'name' => 'Bata beje',
            'description' => 'Bata beje homem',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => 'Fardas e Companhia',
            'isClothing' => 1,
            'gender' => 0,

        ]);


        DB::table('materials')->insert([
            'name' => 'Bata beje',
            'description' => 'Bata beje mulher',
            'isInternal' => 1,
            'quantity' => 10,
            'acquisition_date' => '2020-01-09 21:04:24',
            'supplier' => 'Fardas e Companhia',
            'isClothing' => 1,
            'gender' => 1,

        ]);

    }
}
