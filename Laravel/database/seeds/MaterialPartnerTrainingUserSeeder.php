<?php

use Illuminate\Database\Seeder;

class MaterialPartnerTrainingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //PTU 1
        DB::table('material_partner_training_users')->insert([
            'material_id' => 3,
            'partner_training_user_id' => 1,
            'quantity' => 1,
        ]);
        DB::table('material_partner_training_users')->insert([
            'material_id' => 4,
            'partner_training_user_id' => 1,
            'quantity' => 1,
        ]);


        //PTU 2
        DB::table('material_partner_training_users')->insert([
            'material_id' => 3,
            'partner_training_user_id' => 2,
            'quantity' => 1,
        ]);
        DB::table('material_partner_training_users')->insert([
            'material_id' => 4,
            'partner_training_user_id' => 2,
            'quantity' => 1,
        ]);
    }
}
