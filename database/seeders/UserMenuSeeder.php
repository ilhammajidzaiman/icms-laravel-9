<?php

namespace Database\Seeders;

use App\Models\UserMenu;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // parent menu
        UserMenu::create([
            'id'            => '1',
            'uuid'          => Str::uuid(),
            'parent_id'     => '0',
            'order'         => '1',
            'name'          => 'Manajemen User',
            'slug'          => 'manajemen-user.html',
            'icon'          => 'fa-fw fas fa-users-cog',
            'prefix'        => 'management',
            'url'           => '#',
        ]);

        UserMenu::create([
            'id'            => '2',
            'uuid'          => Str::uuid(),
            'parent_id'     => '0',
            'order'         => '2',
            'name'          => 'Master',
            'slug'          => 'master.html',
            'icon'          => 'fa-fw fas fa-th',
            'prefix'        => 'master',
            'url'           => '#',
        ]);

        // child menu
        UserMenu::create([
            'uuid'          => Str::uuid(),
            'parent_id'     => '1',
            'order'         => '1',
            'name'          => 'Status',
            'slug'          => 'status.html',
            'icon'          => 'fa-fw fas fa-check',
            'prefix'        => 'management',
            'url'           => '/management/status',
        ]);

        UserMenu::create([
            'uuid'          => Str::uuid(),
            'parent_id'     => '1',
            'order'         => '2',
            'name'          => 'Level',
            'slug'          => 'level.html',
            'icon'          => 'fa-fw fas fa-star',
            'prefix'        => 'management',
            'url'           => '/management/level',
        ]);

        UserMenu::create([
            'uuid'          => Str::uuid(),
            'parent_id'     => '1',
            'order'         => '3',
            'name'          => 'Menu',
            'slug'          => 'menu.html',
            'icon'          => 'fa-fw fas fa-list',
            'prefix'        => 'management',
            'url'           => '/management/menu',
        ]);

        UserMenu::create([
            'uuid'          => Str::uuid(),
            'parent_id'     => '1',
            'order'         => '4',
            'name'          => 'Akses',
            'slug'          => 'access.html',
            'icon'          => 'fa-fw fas fa-shield-alt',
            'prefix'        => 'management',
            'url'           => '/management/access',
        ]);

        UserMenu::create([
            'uuid'          => Str::uuid(),
            'parent_id'     => '1',
            'order'         => '5',
            'name'          => 'User',
            'slug'          => 'user.html',
            'icon'          => 'fa-fw fas fa-users',
            'prefix'        => 'management',
            'url'           => '/management/user',
        ]);
    }
}
