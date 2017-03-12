<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Carbon\Carbon;

$localeFaker = Faker\Factory::create('nl_NL');

$factory->define(App\User::class, function (Faker\Generator $faker) use ($localeFaker) {
    return [
        'name' => $localeFaker->name,
        'email' => $localeFaker->email,
        'password' => bcrypt(str_random(10)),
        'avatar' => 'placeholder.png',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) use ($localeFaker) {
    return [
        'title' => substr($localeFaker->sentence(rand(2, 5)), 0, -1),
        'slug' => $localeFaker->slug,
        'image' => 'placeholder.png',
        'highlighted' => $localeFaker->numberBetween(0, 1),
        'active' => $localeFaker->numberBetween(0, 1),
        'tags' => implode(",", $localeFaker->words(rand(2, 6))),
        'content' => implode(" ", $localeFaker->paragraphs(rand(1, 5))),
        'user_id' => \App\User::orderByRaw("RAND()")->first()->id,
        'category_id' => \App\ArticleCategory::orderByRaw("RAND()")->first()->id,
    ];
});

$factory->define(App\ArticleCategory::class, function (Faker\Generator $faker) use ($localeFaker) {
    return [
        'name' => substr($localeFaker->sentence(rand(1, 2)), 0, -1),
        'slug' => $localeFaker->slug,
    ];
});

$factory->define(App\Content::class, function (Faker\Generator $faker) use ($localeFaker) {
    return [
        'title' => substr($localeFaker->sentence(rand(2, 5)), 0, -1),
        'slug' => $localeFaker->slug,
        'menu_text' => implode(" ", $localeFaker->words(rand(1, 2))),
        'content' => implode(" ", $localeFaker->paragraphs(rand(2, 4))),
    ];
});
