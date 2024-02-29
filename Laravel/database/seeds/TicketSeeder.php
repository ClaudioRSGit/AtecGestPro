<?php

use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('tickets')->insert([
            'user_id' => 2,
            'title' => 'Cadeira partida',
            'description' => 'A sala 19 tem uma cadeira partida',
            'dueByDate' => now()->addDays(3),
            'attachment' => null,
            'ticket_status_id' => 1,
            'ticket_priority_id' => 2,
            'ticket_category_id' => 3,
            'created_at' => '2023-01-29 14:37:10',

        ]);

        // Seed 2
        DB::table('tickets')->insert([
            'user_id' => 2,
            'title' => 'Cabo rede',
            'description' => 'Falta cabo de rede na sala 19',
            'dueByDate' => now()->addDays(5),
            'attachment' => null,
            'ticket_status_id' => 1,
            'ticket_priority_id' => 3,
            'ticket_category_id' => 3,
            'created_at' => '2023-02-26 14:37:10',
        ]);

        // Seed 3
        DB::table('tickets')->insert([
            'user_id' =>  3,
            'title' => 'Lampada fundida',
            'description' => 'Lampada fundida na sala 19',
            'dueByDate' => now()->addDays(7),
            'attachment' => null,
            'ticket_status_id' => 1,
            'ticket_priority_id' => 4,
            'ticket_category_id' => 1,
            'created_at' => '2023-03-29 14:37:10',
        ]);

        // Seed 4
        DB::table('tickets')->insert([
            'user_id' =>  3,
            'title' => 'Preparação de feira de emprego',
            'description' => 'Por favor preparar a sala 19 para a feira de emprego',
            'dueByDate' => now()->addDays(10),
            'attachment' => null,
            'ticket_status_id' => 1,
            'ticket_priority_id' => 4,
            'ticket_category_id' => 1,
            'created_at' => '2023-04-12 14:37:10',
        ]);

        // Seed 5
        DB::table('tickets')->insert([
            'user_id' => 14,
            'title' => 'PC não liga',
            'description' => 'O pc 14 do formador não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => null,
            'ticket_status_id' => 2,
            'ticket_priority_id' => 5,
            'ticket_category_id' => 3,
            'created_at' => '2023-05-12 14:37:10',
        ]);

        // Seed 6
        DB::table('tickets')->insert([
            'user_id' => 14,
            'title' => 'PC não liga',
            'description' => 'O pc 11 da sala 10 não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => null,
            'ticket_status_id' => 2,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2023-06-12 14:37:10',
        ]);

        // Seed 7
        DB::table('tickets')->insert([
            'user_id' =>  3,
            'title' => 'Projetor não funciona',
            'description' => 'Projetor não funciona na sala 1.03',
            'dueByDate' => now()->addDays(2),
            'attachment' => null,
            'ticket_status_id' => 2,
            'ticket_priority_id' => 3,
            'ticket_category_id' => 3,
            'created_at' => '2023-07-12 14:37:10',
        ]);

        // Seed 8
        DB::table('tickets')->insert([
            'user_id' =>  3,
            'title' => 'Tela não baixa',
            'description' => 'Tela da sala 1.05 não baixa.',
            'dueByDate' => now()->addDays(2),
            'attachment' => null,
            'ticket_status_id' => 4,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2023-08-12 15:41:00',
        ]);

        // Seed 9
        DB::table('tickets')->insert([
            'user_id' =>  3,
            'title' => 'PC não liga',
            'description' => 'O pc 8 da sala 9 não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => null,
            'ticket_status_id' => 2,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2023-08-16 18:14:23',
        ]);

        // Seed 10
        DB::table('tickets')->insert([
            'user_id' => 3,
            'title' => 'PC não liga',
            'description' => 'O pc 14 da sala 15 não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => null,
            'ticket_status_id' => 5,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2023-01-19 14:37:10',
            'updated_at' => '2023-01-19 14:38:00',
            'deleted_at' => '2023-01-19 14:38:00',
        ]);

        // Seed 11
        DB::table('tickets')->insert([
            'user_id' => 3,
            'title' => 'Teclado com as teclas trocadas',
            'description' => 'Teclado do computador 5 da sala 1.23 com as teclas trocadas',
            'dueByDate' => now()->addDays(2),
            'attachment' => null,
            'ticket_status_id' => 5,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2023-01-12 14:37:10',
            'updated_at' => '2023-01-12 14:37:10',
            'deleted_at' => '2023-01-12 14:37:10',
        ]);
    }
}
