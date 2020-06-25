<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Autopark;
use Faker\Generator as Faker;

$factory->define(Autopark::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'adress' => $faker->unique()->address
    ];
});
