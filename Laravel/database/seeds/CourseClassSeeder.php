<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('course_classes')->insert([
            'description' => 'GRSI0922',
            'course_id' => 1,
        ]);

        // Seed 2
        DB::table('course_classes')->insert([
            'description' => 'MAPCP0223',
            'course_id' => 2,
            ]);

        // Seed 3
        DB::table('course_classes')->insert([
            'description' => 'TM0123',
            'course_id' => 3,
            ]);

        // Seed 4
        DB::table('course_classes')->insert([
            'description' => 'TS0124',
            'course_id' => 4,
        ]);

        // Seed 5
        DB::table('course_classes')->insert([
            'description' => 'TPSI0922',
            'course_id' => 5,
        ]);
    }
}
