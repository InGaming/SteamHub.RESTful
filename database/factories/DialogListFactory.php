<?php

use Faker\Generator as Faker;
use App\Model\Dota\Zhushou\DialogList;

/** @var \phpDocumentor\Reflection\DocBlock\Tags\Method $factory */
$factory->define(DialogList::class, function (Faker $faker) {
    return [
        'name'  =>  $faker->name,
        'message'  => $faker->text,
    ];
});
