<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
	$last_name = $faker->name;
	$first_name = $faker->name;
	$middle_name = $faker->name;
	$extension_name = $faker->randomElement(array('Jr','Sr'));
	$complete_name = $first_name ." ". $middle_name ." ". $last_name." ". $extension_name;
    return [
        'first_name'  =>$first_name,
		'last_name' => $last_name,
        'middle_name'  => $middle_name,
		'extension_name'  => $extension_name,
        'complete_name'  => $complete_name,
		'acc_lvl'  => $faker->randomElement(array('Administrator','User')),
		'office' => $faker->randomElement(array('J1','J2','J3','J4','J5')),
		'picture'  => $faker->randomElement(array('profile.jpg')),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
