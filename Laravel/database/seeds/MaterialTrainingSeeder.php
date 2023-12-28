<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialTrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('material__trainings')->insert([
            'partner__trainings__user_id' => 1,
            'material_id' => 4,
            'quantity' => 1,
        ]);
        // Seed 1
        DB::table('material__trainings')->insert([
            'partner__trainings__user_id' => 1,
            'material_id' => 4,
            'quantity' => 1,
        ]);
        // Seed 1
        DB::table('material__trainings')->insert([
            'partner__trainings__user_id' => 1,
            'material_id' => 5,
            'quantity' => 1,
        ]);
        // Seed 1
        DB::table('material__trainings')->insert([
            'partner__trainings__user_id' => 1,
            'material_id' => 5,
            'quantity' => 1,
        ]);
        // Seed 1
        DB::table('material__trainings')->insert([
            'partner__trainings__user_id' => 1,
            'material_id' => 5,
            'quantity' => 1,
        ]);
    }
}
