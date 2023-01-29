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
            'name'          => 'Konfigurasi',
            'slug'          => 'config.html',
            'icon'          => 'fa-fw fas fa-cog',
            'url'           => '/config',
        ]);

        UserMenu::create([
            'id'            => '2',
            'uuid'          => Str::uuid(),
            'parent_id'     => '0',
            'order'         => '2',
            'name'          => 'Master',
            'slug'          => 'master.html',
            'icon'          => 'fa-fw fas fa-th',
            'url'           => '#',
        ]);

        UserMenu::create([
            'id'            => '3',
            'uuid'          => Str::uuid(),
            'parent_id'     => '0',
            'order'         => '3',
            'name'          => 'User',
            'slug'          => 'user.html',
            'icon'          => 'fa-fw fas fa-users',
            'url'           => '/user',
        ]);

        // child menu

        UserMenu::create([
            'id'            => '4',
            'uuid'          => Str::uuid(),
            'parent_id'     => '2',
            'order'         => '1',
            'name'          => 'Status',
            'slug'          => 'status.html',
            'icon'          => 'fa-fw fas fa-check',
            'url'           => '/master/status',
        ]);

        UserMenu::create([
            'id'            => '5',
            'uuid'          => Str::uuid(),
            'parent_id'     => '2',
            'order'         => '2',
            'name'          => 'Level',
            'slug'          => 'level.html',
            'icon'          => 'fa-fw fas fa-star',
            'url'           => '/master/level',
        ]);

        UserMenu::create([
            'id'            => '6',
            'uuid'          => Str::uuid(),
            'parent_id'     => '2',
            'order'         => '3',
            'name'          => 'Menu',
            'slug'          => 'menu.html',
            'icon'          => 'fa-fw fas fa-list',
            'url'           => '/master/menu',
        ]);

        UserMenu::create([
            'id'            => '7',
            'uuid'          => Str::uuid(),
            'parent_id'     => '2',
            'order'         => '4',
            'name'          => 'Akses',
            'slug'          => 'access.html',
            'icon'          => 'fa-fw fas fa-shield-alt',
            'url'           => '/master/access',
        ]);
    }
}
