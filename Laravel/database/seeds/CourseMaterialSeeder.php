<?php

use Illuminate\Database\Seeder;

class CourseMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed 1 e 5 tpsi grsi

        DB::table('course_materials')->insert([
            'course_id' => 1,
            'material_id' => 18,
        ]);

        DB::table('course_materials')->insert([
            'course_id' => 1,
            'material_id' => 19,
        ]);


        //grsi
        DB::table('course_materials')->insert([
            'course_id' => 5,
            'material_id' => 18,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 5,
            'material_id' => 19,
        ]);


        //TS
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 19,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 12,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 13,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 14,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 15,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 16,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 17,
        ]);


        //Mecatronica
        DB::table('course_materials')->insert([
            'course_id' => 3,
            'material_id' => 5,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 3,
            'material_id' => 6,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 3,
            'material_id' => 8,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 3,
            'material_id' => 10,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 3,
            'material_id' => 11,
        ]);


        //Mecatronica automovel
        DB::table('course_materials')->insert([
            'course_id' => 2,
            'material_id' => 5,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 2,
            'material_id' => 6,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 2,
            'material_id' => 8,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 2,
            'material_id' => 10,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 2,
            'material_id' => 11,
        ]);
    }
}
