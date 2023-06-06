<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            StatusSeeder::class,
            // 
            UserStatusSeeder::class,
            UserLevelSeeder::class,
            UserSeeder::class,
            UserMenuParentSeeder::class,
            UserMenuChildSeeder::class,
            UserAccessParentSeeder::class,
            UserAccessChildSeeder::class,
            // 
            SlideshowSeeder::class,
            // 
            BlogStatusSeeder::class,
            BlogCategorySeeder::class,
            BlogArticleSeeder::class,
            // 
            NavMenuParentSeeder::class,
        ]);
    }
}
