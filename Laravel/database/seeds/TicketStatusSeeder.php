<?php

use Illuminate\Database\Seeder;

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
            'description' => 'Aberto',
        ]);

        // Seed 2
        DB::table('ticket_statuses')->insert([
            'description' => 'Em Progresso',
        ]);

        // Seed 3
        DB::table('ticket_statuses')->insert([
            'description' => 'Pendente',
        ]);

        // Seed 4
        DB::table('ticket_statuses')->insert([
            'description' => 'Resolvido',
        ]);

        // Seed 5
        DB::table('ticket_statuses')->insert([
            'description' => 'Fechado',
        ]);
    }
}
