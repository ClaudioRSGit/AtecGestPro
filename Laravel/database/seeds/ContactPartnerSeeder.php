<?php

use Illuminate\Database\Seeder;

class ContactPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('contact_partners')->insert([
            'description' => 'Geral',
            'contact' => '+351 229 570 000',
            'partner_id' => 1,
        ]);

        // Seed 2
        DB::table('contact_partners')->insert([
            'description' => 'Geral',
            'contact' => '+334 72 18 16 00',
            'partner_id' => 2,
        ]);

        // Seed 3
        DB::table('contact_partners')->insert([
            'description' => 'Geral',
            'contact' => '+330 239 792 100',
            'partner_id' => 3,
        ]);

        // Seed 4
        DB::table('contact_partners')->insert([
            'description' => 'Geral',
            'contact' => '+351 256 200 200',
            'partner_id' => 4,
        ]);

        // Seed 5
        DB::table('contact_partners')->insert([
            'description' => 'Geral',
            'contact' => '+440 223 744 000',
            'partner_id' => 5,
        ]);

        // Seed 6
        DB::table('contact_partners')->insert([
            'description' => 'Geral',
            'contact' => '+441 223 744 000',
            'partner_id' => 1,
        ]);
    }
}
