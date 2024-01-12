<?php

use Illuminate\Database\Seeder;

class MaterialSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $sizes = DB::table('sizes')->get();

        foreach ($sizes as $size) {
            if (!is_numeric($size->size)) {
                for ($material_id = 5; $material_id < 10; $material_id++) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 10,
                    ]);
                }
            }
        }

        foreach ($sizes as $size) {
            if (is_numeric($size->size) && $size->size >= 34 && $size->size <= 66 && $size->size % 2 === 0) {
                foreach ([10, 15] as $material_id) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 10,
                    ]);
                }
            }
        }


        foreach ($sizes as $size) {
            if (is_numeric($size->size) && $size->size >= 35 && $size->size <= 47) {
                foreach ([11, 16, 20] as $material_id) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 10,
                    ]);
                }
            }
        }


        foreach ($sizes as $size) {
            if (!is_numeric($size->size)) {
                for ($material_id = 18; $material_id < 20; $material_id++) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 10,
                    ]);
                }
            }
        }



    }
}
