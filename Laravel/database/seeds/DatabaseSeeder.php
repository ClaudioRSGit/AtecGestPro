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
        $this->call(PartnerSeeder::class);
        $this->call(PartnerContactSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(CourseClassSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(TicketStatusSeeder::class);
        $this->call(TicketCategorySeeder::class);
        $this->call(TicketPrioritySeeder::class);
        $this->call(NotificationTypeSeeder::class);
        $this->call(NotificationSeeder::class);


    }
}
