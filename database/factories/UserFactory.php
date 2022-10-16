<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use App\User;
use App\Document;
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
    return [
        'name' => $faker->name,
        'type' => 'User',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt("123456"),
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'Admin', [
        'name' => 'Amikof Stone Admin',
        'type' => 'Admin',
        'email' => 'amikof.stone@gmail.com',
        'password' => bcrypt("123"),
]);


$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'details' => $faker->sentence,
        'created_by' => rand(1, 10)
    ];
});

$factory->define(Document::class, function (Faker $faker) {

    return [
        'coddoc' => $faker->name,
        'descrip' => $faker->name,
        'ctacompra' => $faker->name,
        'ctaventa' => $faker->name,
        'aux0001' => $faker->name,
        'aux0002' => $faker->name,
        'aux0003' => $faker->name,
        'aux0004' => $faker->name,
        'aux0005' => $faker->name,
        'created_by' => rand(1, 10)
    ];
});

$factory->state(Document::class, 'Coddoc', [
    'coddoc' => 'RQ',
    'descrip' => 'Requerimiento de compras',
]);


 