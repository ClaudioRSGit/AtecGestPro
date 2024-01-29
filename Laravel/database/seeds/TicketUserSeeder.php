<?php

use Illuminate\Database\Seeder;

class TicketUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('ticket_users')->insert([
            'id' => 1,
            'ticket_id' => 1,
            'user_id' => 10,
        ]);

        // Seed 2
        DB::table('ticket_users')->insert([
            'id' => 2,
            'ticket_id' => 2,
            'user_id' => 10,
        ]);

        // Seed 3
        DB::table('ticket_users')->insert([
            'id' => 3,
            'ticket_id' => 3,
            'user_id' => 10,
        ]);

        // Seed 4
        DB::table('ticket_users')->insert([
            'id' => 4,
            'ticket_id' => 4,
            'user_id' => 10,
        ]);

        // Seed 5
        DB::table('ticket_users')->insert([
            'id' => 5,
            'ticket_id' => 5,
            'user_id' => 12,
        ]);
        // Seed 6
        DB::table('ticket_users')->insert([
            'id' => 6,
            'ticket_id' => 6,
            'user_id' => 12,
        ]);
        // Seed 7
        DB::table('ticket_users')->insert([
            'id' => 7,
            'ticket_id' => 7,
            'user_id' => 12,
        ]);
        // Seed 8
        DB::table('ticket_users')->insert([
            'id' => 8,
            'ticket_id' => 8,
            'user_id' => 12,
        ]);
        // Seed 9
        DB::table('ticket_users')->insert([
            'id' => 9,
            'ticket_id' => 9,
            'user_id' => 12,
        ]);
    }
}
