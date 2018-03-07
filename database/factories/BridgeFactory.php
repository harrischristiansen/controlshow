<?php
/*
	Bridge Factory for creating test Bridge objects
	Project: Show Controller - github.com/harrischristiansen/controlshow
	File Created by Harris Christiansen (Code@HarrisChristiansen.com)
*/

use Faker\Generator as Faker;

$factory->define(App\Models\Bridge::class, function (Faker $faker) {
    return [
        'name' => "Bridge ".$faker->name,
        'ipaddr' => $faker->ipv4,
        'apikey' => $faker->creditCardNumber,
    ];
});
