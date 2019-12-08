<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// $factory->define(User::class, function (Faker $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'email_verified_at' => now(),
//         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//         'remember_token' => Str::random(10),
//     ];
// });

$factory->define(Category::class, function (Faker $faker) {
    return [
        'cat_name' => $faker->word,
        'created_at' => $faker->dateTime($max = 'now', $timezone = null),
        'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
    ];
});

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_title' => $faker->word,
        'post_body' => $faker->paragraph($nbSentences = 200, $variableNbSentences = true),
        'is_featured' => $faker->boolean,
        'archive' => $faker->boolean,
        'user_id' => 1,
        'image_path' => Str::random(10),
        'created_at' => $faker->dateTime($max = 'now', $timezone = null),
        'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
        'category_id'=>Category::all()->random(),
        'is_pinned'=>$faker->boolean(),
    ];
});
