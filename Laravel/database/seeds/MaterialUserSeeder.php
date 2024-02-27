<?php

use Illuminate\Database\Seeder;

class MaterialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //user 4-9
        //seed material_user table

        DB::table('material_users')->insert([
            'material_id' => 12,
            'user_id' => 4,
            'size_id' => 33,
            'quantity' => 1,
            'delivery_date' => '2021-01-01',
            'delivered_all' => false,
        ]);
        DB::table('material_users')->insert([
            'material_id' => 13,
            'user_id' => 18,
            'size_id' => 33,
            'quantity' => 1,
            'delivery_date' => '2021-01-01',
            'delivered_all' => false,
        ]);
        DB::table('material_users')->insert([
            'material_id' => 14,
            'user_id' => 21,
            'size_id' => 30,
            'quantity' => 1,
            'delivery_date' => '2021-01-01',
            'delivered_all' => false,
        ]);
        DB::table('material_users')->insert([
            'material_id' => 17,
            'user_id' => 17,
            'size_id' => 33,
            'quantity' => 1,
            'delivery_date' => '2021-01-01',
            'delivered_all' => false,
        ]);

        DB::table('material_users')->insert([
            'material_id' => 16,
            'user_id' => 17,
            'size_id' => 29,
            'quantity' => 1,
            'delivery_date' => '2021-01-01',
            'delivered_all' => false,
        ]);

        DB::table('material_users')->insert([
            'material_id' => 9,
            'user_id' => 24,
            'size_id' => 28,
            'quantity' => 1,
            'delivery_date' => '2021-01-01',
            'delivered_all' => false,
        ]);
        DB::table('material_users')->insert([
            'material_id' => 15,
            'user_id' => 4,
            'size_id' => 29,
            'quantity' => 1,
            'delivery_date' => '2021-01-01',
            'delivered_all' => false,
        ]);

        DB::table('material_users')->insert([
            'material_id' => 18,
            'user_id' => 17,
            'size_id' => 27,
            'quantity' => 1,
            'delivery_date' => '2021-01-01',
            'delivered_all' => true,
        ]);

        DB::table('material_users')->insert([
            'material_id' => 18,
            'user_id' => 16,
            'size_id' => 10,
            'quantity' => 1,
            'delivery_date' => '2021-01-01',
            'delivered_all' => true,
        ]);
    }
}
