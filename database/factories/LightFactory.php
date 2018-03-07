<?php
/*
	Light Factory for creating test Light objects
	Project: Show Controller - github.com/harrischristiansen/controlshow
	File Created by Harris Christiansen (Code@HarrisChristiansen.com)
*/

use Faker\Generator as Faker;

$factory->define(App\Models\Light::class, function (Faker $faker) {
    return [
        'name' => "Light ".$faker->randomNumber(6),
        'bridge_id' => App\Models\Bridge::all()->random()->id,
        'lightID' => $faker->randomNumber(3),
        'type' => $faker->randomElement(['circle','square','box_tall','box_wide']),
        'loc_x' => $faker->randomFloat(7, 0, 1),
        'loc_y' => $faker->randomFloat(7, 0, 1),
    ];
});
