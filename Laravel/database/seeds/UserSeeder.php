<?php

use Illuminate\Database\Seeder;
//use faker
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PLEASE DONT DELETE THIS SEEDER
        DB::table('users')->insert([
            'name' => 'Fila de Espera',
            'username' => 'fila_de_espera',
            'email' => 'filadeespera@edu.atec.pt',
            'contact' => '911111111',
            'password' => '',
            'notes' => '',
            'isActive' => false,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 4,
        ]);
        // Seed 14
        DB::table('users')->insert([
            'name' => 'Utilizador Padrão',
            'username' => 'padrao',
            'email' => 'utilizador.padrao@edu.atec.pt',
            'contact' => '922222222',
            'password' => '',
            'notes' => '',
            'isActive' => false,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 2,
        ]);


        // Seed 1
        DB::table('users')->insert([
            'name' => 'Vasco Trindade',
            'username' => 'T3698521',
            'email' => 'claudio.silva.t0123173@edu.atec.pt',
            'contact' => '912345678',
            'password' => bcrypt('password123'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 1,
        ]);
        // Seed 2
        DB::table('users')->insert([
            'name' => 'Antonio Carro',
            'username' => 'T0123388',
            'email' => 'antonio.carro.t3698521@edu.atec.pt',
            'contact' => '912345699',
            'password' => bcrypt('password123'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 3,
        ]);
        // Seed 3
        DB::table('users')->insert([
            'name' => 'Francisco Silva',
            'username' => 'T2365478',
            'email' => 'fancisco.silva.t2365478@edu.atec.pt',
            'contact' => '912345679',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => null,
            'role_id' => 3,
        ]);

        // Seed 4
        DB::table('users')->insert([
            'name' => 'Antonio Vaz',
            'username' => 'T0254456',
            'email' => 'antonio_vaz.t0254456@edu.atec.pt',
            'contact' => '934895657',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 3,
            'role_id' => 3,
        ]);

        // Seed 5
        DB::table('users')->insert([
            'name' => 'Alice Cunha',
            'username' => 'T0254496',
            'email' => 'alice.cunha.t0254496@edu.atec.pt',
            'contact' => '934895757',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 4,
            'role_id' => 3,
        ]);

        // Seed 6
        DB::table('users')->insert([
            'name' => 'José Silva',
            'username' => 'T0123186',
            'email' => 'jose.silva.t0123186@edu.atec.pt',
            'contact' => '934092936',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
            'role_id' => 3,
                    ]);
        // Seed 7
        DB::table('users')->insert([
            'name' => 'José Silva2',
            'username' => 'T0123187',
            'email' => 'jose.silva.t0123187@edu.atec.pt',
            'contact' => '934092937',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
            'role_id' => 3,
        ]);
        // Seed 8
        DB::table('users')->insert([
            'name' => 'José Silva8',
            'username' => 'T0123188',
            'email' => 'jose.silva.t0123158@edu.atec.pt',
            'contact' => '934092938',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
            'role_id' => 3,
        ]);
        // Seed 9
        DB::table('users')->insert([
            'name' => 'José Silva4',
            'username' => 'T0123189',
            'email' => 'jose.silva.t0123189@edu.atec.pt',
            'contact' => '934092939',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
            'role_id' => 3,
        ]);
        // Seed 10
        DB::table('users')->insert([
            'name' => 'José tecnico',
            'username' => 'T0123111',
            'email' => 'jose.silva.t01231c89@edu.atec.pt',
            'contact' => '933592939',
            'password' => bcrypt('passwordxyz'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 4,
        ]);
        // Seed 11
        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'jose.silva.t0121c89@edu.atec.pt',
            'contact' => '934562939',
            'password' => bcrypt('Password*123'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 1,
        ]);
        // Seed 12
        DB::table('users')->insert([
            'name' => 'tecnico',
            'username' => 'tecnico',
            'email' => 'ricardo.ferreira.t0123185@edu.atec.pt',
            'contact' => '934592939',
            'password' => bcrypt('Password*123'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 4,
        ]);
        // Seed 13
        DB::table('users')->insert([
            'name' => 'ricardo',
            'username' => 'ricardo',
            'email' => 'ricardo.ferreira.t01235@edu.atec.pt',
            'contact' => '934592548',
            'password' => bcrypt('Password*123'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 1,
        ]);



        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $username = 'T' . $faker->unique()->randomNumber(7);
            $email = strtolower($firstName . '.' . $lastName . '.' . $username . '@edu.atec.pt');
            $contact = $faker->numerify('#########');
            $courseClassId = ($i % 5) + 1;
            $password = null;
            $isStudent = true;
            $roleId = 3;

            DB::table('users')->insert([
                'name' => $firstName . ' ' . $lastName,
                'username' => $username,
                'email' => $email,
                'contact' => $contact,
                'password' => $password,
                'notes' => '',
                'isActive' => true,
                'isStudent' => $isStudent,
                'course_class_id' => $courseClassId,
                'role_id' => $roleId,
            ]);
        }

        for ($i = 0; $i < 30; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $username = 'T' . $faker->unique()->randomNumber(7);
            $email = strtolower($firstName . '.' . $lastName . '.' . $username . '@edu.atec.pt');
            $contact = $faker->numerify('#########');
            $password = null;
            $isStudent = true;
            $roleId = 3;

            DB::table('users')->insert([
                'name' => $firstName . ' ' . $lastName,
                'username' => $username,
                'email' => $email,
                'contact' => $contact,
                'password' => $password,
                'notes' => '',
                'isActive' => true,
                'isStudent' => $isStudent,
                'course_class_id' => null,
                'role_id' => $roleId,
            ]);
        }



    }
}
