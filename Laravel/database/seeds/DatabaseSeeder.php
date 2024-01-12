<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(MaterialSizeSeeder::class);
    }
}
