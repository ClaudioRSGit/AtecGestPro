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
        $this->call(UserSeeder::class);
        $this->call(NotificationUserSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(ActionSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(TechnicianTicketSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(TicketHistorySeeder::class);
        $this->call(EmailSeeder::class);
        $this->call(ClothingDeliverySeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(MaterialClothingDeliverySeeder::class);
        $this->call(TrainingSeeder::class);
        $this->call(MaterialTrainingSeeder::class);


    }
}
