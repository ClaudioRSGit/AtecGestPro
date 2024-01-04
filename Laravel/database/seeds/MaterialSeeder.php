<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'aquisition_date' => '2020-12-09 21:04:24',
            'supplier' => 'Ferragens do Zé',
            'isClothing' => 0,
            'gender' => null,
            'size' => null,
            'role' => null,
        ]);
        // Seed 2
        DB::table('materials')->insert([
            'name' => 'Bata',
            'description' => 'Bata laboratorios',
            'isInternal' => 1,
            'quantity' => 10,
            'aquisition_date' => '2020-01-09 21:04:24',
            'supplier' => 'Fardas e Companhia',
            'isClothing' => 1,
            'gender' => 1,
            'size' => 'M',
            'role' => 3,
        ]);
        // Seed 3
        DB::table('materials')->insert([
            'name' => 'Lampada',
            'description' => 'T18 36W',
            'isInternal' => 1,
            'quantity' => 3,
            'aquisition_date' => null,
            'supplier' => 'lampadas.com',
            'isClothing' => 0,
            'gender' => null,
            'size' => null,
            'role' => null,
        ]);
        // Seed 4
        DB::table('materials')->insert([
            'name' => 'Compressor',
            'description' => '50L',
            'isInternal' => 0,
            'quantity' => 8,
            'aquisition_date' => null,
            'supplier' => null,
            'isClothing' => 0,
            'gender' => null,
            'size' => null,
            'role' => null,
        ]);
        // Seed 5
        DB::table('materials')->insert([
            'name' => 'Televisão',
            'description' => '32 Polegadas',
            'isInternal' => 0,
            'quantity' => 8,
            'aquisition_date' => null,
            'supplier' => null,
            'isClothing' => 0,
            'gender' => null,
            'size' => null,
            'role' => null,
        ]);
        // Seed 6
        DB::table('materials')->insert([
            'name' => 'Botas Segurança',
            'description' => 'Botas de segurança',
            'isInternal' => 1,
            'quantity' => 4,
            'aquisition_date' => null,
            'supplier' => null,
            'isClothing' => 1,
            'gender' => 0,
            'size' => '42',
            'role' => 3,
        ]);
    }
}
