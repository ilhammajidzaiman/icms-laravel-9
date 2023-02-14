<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserAccessParent;
use App\Models\UserAccessChild;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // super admin access
        UserAccessParent::create([
            'level_id'  => '1',
            'parent_id' => '1',
            'order'     => '1',
        ]);

        UserAccessParent::create([
            'level_id'  => '1',
            'parent_id' => '2',
            'order'     => '2',
        ]);

        UserAccessParent::create([
            'level_id'  => '1',
            'parent_id' => '3',
            'order'     => '3',
        ]);

        // admin access
        UserAccessParent::create([
            'level_id'  => '2',
            'parent_id' => '2',
            'order'     => '2',
        ]);

        UserAccessParent::create([
            'level_id'  => '2',
            'parent_id' => '3',
            'order'     => '3',
        ]);

        // user access
        UserAccessParent::create([
            'level_id'  => '3',
            'parent_id' => '3',
            'order'     => '3',
        ]);

        //
        UserAccessChild::create([
            'level_id'  => '1',
            'parent_id' => '2',
            'child_id'  => '4',
            'order'     => '1',
        ]);

        UserAccessChild::create([
            'level_id'  => '1',
            'parent_id' => '2',
            'child_id'  => '5',
            'order'     => '2',
        ]);

        UserAccessChild::create([
            'level_id'  => '1',
            'parent_id' => '2',
            'child_id'  => '6',
            'order'     => '3',
        ]);

        UserAccessChild::create([
            'level_id'  => '1',
            'parent_id' => '2',
            'child_id'  => '7',
            'order'     => '4',
        ]);

        UserAccessChild::create([
            'level_id'  => '2',
            'parent_id' => '2',
            'child_id'  => '4',
            'order'     => '1',
        ]);

        UserAccessChild::create([
            'level_id'  => '2',
            'parent_id' => '2',
            'child_id'  => '5',
            'order'     => '2',
        ]);

        UserAccessChild::create([
            'level_id'  => '2',
            'parent_id' => '2',
            'child_id'  => '6',
            'order'     => '3',
        ]);

        UserAccessChild::create([
            'level_id'  => '2',
            'parent_id' => '2',
            'child_id'  => '7',
            'order'     => '4',
        ]);
    }
}
