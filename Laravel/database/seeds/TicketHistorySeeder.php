<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('ticket_histories')->insert([
            'ticket_id' => 1,
            'ticket_info' => 'Ticket created.',
            'action_id' => 1,
        ]);

        // Seed 2
        DB::table('ticket_histories')->insert([
            'ticket_id' => 2,
            'ticket_info' => 'Ticket created.',
            'action_id' => 1,
        ]);

        // Seed 3
        DB::table('ticket_histories')->insert([
            'ticket_id' => 3,
            'ticket_info' => 'Ticket created.',
            'action_id' => 1,
        ]);

        // Seed 4
        DB::table('ticket_histories')->insert([
            'ticket_id' => 4,
            'ticket_info' => 'Ticket created.',
            'action_id' => 1,
        ]);

        // Seed 5
        DB::table('ticket_histories')->insert([
            'ticket_id' => 5,
            'ticket_info' => 'Ticket created.',
            'action_id' => 3,
        ]);
    }
}
