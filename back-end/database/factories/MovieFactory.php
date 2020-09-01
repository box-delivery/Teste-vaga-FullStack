<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Movie::class, function (Faker $faker) {
    return [
        "codigo" => $faker->randomNumber(),
        "title" => $faker->title,
        "original_title" => $faker->title,
        "overview" => $faker->text,
        "poster_path" => $faker->imageUrl()
    ];
});
