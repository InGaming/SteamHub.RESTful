<?php

use Faker\Generator as Faker;
use App\Model\Game\GamePrice;

/** @var \phpDocumentor\Reflection\DocBlock\Tags\Method $factory */
$factory->define(GamePrice::class, function (Faker $faker) {
    return [
        'appid' => rand(),
        'country'  => 'china',
        'final' => rand(1, 1000000),
        'initial' => rand(1, 1000000),
        'discount' => rand(1, 100),
    ];
});
