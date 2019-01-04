<?php

use Faker\Generator as Faker;
use App\Model\Game\GameTag;

/** @var \phpDocumentor\Reflection\DocBlock\Tags\Method $factory */
$factory->define(GameTag::class, function (Faker $faker) {
    return [
        'appid' => rand(),
        'tag'  => $faker->text,
        'language' => 'schinese',
    ];
});
