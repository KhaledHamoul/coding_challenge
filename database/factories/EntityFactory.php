<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Entity;
use Faker\Generator as Faker;

$factory->define(Entity::class, function (Faker $faker) {
    return [
        'fieldType' => $faker->randomElement(['SUBJECT','VISIT','SAMPLE']),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
