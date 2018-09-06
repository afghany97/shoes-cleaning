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
        'shoes_id' => function () {
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

$factory->state(App\User::class, 'testing', [
    'name' => 'afghany-testing',
    'email' => 'afghany-testing@admin.com',
    'password' => bcrypt('secret'),
    'remember_token' => str_random(10),
]);

$factory->state(App\Order::class, 'testing', function (Faker\Generator $faker) {
    return [
        'customer_id' => function () {
            return factory('App\Customer')->state('testing')->create()->id;
        },
        'shoes_id' => function () {
            return factory('App\Shoes')->state('testing')->create()->id;
        },
        'price' => 199,
        'delivery_date' => $faker->date(),
        'image_path' => $faker->image('public/storage/images', 300, 400, null, false)
    ];
});

$factory->state(App\Shoes::class, 'testing', [
    'type' => "shoes-testing",
]);

$factory->state(App\Order::class, 'create-order-testing', function (Faker\Generator $faker) {
    return [
        'mobile' => 12345678910,
        'address' => 'cairo-testing',
        'name' => 'afghany-testing',
        'price' => 199999,
        'image' => "images/fXGskLPaOJwEZasfsaftesting8ESkepeMgtlOVQoXUhOhRvbIdvT.jpeg",
        'delivery_date' => '2018-8-2018'
    ];
});

$factory->state(App\Customer::class, 'testing', [
    'name' => "customer-name-testing",
    'address' => "customer-address-testing",
    'mobile' => 12345678910
]);

$factory->define(App\Supplier::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->postcode,
        'address' => $faker->address,
        'contact_person' => $faker->name,
        'contact_information' => $faker->sentence
    ];
});

$factory->state(App\Supplier::class, 'testing', [
    'name' => "supplier name testing",
    'address' => "supplier address testing",
    'code' => 'supplier code testing',
    'contact_person' => 'contact person testing',
    'contact_information' => 'information about contact to this supplier'
]);


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

$factory->state(App\Product::class, 'testing', [
    'supplier_id' => function () {
        return factory('App\Supplier')->state('testing')->create()->id;
    },
    'description' => "product address testing",
    'barcode' => 'product code testing',
    'price' => 99,
    'quantity' => 1
]);
