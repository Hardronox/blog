<?php


$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Articles::class, function (Faker\Generator $faker) {
	$title=$faker->name;

	$strings = array(
		'free',
		'premium',
	);
	$key = array_rand($strings);

	return [
		'user_id' => 1,
		'title' => $title,
		'slug' => str_slug($title),
		'description' => $faker->realText(200),
		'image' => "images/articles/no-image.png",
		'text' => $faker->realText(4000),
		'status' => 'published',
		'category_id' => rand(1,3),
		'premium' => $strings[$key],
	];
});