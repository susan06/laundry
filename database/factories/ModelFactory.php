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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Faq::class, function ($faker) {
    return [
        'question'      => $faker->sentence,
        'answer'        => $faker->paragraph($nbSentences = 20, $variableNbSentences = true),
        'created_by'    => 1,
        'created_at'    => \Carbon\Carbon::now(),    
    ];
});

$factory->define(App\ServiceBranchOffice::class, function ($faker) {
    return [
        'branch_office_id'      => App\BranchOffice::all()->random()->id,
        'name'                  => $faker->sentence,
        'price'                 => $faker->randomNumber(3),
        'status'                => 'Available',
        'created_at'            => \Carbon\Carbon::now(),    
    ];
});
