<?php

use Faker\Generator as Faker;
use App\Model\Game\GameHot;

/** @var \phpDocumentor\Reflection\DocBlock\Tags\Method $factory */
$factory->define(Hot::class, function (Faker $faker) {
    return [
        'appid' => rand(),
        'name'  => $faker->name,
        'current' => rand(1, 1000000),
        'total' => rand(1, 1000000),
    ];
});
