<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
  return [
    'first_name' => $faker->firstName() ,
    'last_name'  => $faker->lastName() ,
    'phone_1'    => $faker->phoneNumber(),
    'phone_2'    => $faker->phoneNumber(),
    'business'   => $faker->company() ,
    'email_1'    => $faker->freeEmail() ,
    'email_2'    => $faker->freeEmail() ,
    'reference'  => $faker->sentence(),
    'user_id'    => function ()
    {
      return factory(App\User::class)->states(\App\Enums\RoleType::ASSISTANT)->create()->id;
    },
  ];
});
