<?php

use Illuminate\Database\Seeder;

class TicketPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('ticket_priorities')->insert([
            'description' => 'Baixa',
            'default_dueByDate' => now()->addDays(7),
        ]);

        // Seed 2
        DB::table('ticket_priorities')->insert([
            'description' => 'Normal',
            'default_dueByDate' => now()->addDays(5),
        ]);

        // Seed 3
        DB::table('ticket_priorities')->insert([
            'description' => 'Alta',
            'default_dueByDate' => now()->addDays(3),
        ]);

        // Seed 4
        DB::table('ticket_priorities')->insert([
            'description' => 'Urgente',
            'default_dueByDate' => now()->addDays(2),
        ]);

        // Seed 5
        DB::table('ticket_priorities')->insert([
            'description' => 'Crítica',
            'default_dueByDate' => now()->addDays(1),
        ]);
    }
}
