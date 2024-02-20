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
            'attachment' => '4s3vkpyDNVzeHYwSyZF18oJWcSSuYY4cpcI1uFR5.pdf',
            'ticket_status_id' => 1,
            'ticket_priority_id' => 2,
            'ticket_category_id' => 3,
            'created_at' => '2024-01-29 14:37:10',
            'updated_at' => '2024-01-31 14:37:10',

        ]);

        // Seed 2
        DB::table('tickets')->insert([
            'user_id' => 2,
            'title' => 'Cabo rede',
            'description' => 'Falta cabo de rede na sala 19',
            'dueByDate' => now()->addDays(5),
            'attachment' => '4s3vkpyDNVzeHYwSyZF18oJWcSSuYY4cpcI1uFR5',
            'ticket_status_id' => 2,
            'ticket_priority_id' => 3,
            'ticket_category_id' => 3,
            'created_at' => '2024-01-29 14:37:10',
            'updated_at' => '2024-01-31 14:37:10',
        ]);

        // Seed 3
        DB::table('tickets')->insert([
            'user_id' => 5,
            'title' => 'Lampada fundida',
            'description' => 'Lampada fundida na sala 19',
            'dueByDate' => now()->addDays(7),
            'attachment' => 'hardware_request_attachment.jpg',
            'ticket_status_id' => 3,
            'ticket_priority_id' => 3,
            'ticket_category_id' => 1,
            'created_at' => '2024-01-29 14:37:10',
            'updated_at' => '2024-01-31 14:37:10',
        ]);

        // Seed 4
        DB::table('tickets')->insert([
            'user_id' => 5,
            'title' => 'Preparação de feira de emprego',
            'description' => 'Por favor preparar a sala 19 para a feira de emprego',
            'dueByDate' => now()->addDays(10),
            'attachment' => 'general_inquiry_attachment.txt',
            'ticket_status_id' => 4,
            'ticket_priority_id' => 2,
            'ticket_category_id' => 1,
            'created_at' => '2021-01-12 14:37:10',
            'updated_at' => '2021-01-12 14:37:10',
        ]);

        // Seed 5
        DB::table('tickets')->insert([
            'user_id' => 5,
            'title' => 'PC não liga',
            'description' => 'O pc 14 da sala 15 não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => 'password_reset_request_attachment.pdf',
            'ticket_status_id' => 5,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2021-01-12 14:37:10',
            'updated_at' => '2021-01-12 14:37:10',
        ]);
        // Seed 6
        DB::table('tickets')->insert([
            'user_id' => 5,
            'title' => 'PC não liga',
            'description' => 'O pc 14 da sala 15 não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => 'password_reset_request_attachment.pdf',
            'ticket_status_id' => 5,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2021-01-12 14:37:10',
            'updated_at' => '2021-01-12 14:37:10',
        ]);
        // Seed 7
        DB::table('tickets')->insert([
            'user_id' => 5,
            'title' => 'PC não liga',
            'description' => 'O pc 14 da sala 15 não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => 'password_reset_request_attachment.pdf',
            'ticket_status_id' => 5,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2021-01-12 14:37:10',
            'updated_at' => '2021-01-12 14:37:10',
        ]);
        // Seed 8
        DB::table('tickets')->insert([
            'user_id' => 5,
            'title' => 'PC não liga',
            'description' => 'O pc 14 da sala 15 não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => 'password_reset_request_attachment.pdf',
            'ticket_status_id' => 5,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2021-01-12 14:37:10',
            'updated_at' => '2021-01-12 14:37:10',
        ]);
        // Seed 9
        DB::table('tickets')->insert([
            'user_id' => 5,
            'title' => 'PC não liga',
            'description' => 'O pc 14 da sala 15 não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => 'password_reset_request_attachment.pdf',
            'ticket_status_id' => 5,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2021-01-12 14:37:10',
            'updated_at' => '2021-01-12 14:37:10',
        ]);
        // Seed 10
        DB::table('tickets')->insert([
            'user_id' => 5,
            'title' => 'PC não liga',
            'description' => 'O pc 14 da sala 15 não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => 'password_reset_request_attachment.pdf',
            'ticket_status_id' => 5,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2021-01-12 14:37:10',
            'updated_at' => '2021-01-12 14:37:10',
            'deleted_at' => '2022-01-12 14:37:10',
        ]);
        // Seed 10
        DB::table('tickets')->insert([
            'user_id' => 3,
            'title' => 'PC já liga',
            'description' => 'O pc 14 da sala 15 não liga',
            'dueByDate' => now()->addDays(2),
            'attachment' => 'password_reset_request_attachment.pdf',
            'ticket_status_id' => 5,
            'ticket_priority_id' => 1,
            'ticket_category_id' => 3,
            'created_at' => '2021-01-12 14:37:10',
            'updated_at' => '2021-01-12 14:37:10',
            'deleted_at' => '2022-01-12 14:37:10',
        ]);
    }
}
