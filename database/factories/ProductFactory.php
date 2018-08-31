<?php

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->name,
        "price" => $faker->randomNumber(2),
        "category_id" => factory('App\ProductCategory')->create(),
        "serviceprovider_id" => factory('App\User')->create(),
    ];
});
