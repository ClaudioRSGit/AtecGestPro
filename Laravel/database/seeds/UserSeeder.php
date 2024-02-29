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
        // Seed 1
        DB::table('users')->insert([
            'name' => 'Fila de Espera',
            'username' => 'fila_de_espera',
            'email' => 'filadeespera@edu.atec.pt',
            'contact' => '00000000',
            'password' => '',
            'notes' => '',
            'isActive' => false,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 4,
        ]);

        // Seed 2
        DB::table('users')->insert([
            'name' => 'Utilizador Padrao',
            'username' => 'padrao',
            'email' => 'utilizador.padrao@edu.atec.pt',
            'contact' => '',
            'password' => '',
            'notes' => '',
            'isActive' => false,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 2,
        ]);

        // Seed 3
        DB::table('users')->insert([
            'name' => 'Fernando Almeida',
            'username' => 'T5050505',
            'email' => 'fernando.almeida.t5050505@edu.atec.pt',
            'contact' => '912123111',
            'password' => bcrypt('Atec123!'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 1,
        ]);

        // Seed 4
        DB::table('users')->insert([
            'name' => 'Cláudio Silva',
            'username' => 'T0123173',
            'email' => 'claudio.silva.t0123173@edu.atec.pt',
            'contact' => '912123670',
            'password' => bcrypt('Atec123!'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 1,
        ]);

        // Seed 5
        DB::table('users')->insert([
            'name' => 'Fábio Silva',
            'username' => 'T0111864',
            'email' => 'fabio.silva.t0111864@edu.atec.pt',
            'contact' => '912123671',
            'password' => bcrypt('Atec123!'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 1,
        ]);

        // Seed 6
        DB::table('users')->insert([
            'name' => 'Bernardo Teixeira',
            'username' => 'T0123172',
            'email' => 'bernardo.teixeira.t0123172@edu.atec.pt',
            'contact' => '912123672',
            'password' => bcrypt('Atec123!'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 1,
        ]);

         // Seed 7
         DB::table('users')->insert([
            'name' => 'Ricardo Ferreira',
            'username' => 'T0123185',
            'email' => 'ricardo.ferreira.t0123185@edu.atec.pt',
            'contact' => '912123673',
            'password' => bcrypt('Atec123!'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 1,
        ]);

        // Seed 8
        DB::table('users')->insert([
            'name' => 'Wilson Miranda',
            'username' => 'T0123188',
            'email' => 'wilson.miranda.t0123188@edu.atec.pt',
            'contact' => '912123674',
            'password' => bcrypt('Atec123!'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 1,
        ]);

        // Seed 9
        DB::table('users')->insert([
            'name' => 'Antonio Carro',
            'username' => 'T0000001',
            'email' => 'antonio.carro.t3698521@edu.atec.pt',
            'contact' => '9121236785',
            'password' => bcrypt('Atec123!'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 2,
        ]);

         // Seed 10
         DB::table('users')->insert([
            'name' => 'Ricardo Batista',
            'username' => 'T0000002',
            'email' => 'ricardo.batista.t00000123@edu.atec.pt',
            'contact' => '912123676',
            'password' => bcrypt('Atec123!'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 4,
        ]);

         // Seed 11
         DB::table('users')->insert([
            'name' => 'Ana Mesquita',
            'username' => 'T0000020',
            'email' => 'ana.mesquita.t0000020@edu.atec.pt',
            'contact' => '912123677',
            'password' => bcrypt('Atec123!'),
            'notes' => '',
            'isActive' => true,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 4,
        ]);

        //Inactive User
        // Seed 12
        DB::table('users')->insert([
            'name' => 'Ruben Canelas',
            'username' => 'T0000021',
            'email' => 'ruben.canelas.t0000020@edu.atec.pt',
            'contact' => '9121236788',
            'password' => bcrypt('Atec123!'),
            'notes' => '',
            'isActive' => false,
            'isStudent' => false,
            'course_class_id' => null,
            'role_id' => 4,
        ]);

        //Students
        // Seed 13
        DB::table('users')->insert([
            'name' => 'Henrique Varela',
            'username' => 'T0000003',
            'email' => 'henrique.varela.t0000003@edu.atec.pt',
            'contact' => '912123679',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
            'role_id' => 3,
        ]);

        // Seed 14
        DB::table('users')->insert([
            'name' => 'Fabio Teixeira',
            'username' => 'T0000004',
            'email' => 'henrique.varela.t0000004@edu.atec.pt',
            'contact' => '912123610',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
            'role_id' => 3,
        ]);

        // Seed 15
        DB::table('users')->insert([
            'name' => 'Daniel Pereira',
            'username' => 'T0000005',
            'email' => 'daniel.pereira.t0000005@edu.atec.pt',
            'contact' => '912123611',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 5,
            'role_id' => 3,
        ]);


        // Seed 16
        DB::table('users')->insert([
            'name' => 'Jose Almeida',
            'username' => 'T0000006',
            'email' => 'jose.almeida.t0000006@edu.atec.pt',
            'contact' => '912123612',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 4,
            'role_id' => 3,
        ]);

        // Seed 17
        DB::table('users')->insert([
            'name' => 'Pedro Fernandes',
            'username' => 'T0000007',
            'email' => 'pedro.fernandes.t0000007@edu.atec.pt',
            'contact' => '912123613',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 4,
            'role_id' => 3,
        ]);

        // Seed 18
        DB::table('users')->insert([
            'name' => 'Vasco Silva',
            'username' => 'T0000008',
            'email' => 'vasco.silva.t0000008@edu.atec.pt',
            'contact' => '912123614',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 4,
            'role_id' => 3,
        ]);


        // Seed 19
        DB::table('users')->insert([
            'name' => 'Gonçalo Moreira',
            'username' => 'T0000009',
            'email' => 'goncalo.moreira.t0000009@edu.atec.pt',
            'contact' => '912123615',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 3,
            'role_id' => 3,
        ]);

        // Seed 20
        DB::table('users')->insert([
            'name' => 'Hugo Serafim',
            'username' => 'T0000010',
            'email' => 'hugo.serafim.t0000010@edu.atec.pt',
            'contact' => '912123616',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 3,
            'role_id' => 3,
        ]);

        // Seed 21
        DB::table('users')->insert([
            'name' => 'André Cardoso',
            'username' => 'T0000011',
            'email' => 'andre.cardoso.t0000011@edu.atec.pt',
            'contact' => '912123617',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 3,
            'role_id' => 3,
        ]);

          // Seed 22
          DB::table('users')->insert([
            'name' => 'Gaspar Junior',
            'username' => 'T0000012',
            'email' => 'gaspar.junior.t0000012@edu.atec.pt',
            'contact' => '912123618',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 2,
            'role_id' => 3,
        ]);

        // Seed 23
        DB::table('users')->insert([
            'name' => 'Walter Amorim',
            'username' => 'T0000013',
            'email' => 'walter.amorim.t0000013@edu.atec.pt',
            'contact' => '912123619',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 2,
            'role_id' => 3,
        ]);

        // Seed 24
        DB::table('users')->insert([
            'name' => 'Tiago Bonifácio',
            'username' => 'T0000014',
            'email' => 'andre.cardoso.t0000014@edu.atec.pt',
            'contact' => '912123620',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 2,
            'role_id' => 3,
        ]);

        // Seed 25
        DB::table('users')->insert([
            'name' => 'André Manuel',
            'username' => 'T0000015',
            'email' => 'andre.manuel.t0000015@edu.atec.pt',
            'contact' => '912123621',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 1,
            'role_id' => 3,
        ]);

        // Seed 26
        DB::table('users')->insert([
            'name' => 'Manuel Andrade',
            'username' => 'T0000016',
            'email' => 'manuel.andrade.t0000016@edu.atec.pt',
            'contact' => '912123622',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 1,
            'role_id' => 3,
        ]);

        // Seed 27
        DB::table('users')->insert([
            'name' => 'Bruno Lovato',
            'username' => 'T0000017',
            'email' => 'bruno.lovato.t0000017@edu.atec.pt',
            'contact' => '912123623',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 1,
            'role_id' => 3,
        ]);

        // Seed 28
        DB::table('users')->insert([
            'name' => 'João Novo',
            'username' => 'T0000117',
            'email' => 'joao.novo.t0000117@edu.atec.pt',
            'contact' => '912623623',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 1,
            'role_id' => 3,
        ]);

        // Seed 29
        DB::table('users')->insert([
            'name' => 'Alexandre Bernardo',
            'username' => 'T0001117',
            'email' => 'alexandre.bernardo.t0001117@edu.atec.pt',
            'contact' => '918623623',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 1,
            'role_id' => 3,
        ]);

        // Seed 30
        DB::table('users')->insert([
            'name' => 'José Almeida',
            'username' => 'T0111117',
            'email' => 'jose.almeida.t0011117@edu.atec.pt',
            'contact' => '912623663',
            'password' => null,
            'notes' => '',
            'isActive' => true,
            'isStudent' => true,
            'course_class_id' => 1,
            'role_id' => 3,
        ]);


    }
}
