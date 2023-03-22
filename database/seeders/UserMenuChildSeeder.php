<?php

namespace Database\Seeders;

use App\Models\UserMenuChild;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserMenuChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // child menu
        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '1',
            'order'                 => '1',
            'name'                  => 'Status',
            'slug'                  => 'status.html',
            'icon'                  => 'fa-fw fas fa-check',
            'prefix'                => 'management',
            'url'                   => '/management/status',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '1',
            'order'                 => '2',
            'name'                  => 'Level',
            'slug'                  => 'level.html',
            'icon'                  => 'fa-fw fas fa-star',
            'prefix'                => 'management',
            'url'                   => '/management/level',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '1',
            'order'                 => '3',
            'name'                  => 'Menu',
            'slug'                  => 'menu.html',
            'icon'                  => 'fa-fw fas fa-list',
            'prefix'                => 'management',
            'url'                   => '/management/menu',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '1',
            'order'                 => '4',
            'name'                  => 'Akses',
            'slug'                  => 'access.html',
            'icon'                  => 'fa-fw fas fa-shield-alt',
            'prefix'                => 'management',
            'url'                   => '/management/access',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '1',
            'order'                 => '5',
            'name'                  => 'User',
            'slug'                  => 'user.html',
            'icon'                  => 'fa-fw fas fa-users',
            'prefix'                => 'management',
            'url'                   => '/management/user',
        ]);
    }
}
