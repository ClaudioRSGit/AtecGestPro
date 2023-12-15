<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('users')->insert([
            'name' => 'Vasco Trindade',
            'username' => 'T3698521',
            'email' => 'vasco.trindade.t3698521@edu.atec.pt',
            'contact' => '912345678',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => 1,
        ]);
        // Seed 1
        DB::table('users')->insert([
            'name' => 'Antonio Carro',
            'username' => 'T0123186',
            'email' => 'antonio.carro.t3698521@edu.atec.pt',
            'contact' => '912345699',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => 1,
        ]);
        // Seed 2
        DB::table('users')->insert([
            'name' => 'Francisco Silva',
            'username' => 'T2365478',
            'email' => 'fancisco.silva.t2365478@edu.atec.pt',
            'contact' => '912345679',
            'password' => bcrypt('password456'),
            'role' => 'user',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 2,
        ]);

        // Seed 3
        DB::table('users')->insert([
            'name' => 'Antonio Vaz',
            'username' => 'T0254456',
            'email' => 'antonio_vaz.t0254456@edu.atec.pt',
            'contact' => '934895657',
            'password' => bcrypt('password789'),
            'role' => 'tecnico',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 3,
        ]);

        // Seed 4
        DB::table('users')->insert([
            'name' => 'Alice Cunha',
            'username' => 'T0254496',
            'email' => 'alice.cunha.t0254496@edu.atec.pt',
            'contact' => '934895757',
            'password' => bcrypt('passwordabc'),
            'role' => 'formando',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 4,
        ]);

        // Seed 5
        DB::table('users')->insert([
            'name' => 'José Silva',
            'username' => 'T0123185',
            'email' => 'jose.silva.t0123185@edu.atec.pt',
            'contact' => '934092931',
            'password' => bcrypt('passwordxyz'),
            'role' => 'formando',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
        ]);
    }
}
