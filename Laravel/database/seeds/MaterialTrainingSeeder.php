<?php

use Illuminate\Database\Seeder;

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
            'training_id' => 1,
            'material_id' => 4,
            'quantity' => 1,
        ]);
        // Seed 1
        DB::table('material__trainings')->insert([
            'training_id' => 1,
            'material_id' => 4,
            'quantity' => 1,
        ]);
        // Seed 1
        DB::table('material__trainings')->insert([
            'training_id' => 3,
            'material_id' => 5,
            'quantity' => 1,
        ]);
        // Seed 1
        DB::table('material__trainings')->insert([
            'training_id' => 4,
            'material_id' => 5,
            'quantity' => 1,
        ]);
        // Seed 1
        DB::table('material__trainings')->insert([
            'training_id' => 4,
            'material_id' => 5,
            'quantity' => 1,
        ]);
    }
}
