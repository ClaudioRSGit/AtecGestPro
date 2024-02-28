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


        //materiais 5 a 9
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


        //materiais 18 e 19
        foreach ($sizes as $size) {
            if (!is_numeric($size->size)) {
                for ($material_id = 18; $material_id < 19; $material_id++) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 10,
                    ]);
                }
            }
        }

        //materiais 14 e 19 calças
        foreach ($sizes as $size) {
            if (is_numeric($size->size) && $size->size >= 34 && $size->size <= 66 && $size->size % 2 === 0) {
                foreach ([14, 19] as $material_id) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 10,
                    ]);
                }
            }
        }

        //material 20
        foreach ($sizes as $size) {
            if (is_numeric($size->size) && $size->size >= 34 && $size->size <= 46) {
                for ($material_id = 20; $material_id < 21; $material_id++) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 10,
                    ]);
                }
            }
        }


        //materiais 10 e 15
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



        //materiais 11 e 16

        foreach ($sizes as $size) {
            if (!is_numeric($size->size) && $size->size != "Tamanho único") {
                foreach ([11, 16] as $material_id) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 10,
                    ]);
                }
            }
        }

        //materiais 21

        foreach ($sizes as $size) {
            if (!is_numeric($size->size) && $size->size != "Tamanho único") {
                foreach ([21] as $material_id) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 3,
                    ]);
                }
            }
        }

        //materiais 22 e 23

        foreach ($sizes as $size) {
            if (!is_numeric($size->size) && $size->size != "Tamanho único") {
                foreach ([22, 23] as $material_id) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 5,
                    ]);
                }
            }
        }

        //materiail 15

        foreach ($sizes as $size) {
            if (!is_numeric($size->size) && $size->size != "Tamanho único") {
                foreach ([13] as $material_id) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 0,
                    ]);
                }
            }
        }



        //materiais tamanho unico

        foreach ($sizes as $size) {
            if ($size->size === "Tamanho único") {
                foreach ([12,13,14,17] as $material_id) {
                    DB::table('material_sizes')->insert([
                        'material_id' => $material_id,
                        'size_id' => $size->id,
                        'stock' => 5,
                    ]);
                }
            }
        }






    }
}


