<?php

use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert([
            'name' => 'Sapato de segurança',
            'description' => 'Sapato de segurança',
            'isInternal' => 1,
            'quantity' => 10,
            'aquisition_date' => '2020-01-09 21:04:24',
            'supplier' => '',
            'isClothing' => 1,
            'gender' => null,

        ]);

        $sizes = ['34','35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45',
            '46', '47', '48', '50', '52', '54', '56', '58', '60', '62', '64', '66',
            'XS','S','M', 'L', 'XL', 'XXL', 'XXXL', 'XXXXL'];

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'size' => $size,

            ]);
        }

    }
}
