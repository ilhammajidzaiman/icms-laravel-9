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
            'slug'          => 'konfigurasi.html',
            'icon'          => 'fa-fw fas fa-cog',
            'prefix'        => 'config',
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
            'prefix'        => 'master',
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
            'prefix'        => 'user',
            'url'           => '/user',
        ]);

        // child menu

        UserMenu::create([
            'uuid'          => Str::uuid(),
            'parent_id'     => '2',
            'order'         => '1',
            'name'          => 'Status',
            'slug'          => 'status.html',
            'icon'          => 'fa-fw fas fa-check',
            'prefix'        => 'master',
            'url'           => '/master/status',
        ]);

        UserMenu::create([
            'uuid'          => Str::uuid(),
            'parent_id'     => '2',
            'order'         => '2',
            'name'          => 'Level',
            'slug'          => 'level.html',
            'icon'          => 'fa-fw fas fa-star',
            'prefix'        => 'master',
            'url'           => '/master/level',
        ]);

        UserMenu::create([
            'uuid'          => Str::uuid(),
            'parent_id'     => '2',
            'order'         => '3',
            'name'          => 'Menu',
            'slug'          => 'menu.html',
            'icon'          => 'fa-fw fas fa-list',
            'prefix'        => 'master',
            'url'           => '/master/menu',
        ]);

        UserMenu::create([
            'uuid'          => Str::uuid(),
            'parent_id'     => '2',
            'order'         => '4',
            'name'          => 'Akses',
            'slug'          => 'access.html',
            'icon'          => 'fa-fw fas fa-shield-alt',
            'prefix'        => 'master',
            'url'           => '/master/access',
        ]);
    }
}
