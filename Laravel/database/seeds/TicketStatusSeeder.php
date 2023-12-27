<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('ticket_statuses')->insert([
            'description' => 'Open',
        ]);

        // Seed 2
        DB::table('ticket_statuses')->insert([
            'description' => 'In Progress',
        ]);

        // Seed 3
        DB::table('ticket_statuses')->insert([
            'description' => 'On Hold',
        ]);

        // Seed 4
        DB::table('ticket_statuses')->insert([
            'description' => 'Resolved',
        ]);

        // Seed 5
        DB::table('ticket_statuses')->insert([
            'description' => 'Closed',
        ]);
    }
}
