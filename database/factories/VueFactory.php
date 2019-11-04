<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Vue;
use Faker\Generator as Faker;

$factory->define(Vue::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'total' => $faker->randomFloat($nbMaxDecimals = 2, $min = 100.00, $max = 1000.00)
    ];
});
