<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('comments')->insert([
            'description' => 'Sem stock de cadeiras. A encomenda chega na próxima semana.',
            'ticket_id' => 1,
            'user_id' => 3,
            'isPublic' => true,
            'created_at' => '2023-01-30 14:59:00',
        ]);
        DB::table('comments')->insert([
            'description' => 'Cadeira reposta.',
            'ticket_id' => 1,
            'user_id' => 12,
            'isPublic' => true,
            'created_at' => '2023-02-10 15:00:00',
        ]);

        // Seed 2
        DB::table('comments')->insert([
            'description' => 'Este problema foi resolvido. A fechar o ticket.',
            'ticket_id' => 2,
            'user_id' => 3,
            'isPublic' => true,
            'created_at' => '2023-02-26 19:52:10',
        ]);

        // Seed 3
        DB::table('comments')->insert([
            'description' => 'Substituição realizada.',
            'ticket_id' => 3,
            'user_id' => 3,
            'isPublic' => true,
            'created_at' => '2023-03-29 17:40:10',
        ]);

        // Seed 4
        DB::table('comments')->insert([
            'description' => 'Sala pronta',
            'ticket_id' => 4,
            'user_id' => 3,
            'isPublic' => true,
            'created_at' => '2023-04-13 10:21:10',
        ]);

        // Seed 5
        DB::table('comments')->insert([
            'description' => 'Computador substituido',
            'ticket_id' => 5,
            'user_id' => 3,
            'isPublic' => false,
            'created_at' => '2023-05-12 18:03:10',
        ]);
    }
}
