<?php

use Faker\Generator as Faker;
use App\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->word(4),
        'description' => $faker->realText(300),
        'user_id' => $faker->numberBetween(1, 2)
    ];
});
