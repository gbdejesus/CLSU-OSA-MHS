<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Message;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'to' => rand(1,20),
        'from' => rand(1,30),
        'text' => $faker->sentence(),
    ];
});
