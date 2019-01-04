<?php

use Faker\Generator as Faker;
use App\Model\Game\GameReview;

/** @var \phpDocumentor\Reflection\DocBlock\Tags\Method $factory */
$factory->define(GameReview::class, function (Faker $faker) {
    return [
        'appid' => rand(),
        'score'  => rand(1, 100),
        'count' => rand(1, 100),
        'summary' => $faker->text
    ];
});
