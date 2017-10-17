<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
  return [
    'name' => $faker->name() ,
    'address' => $faker->address(),
    'phone_1' => $faker->phoneNumber(),
    'phone_2' => $faker->phoneNumber(),
    'email' => $faker->freeEmail() ,
  ];
});
