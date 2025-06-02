<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            Setting\SiteSeeder::class,
            Media\FileCategorySeeder::class,
            Media\FileSeeder::class,
            Media\CarouselSeeder::class,
            Media\ImageSeeder::class,
            Media\VideoSeeder::class,
            Post\BlogCategorySeeder::class,
            Post\BlogTagSeeder::class,
            Post\BlogArticleSeeder::class,
            Post\PageSeeder::class,
            Post\LinkSeeder::class,
            // Post\NavMenuSeeder::class,
            Feature\PeoplePositionSeeder::class,
            Feature\PeopleSeeder::class,
            Feature\FeedbackCategorySeeder::class,
        ]);
    }
}
