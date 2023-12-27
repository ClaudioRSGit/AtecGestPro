<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('comments')->insert([
            'description' => 'Sem stock de cadeiras. A encomenda chega na próxima semana.',
            'ticket_id' => 1,
            'user_id' => 3,
            'isPublic' => true,
        ]);

        // Seed 2
        DB::table('comments')->insert([
            'description' => 'Este problema foi resolvido. A fechar o ticket.',
            'ticket_id' => 2,
            'user_id' => 3,
            'isPublic' => true,
        ]);

        // Seed 3
        DB::table('comments')->insert([
            'description' => 'Hardware replacement completed successfully.',
            'ticket_id' => 3,
            'user_id' => 3,
            'isPublic' => true,
        ]);

        // Seed 4
        DB::table('comments')->insert([
            'description' => 'Troco dia 19 até às 15h.',
            'ticket_id' => 4,
            'user_id' => 3,
            'isPublic' => true,
        ]);

        // Seed 5
        DB::table('comments')->insert([
            'description' => 'Dia 20 e a lampa ainda não foi trocada.',
            'ticket_id' => 4,
            'user_id' => 2,
            'isPublic' => false,
        ]);
    }
}
