<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnicianTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('technician__tickets')->insert([
            'ticket_id' => 1,
            'user_id' => 1,
        ]);

        // Seed 2
        DB::table('technician__tickets')->insert([
            'ticket_id' => 2,
            'user_id' => 2,
        ]);

        // Seed 3
        DB::table('technician__tickets')->insert([
            'ticket_id' => 3,
            'user_id' => 2,
        ]);

        // Seed 4
        DB::table('technician__tickets')->insert([
            'ticket_id' => 4,
            'user_id' => 2,
        ]);

        // Seed 5
        DB::table('technician__tickets')->insert([
            'ticket_id' => 5,
            'user_id' => 2,
        ]);
    }
}
