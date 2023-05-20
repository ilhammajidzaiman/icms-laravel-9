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
        // level developer...
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





        // level admin...
        UserAccessParent::create([
            'user_level_id'         => '2',
            'user_menu_parent_id'   => '1',
        ]);

        UserAccessParent::create([
            'user_level_id'         => '2',
            'user_menu_parent_id'   => '2',
        ]);

        UserAccessParent::create([
            'user_level_id'         => '2',
            'user_menu_parent_id'   => '3',
        ]);





        // level user...
        UserAccessParent::create([
            'user_level_id'         => '3',
            'user_menu_parent_id'   => '3',
        ]);
    }
}
