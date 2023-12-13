<?php

use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('ticket_categories')->insert([
            'description' => 'Suporte Técnico',
        ]);

        // Seed 2
        DB::table('ticket_categories')->insert([
            'description' => 'Financeiro',
        ]);

        // Seed 3
        DB::table('ticket_categories')->insert([
            'description' => 'Hardware',
        ]);

        // Seed 4
        DB::table('ticket_categories')->insert([
            'description' => 'Consumíveis',
        ]);

        // Seed 5
        DB::table('ticket_categories')->insert([
            'description' => 'Software',
        ]);
    }
}
