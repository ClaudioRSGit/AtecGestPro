<?php

use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('notification_types')->insert([
            'description' => 'Notificação por Email',
            'code' => 'EMAIL',
        ]);

        // Seed 2
        DB::table('notification_types')->insert([
            'description' => 'Notificação por SMS',
            'code' => 'SMS',
        ]);

        // Seed 3
        DB::table('notification_types')->insert([
            'description' => 'Notificação Push',
            'code' => 'PUSH',
        ]);


    }
}
