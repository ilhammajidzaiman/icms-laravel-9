<?php

namespace Database\Seeders;

use App\Models\UserMenu;
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
    }
}
