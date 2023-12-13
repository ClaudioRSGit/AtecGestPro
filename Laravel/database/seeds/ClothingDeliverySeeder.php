<?php

use Illuminate\Database\Seeder;

class ClothingDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('clothing_deliveries')->insert([
            'user_id' => 4,
            'delivered' => 0,
            'additionalNotes' => null,
        ]);

        // Seed 2
        DB::table('clothing_deliveries')->insert([
            'user_id' => 5,
            'delivered' => 1,
            'additionalNotes' => null,
        ]);

    }
}
