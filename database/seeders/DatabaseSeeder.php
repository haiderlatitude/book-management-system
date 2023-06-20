<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Edition;
use App\Models\Genre;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(RoleAndPermissionSeeder::class);

        // Book::factory(10)->create();
        // Author::factory(10)->create();
        Category::factory(10)->create();
        // Edition::factory(10)->create();
        Genre::factory(2)->create();
        // Tag::factory(10)->create();

        $categories = Category::all();
        $genres = Genre::all();
        $genres[0]->categories()->save($categories[0]);
        $genres[0]->categories()->save($categories[1]);
        $genres[0]->categories()->save($categories[2]);
        $genres[0]->categories()->save($categories[3]);
        $genres[0]->categories()->save($categories[4]);
        $genres[1]->categories()->save($categories[5]);
        $genres[1]->categories()->save($categories[6]);
        $genres[1]->categories()->save($categories[7]);
        $genres[1]->categories()->save($categories[8]);
        $genres[1]->categories()->save($categories[9]);
    }
}
