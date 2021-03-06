<?php

use Faker\Generator as Faker;
use App\Model\Game\GameList;

/** @var \phpDocumentor\Reflection\DocBlock\Tags\Method $factory */
$factory->define(GameList::class, function (Faker $faker) {
    return [
        'appid' => rand(),
        'free'  => rand(0,1),
        'age'  => rand(0,100),
        'type' => $faker->name,
        'name' => $faker->name,
        'chinese_name' => $faker->name,
        'price_final' => rand(1, 100),
        'price_initial' => rand(1, 100),
        'price_discount' => rand(1, 100),
        'metacritic_review_score' => rand(1, 100),
        'metacritic_review_link' => $faker->name,
        'steam_user_review_score' => rand(1, 100),
        'steam_user_review_count' => rand(1, 100),
        'steam_user_review_summary' => $faker->name,
        'detailed_description' => $faker->text(),
        'short_description' => $faker->text(),
        'languages' => '简体中文|英文',
        'platforms' => 'windows|mac|linux',
        'developers' => $faker->name,
        'publishers' => $faker->name,
        'released_at' => $faker->dateTimeThisMonth(),
    ];
});
