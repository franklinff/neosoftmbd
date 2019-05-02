<?php

use Faker\Generator as Faker;

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

$factory->define(App\MasterTenant::class, function (Faker $faker) {
    
    $users = App\MasterBuilding::all()->pluck('id')->toArray();

    return [
        'building_id' => $faker->randomElement($users),
        'flat_no' => $faker->numberBetween(113, 9895),
        'salutation' => 'Shri',
        'first_name' => $faker->firstName(),
        'middle_name' => $faker->firstName(),
        'last_name' => $faker->firstName(),
        'mobile' => $faker->phoneNumber,
        'email_id' => $faker->unique()->email,
        'use'  => 'Residential',
        'carpet_area' => $faker->numberBetween(310, 1000),
        'tenant_type' => $faker->numberBetween(1, 4),
    ];
});
