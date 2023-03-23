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
        // parent menu
        UserMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '1',
            'name'          => 'Manajemen User',
            'slug'          => 'manajemen-user.html',
            'icon'          => 'fa-fw fas fa-users-cog',
            'prefix'        => 'management',
            'url'           => '#',
        ]);

        UserMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '2',
            'name'          => 'Master',
            'slug'          => 'master.html',
            'icon'          => 'fa-fw fas fa-th',
            'prefix'        => 'master',
            'url'           => '#',
        ]);

        UserMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '2',
            'name'          => 'Blog',
            'slug'          => 'blog.html',
            'icon'          => 'fa-fw fas fa-file',
            'prefix'        => 'blog',
            'url'           => '/blog',
        ]);
    }
}