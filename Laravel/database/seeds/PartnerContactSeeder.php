<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('partner_contacts')->insert([
            'contact' => '+351 229 570 000',
            'partner_id' => 1,
        ]);

        // Seed 2
        DB::table('partner_contacts')->insert([
            'contact' => '+334 72 18 16 00',
            'partner_id' => 2,
        ]);

        // Seed 3
        DB::table('partner_contacts')->insert([
            'contact' => '+330 239 792 100',
            'partner_id' => 3,
        ]);

        // Seed 4
        DB::table('partner_contacts')->insert([
            'contact' => '+351 256 200 200',
            'partner_id' => 4,
        ]);

        // Seed 5
        DB::table('partner_contacts')->insert([
            'contact' => '+440 223 744 000',
            'partner_id' => 5,
        ]);
    }
}
