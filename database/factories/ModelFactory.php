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

$factory->define(App\Shoe::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'customer_id' => function () {
            return factory('App\Customer')->create()->id;
        },
        'shoes_id' => function () {
            return factory('App\Shoe')->create()->id;
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

$factory->define(App\Supplier::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->postcode,
        'address' => $faker->address,
        'contact_person' => $faker->name,
        'contact_information' => $faker->sentence
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'supplier_id' => function () {
            return factory('App\Supplier')->create()->id;
        },
        'barcode' => $faker->unique()->postcode,
        'description' => $faker->sentence,
        'price' => $faker->numberBetween(1, 100),
        'quantity' => $faker->numberBetween(1, 100)
    ];
});


$factory->define(App\Locker::class, function () {
    return [
        'order_id' => function () {
            return factory('App\Order')->create()->id;
        },
        'status' => array_rand(config('locker.status'),1),
        'type' => array_rand(config('locker.type'),1),
    ];
});
