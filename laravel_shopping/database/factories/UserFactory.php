<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
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
    $password = Hash::make('123456');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => $password,
        'title' => $faker->text(10),
        'gender' => User::FEMALE,
        'avatar_url' => $faker->url,
        'avatar_name' => $faker->text(5),
        'education' => Str::random(10),
        'location' => Str::random(10),
        'skills' => $faker->text(10),
        'note' => $faker->text(15),
        'birthday' => $faker->date(),
        'is_active' => User::ACTIVE,
        'phone' => $faker->phoneNumber,
        'slug' => Str::slug($faker->name),
        'remember_token' => Str::random(10),
    ];
});
