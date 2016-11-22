<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Blog::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->name,
        'description' => $faker->realText(200),
        'text' => $faker->realText(4000),
        'image' => 'no_image.png',
        'status' => 'Published',
        'category_id' => 3,

    ];
});