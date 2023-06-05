<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserAccessChild;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAccessChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // level developer 1...
        // sub menu management...
        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '1',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '2',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '3',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '4',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '5',
        ]);

        // sub menu blog...
        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '3',
            'user_menu_child_id'    => '6',
        ]);
        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '3',
            'user_menu_child_id'    => '7',
        ]);
        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '3',
            'user_menu_child_id'    => '8',
        ]);

        // level admin 2...
        // level user 3...
    }
}
