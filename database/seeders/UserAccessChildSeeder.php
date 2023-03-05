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
        // super admin
        UserAccessChild::create([
            'level_id'  => '1',
            'parent_id' => '1',
            'child_id'  => '3',
            'order'     => '1',
        ]);

        UserAccessChild::create([
            'level_id'  => '1',
            'parent_id' => '1',
            'child_id'  => '4',
            'order'     => '2',
        ]);

        UserAccessChild::create([
            'level_id'  => '1',
            'parent_id' => '1',
            'child_id'  => '5',
            'order'     => '3',
        ]);

        UserAccessChild::create([
            'level_id'  => '1',
            'parent_id' => '1',
            'child_id'  => '6',
            'order'     => '4',
        ]);

        UserAccessChild::create([
            'level_id'  => '1',
            'parent_id' => '1',
            'child_id'  => '7',
            'order'     => '5',
        ]);

        // admin
        UserAccessChild::create([
            'level_id'  => '2',
            'parent_id' => '1',
            'child_id'  => '3',
            'order'     => '1',
        ]);

        UserAccessChild::create([
            'level_id'  => '2',
            'parent_id' => '1',
            'child_id'  => '4',
            'order'     => '2',
        ]);

        UserAccessChild::create([
            'level_id'  => '2',
            'parent_id' => '1',
            'child_id'  => '5',
            'order'     => '3',
        ]);

        UserAccessChild::create([
            'level_id'  => '2',
            'parent_id' => '1',
            'child_id'  => '6',
            'order'     => '4',
        ]);

        UserAccessChild::create([
            'level_id'  => '2',
            'parent_id' => '1',
            'child_id'  => '7',
            'order'     => '4',
        ]);
    }
}
