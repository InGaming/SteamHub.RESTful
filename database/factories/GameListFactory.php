<?php

use Faker\Generator as Faker;
use App\Model\Api\V3\Game\GameList;

/** @var \phpDocumentor\Reflection\DocBlock\Tags\Method $factory */
$factory->define(GameList::class, function (Faker $faker) {
    return [
        'appid' => rand(),
        'free'  => rand(0,1),
        'name' => $faker->name,
        'chinese_name' => $faker->name,
        'metacritic_score' => rand(1, 100),
        'steam_user_score' => rand(1, 100),
        'detailed_description' => $faker->text(),
        'short_description' => $faker->text(),
        'platforms' => 'windows|mac|linux|',
        'released_at' => $faker->dateTimeThisMonth(),
    ];
});
