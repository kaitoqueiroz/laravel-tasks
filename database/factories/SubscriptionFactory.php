<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subscription;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Subscription::class, function (Faker $faker) {
    $dayIteration = $faker->numberBetween(5,30);
    $startDate = \DateTime::createFromFormat('Y-m-d', '2020-01-01');

    return [
        'customer_id' => $faker->numberBetween(1,5),
        'start_date' => $startDate->format('Y-m-d'),
        'next_order_date' => $startDate->modify('+'. $dayIteration .' day')->format('Y-m-d'),
        'day_iteration' => $dayIteration,
        'active' => $faker->boolean(100),
    ];
});
