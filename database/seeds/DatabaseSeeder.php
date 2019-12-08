<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $category = 5;
        $posts = 100;

        factory(Category::class, $category)->create();
        factory(Post::class, $posts)->create();
    }
}
