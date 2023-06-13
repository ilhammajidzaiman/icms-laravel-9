<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserAccessParent;
use App\Models\UserAccessChild;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAccessParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // level developer 1...
        UserAccessParent::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '1',
        ]);
        UserAccessParent::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '2',
        ]);
        UserAccessParent::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '3',
        ]);
        UserAccessParent::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '4',
        ]);
        UserAccessParent::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '5',
        ]);
        UserAccessParent::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '6',
        ]);
        UserAccessParent::create([
            'user_level_id'         => '1',
            'user_menu_parent_id'   => '7',
        ]);

        // level admin 2...

        // level user 3...
    }
}
