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
        // superadmin
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

        // admin
        UserAccessParent::create([
            'level_id'  => '2',
            'parent_id' => '1',
            'order'     => '2',
        ]);

        UserAccessParent::create([
            'level_id'  => '2',
            'parent_id' => '2',
            'order'     => '3',
        ]);

        // user
        // UserAccessParent::create([
        //     'level_id'  => '3',
        //     'parent_id' => '3',
        //     'order'     => '3',
        // ]);
    }
}
