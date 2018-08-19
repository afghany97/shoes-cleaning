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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Shoes::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'customer_id' => function () {
            return factory('App\Customer')->create()->id;
        },
        'shoes_id' => function(){
            return factory('App\Shoes')->create()->id;
        },
        'price' => $faker->numberBetween(1, 100),
        'image_path' => $faker->imageUrl(),
        'delivery_date' => $faker->date()
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'mobile' => $faker->phoneNumber
    ];
});
