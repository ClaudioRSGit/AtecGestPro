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
        //TPSI
        DB::table('course_materials')->insert([
            'course_id' => 1,
            'material_id' => 22,
        ]);

        DB::table('course_materials')->insert([
            'course_id' => 1,
            'material_id' => 23,
        ]);


        //GRSI
        DB::table('course_materials')->insert([
            'course_id' => 1,
            'material_id' => 22,
        ]);

        DB::table('course_materials')->insert([
            'course_id' => 1,
            'material_id' => 23,
        ]);


        //TS
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 19,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 13,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 16,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 17,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 18,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 19,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 4,
            'material_id' => 21,
        ]);


        //TM
        DB::table('course_materials')->insert([
            'course_id' => 3,
            'material_id' => 12,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 3,
            'material_id' => 15,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 3,
            'material_id' => 9,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 3,
            'material_id' => 10,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 3,
            'material_id' => 11,
        ]);


        //MA
        DB::table('course_materials')->insert([
            'course_id' => 2,
            'material_id' => 9,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 2,
            'material_id' => 10,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 2,
            'material_id' => 11,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 2,
            'material_id' => 12,
        ]);
        DB::table('course_materials')->insert([
            'course_id' => 2,
            'material_id' => 14,
        ]);
    }
}
