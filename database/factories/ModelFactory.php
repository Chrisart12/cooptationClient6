<?php

use App\User;
use App\Candidat;
use App\Categorie;
use App\Offre;
use App\Account;
use App\Like;
use App\Story;

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

// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->email,
//         'password' => bcrypt(str_random(10)),
//         'remember_token' => str_random(10),
//     ];

// });


$factory->define(App\Offre::class, function (Faker\Generator $faker) {
    return [
        'poste' => $faker->jobTitle,
        'lieu' => $faker->city,
        'reference' =>  $faker->ean13,
        'description' =>  $faker->text,
        'categorie_id' => $faker->numberBetween(1, 2),
        'user_id' => $faker->numberBetween(1, 3099),
    ];

});

$factory->define(App\Candidat::class, function (Faker\Generator $faker) {
    return [
        'lastName' => $faker->lastName,
        'firstName' => $faker->firstName,
        'poste' =>  $faker->jobTitle,
        'reference' => $faker->ean13,
        'offre_id' => $faker->numberBetween(1, 100),
    ];

});

$factory->define(App\Account::class, function (Faker\Generator $faker) {
    return [
       
        'user_id' => $faker->numberBetween(1, 3000),
        'candidat_id' => $faker->numberBetween(1, 100),
        'step_id' =>  1,
        'score' => 0,
    ];

});

$factory->define(App\Like::class, function (Faker\Generator $faker) {
    return [
       
        'user_id' => $faker->numberBetween(1, 3000),
        'story_id' => $faker->numberBetween(1, 31), 
    ];

});




