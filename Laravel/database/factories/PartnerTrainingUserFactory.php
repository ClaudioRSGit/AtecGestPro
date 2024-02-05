<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PartnerTrainingUser;
use Faker\Generator as Faker;

$factory->define(PartnerTrainingUser::class, function (Faker $faker) {
    return [

            'partner_id' => $faker->numberBetween(1, 5),
            'training_id' => $faker->numberBetween(1, 5),
            'user_id' => $faker->numberBetween(1, 5),
            'start_date' => $faker->dateTimeBetween('2024-01-01', '2024-12-31'),
            'end_date' => $faker->dateTimeBetween('2025-01-01', '2025-12-31'),

    ];
});
