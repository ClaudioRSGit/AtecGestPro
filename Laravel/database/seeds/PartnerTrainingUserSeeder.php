<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerTrainingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seed 1
        DB::table('partner__training__users')->insert([
            'partner_id' => 1,
            'training_id' => 1,
            'user_id' => 3,
            'start_date' => '2020-12-01 00:00:00',
            'end_date' => '2020-12-02 00:00:00',

        ]);
        //Seed 1
        DB::table('partner__training__users')->insert([
            'partner_id' => 5,
            'training_id' => 5,
            'user_id' => 3,
            'start_date' => '2020-12-03 00:00:00',
            'end_date' => '2020-12-05 00:00:00',

        ]);
        //Seed 1«2
        DB::table('partner__training__users')->insert([
            'partner_id' => 2,
            'training_id' => 2,
            'user_id' => 3,
            'start_date' => '2023-12-01 00:00:00',
            'end_date' => '2023-12-03 00:00:00',

        ]);
        //Seed 3
        DB::table('partner__training__users')->insert([
            'partner_id' => 3,
            'training_id' => 3,
            'user_id' => 3,
            'start_date' => '2022-12-01 00:00:00',
            'end_date' => '2022-12-05 00:00:00',

        ]);
        //Seed 4
        DB::table('partner__training__users')->insert([
            'partner_id' => 4,
            'training_id' => 4,
            'user_id' => 3,
            'start_date' => '2024-12-01 00:00:00',
            'end_date' => '2024-12-02 00:00:00',

        ]);
    }
}
