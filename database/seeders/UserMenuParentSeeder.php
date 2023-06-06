<?php

namespace Database\Seeders;

use App\Models\UserMenuParent;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserMenuParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '1',
            'name'          => 'Manajemen User',
            'slug'          => 'manajemen-user',
            'icon'          => 'bi bi-person-workspace',
            'prefix'        => 'management',
            'url'           => '#',
        ]);

        UserMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '2',
            'name'          => 'Slideshow',
            'slug'          => 'slideshow',
            'icon'          => 'bi bi-images',
            'prefix'        => 'slideshow',
            'url'           => '/slideshow',
        ]);

        UserMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '3',
            'name'          => 'Blog',
            'slug'          => 'blog',
            'icon'          => 'bi bi-files',
            'prefix'        => 'blog',
            'url'           => '#',
        ]);

        UserMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '4',
            'name'          => 'Halaman',
            'slug'          => 'halaman',
            'icon'          => 'bi bi-files-alt',
            'prefix'        => 'page',
            'url'           => '/page',
        ]);

        UserMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '5',
            'name'          => 'Nav Menu',
            'slug'          => 'nav-menu',
            'icon'          => 'bi bi-list-nested',
            'prefix'        => 'nav-menu',
            'url'           => '/nav-menu',
        ]);
    }
}
