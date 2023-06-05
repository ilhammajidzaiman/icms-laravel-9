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
        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '1',
            'order'                 => '1',
            'name'                  => 'Status',
            'slug'                  => 'status',
            'icon'                  => 'bi bi-toggles',
            'prefix'                => 'management',
            'url'                   => '/management/status',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '1',
            'order'                 => '2',
            'name'                  => 'Level',
            'slug'                  => 'level',
            'icon'                  => 'bi bi-star',
            'prefix'                => 'management',
            'url'                   => '/management/level',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '1',
            'order'                 => '3',
            'name'                  => 'Menu',
            'slug'                  => 'menu',
            'icon'                  => 'bi bi-list',
            'prefix'                => 'management',
            'url'                   => '/management/menu',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '1',
            'order'                 => '4',
            'name'                  => 'Akses',
            'slug'                  => 'access',
            'icon'                  => 'bi bi-shield-lock',
            'prefix'                => 'management',
            'url'                   => '/management/access',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '1',
            'order'                 => '5',
            'name'                  => 'User',
            'slug'                  => 'user',
            'icon'                  => 'bi bi-people',
            'prefix'                => 'management',
            'url'                   => '/management/user',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '3',
            'order'                 => '1',
            'name'                  => 'Status',
            'slug'                  => 'status',
            'icon'                  => 'bi bi-toggles',
            'prefix'                => 'blog',
            'url'                   => '/blog/status',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '3',
            'order'                 => '2',
            'name'                  => 'kategori',
            'slug'                  => 'kategori',
            'icon'                  => 'bi bi-tags',
            'prefix'                => 'blog',
            'url'                   => '/blog/category',
        ]);

        UserMenuChild::create([
            'uuid'                  => Str::uuid(),
            'user_menu_parent_id'   => '3',
            'order'                 => '3',
            'name'                  => 'post',
            'slug'                  => 'post',
            'icon'                  => 'bi bi-files',
            'prefix'                => 'blog',
            'url'                   => '/blog/post',
        ]);
    }
}
