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
            'user_id' => 1,
        ]);

        // Seed 2
        DB::table('ticket_users')->insert([
            'id' => 2,
            'ticket_id' => 2,
            'user_id' => 2,
        ]);

        // Seed 3
        DB::table('ticket_users')->insert([
            'id' => 3,
            'ticket_id' => 3,
            'user_id' => 3,
        ]);
    }
}
