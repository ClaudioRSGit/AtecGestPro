<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'Administrador',
        ]);
        // Seed 3
        DB::table('roles')->insert([
            'name' => 'funcionario',
            'description' => 'Funcionário',
        ]);
        // Seed 2
        DB::table('roles')->insert([
            'name' => 'formando',
            'description' => 'Formando',
        ]);
        // Seed 4
        DB::table('roles')->insert([
            'name' => 'tecnico',
            'description' => 'Técnico',
        ]);
    }
}
