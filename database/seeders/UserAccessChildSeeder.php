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
        // level developer...
        // sub menu management...
        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '1',
            'order'                 => '1',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '2',
            'order'                 => '2',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '3',
            'order'                 => '3',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '4',
            'order'                 => '4',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '5',
            'order'                 => '5',
        ]);

        // level developer...
        // sub menu blog...
        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '3',
            'user_menu_child_id'    => '6',
            'order'                 => '1',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '3',
            'user_menu_child_id'    => '7',
            'order'                 => '2',
        ]);





        // level admin...
        // sub menu management...
        UserAccessChild::create([
            'user_level_id'         => '2',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '4',
            'order'                 => '4',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '2',
            'user_menu_parent_id'   => '1',
            'user_menu_child_id'    => '5',
            'order'                 => '5',
        ]);

        // level admin...
        // sub menu blog...
        UserAccessChild::create([
            'user_level_id'         => '2',
            'user_menu_parent_id'   => '3',
            'user_menu_child_id'    => '6',
            'order'                 => '1',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '2',
            'user_menu_parent_id'   => '3',
            'user_menu_child_id'    => '7',
            'order'                 => '2',
        ]);





        // level user...
        // sub menu blog...
        UserAccessChild::create([
            'user_level_id'         => '3',
            'user_menu_parent_id'   => '3',
            'user_menu_child_id'    => '6',
            'order'                 => '1',
        ]);

        UserAccessChild::create([
            'user_level_id'         => '3',
            'user_menu_parent_id'   => '3',
            'user_menu_child_id'    => '7',
            'order'                 => '2',
        ]);
    }
}
