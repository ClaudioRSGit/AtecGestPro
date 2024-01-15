<?php

use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('notifications')->insert([
            'description' => 'Tem novo ticket aberto',
            'notification_type_id' => 1,
            'object_id' => 'email_123',
        ]);

        // Seed 2
        DB::table('notifications')->insert([
            'description' => 'O ticket 26365 foi fechado',
            'notification_type_id' => 1,
            'object_id' => 'email_653',
        ]);

        // Seed 3
        DB::table('notifications')->insert([
            'description' => 'Tem novos emails por ler',
            'notification_type_id' => 3,
            'object_id' => 'push_789',
        ]);

        // Seed 4
        DB::table('notifications')->insert([
            'description' => 'Tem novos emails por ler',
            'notification_type_id' => 2,
            'object_id' => 'sms_456',
        ]);

        // Seed 5
        DB::table('notifications')->insert([
            'description' => 'Tem alterações no ticket 20263',
            'notification_type_id' => 1,
            'object_id' => 'email_456',
        ]);
    }
}
