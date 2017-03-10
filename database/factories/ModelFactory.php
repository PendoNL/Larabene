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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'avatar' => 'placeholder.png',
        'remember_token' => str_random(10),
    ];
});
//      'active', 'category_id', 'user_id', 'slug', 'date', 'title', 'image', 'content', 'tags', 'highlighted'
$factory->define(App\Article::class, function (Faker\Generator $faker) use ($factory){
    return [
        'title' => $faker->word,
        'slug' => $faker->slug,
        'image' => 'placeholder.png',
        'highlighted' => $faker->numberBetween(0,1),
        'active' => $faker->numberBetween(0,1),
        'user_id' =>  $factory->create('App\User')->id,
        'category_id' => $factory->create('App\ArticleCategory')->id,
        'date' => Carbon::now(),
        'tags' => $faker->word,
    ];
});
// name, slug

$factory->define(App\ArticleCategory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->slug,
    ];
});
$factory->define(App\Content::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'slug' => $faker->slug,
        'menu_text' => $faker->slug,
        'content' => $faker->slug,
    ];
});