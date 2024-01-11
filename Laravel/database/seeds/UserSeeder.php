<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'position' => 'admin',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
        ]);
        // Seed 2
        DB::table('users')->insert([
            'name' => 'Antonio Carro',
            'username' => 'T0123388',
            'email' => 'antonio.carro.t3698521@edu.atec.pt',
            'contact' => '912345699',
            'password' => bcrypt('password123'),
            'position' => 'admin',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
        ]);
        // Seed 3
        DB::table('users')->insert([
            'name' => 'Francisco Silva',
            'username' => 'T2365478',
            'email' => 'fancisco.silva.t2365478@edu.atec.pt',
            'contact' => '912345679',
            'password' => bcrypt('password456'),
            'position' => 'user',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => null,
        ]);

        // Seed 4
        DB::table('users')->insert([
            'name' => 'Antonio Vaz',
            'username' => 'T0254456',
            'email' => 'antonio_vaz.t0254456@edu.atec.pt',
            'contact' => '934895657',
            'password' => bcrypt('password789'),
            'position' => 'tecnico',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 3,
        ]);

        // Seed 5
        DB::table('users')->insert([
            'name' => 'Alice Cunha',
            'username' => 'T0254496',
            'email' => 'alice.cunha.t0254496@edu.atec.pt',
            'contact' => '934895757',
            'password' => bcrypt('passwordabc'),
            'position' => 'formando',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 4,
        ]);

        // Seed 6
        DB::table('users')->insert([
            'name' => 'José Silva',
            'username' => 'T0123186',
            'email' => 'jose.silva.t0123186@edu.atec.pt',
            'contact' => '934092936',
            'password' => bcrypt('passwordxy6'),
            'position' => 'formando',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
        ]);
        // Seed 7
        DB::table('users')->insert([
            'name' => 'José Silva2',
            'username' => 'T0123187',
            'email' => 'jose.silva.t0123187@edu.atec.pt',
            'contact' => '934092937',
            'password' => bcrypt('passwordxy7'),
            'position' => 'formando',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
        ]);
        // Seed 8
        DB::table('users')->insert([
            'name' => 'José Silva8',
            'username' => 'T0123188',
            'email' => 'jose.silva.t0123158@edu.atec.pt',
            'contact' => '934092938',
            'password' => bcrypt('passwordxyz'),
            'position' => 'formando',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
        ]);
        // Seed 9
        DB::table('users')->insert([
            'name' => 'José Silva4',
            'username' => 'T0123189',
            'email' => 'jose.silva.t0123189@edu.atec.pt',
            'contact' => '934092939',
            'password' => bcrypt('passwordxyz'),
            'position' => 'formando',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
        ]);
        // Seed 10
        DB::table('users')->insert([
            'name' => 'José tecnico',
            'username' => 'T0123111',
            'email' => 'jose.silva.t01231c89@edu.atec.pt',
            'contact' => '934592939',
            'password' => bcrypt('passwordxyz'),
            'position' => 'formando',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
        ]);
         // Seed 11
         DB::table('users')->insert([
            'name' => 'José Coentrão',
            'username' => 'teste123',
            'email' => 'jose.coentrao.t01231c89@edu.atec.pt',
            'contact' => '934592239',
            'password' => bcrypt('Teste123!'),
            'position' => 'formando',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
        ]);
    }
}
