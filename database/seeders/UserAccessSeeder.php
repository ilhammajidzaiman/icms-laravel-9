<?php

namespace Database\Seeders;

use App\Models\UserAccess;
use Illuminate\Database\Seeder;
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

        UserAccess::create([
            'level_id'  => '1',
            'menu_id'   => '1',
        ]);

        UserAccess::create([
            'level_id'  => '1',
            'menu_id'   => '2',
        ]);

        UserAccess::create([
            'level_id'  => '1',
            'menu_id'   => '3',
        ]);

        // admin access

        UserAccess::create([
            'level_id'  => '2',
            'menu_id'   => '2',
        ]);

        UserAccess::create([
            'level_id'  => '2',
            'menu_id'   => '3',
        ]);

        // user access

        UserAccess::create([
            'level_id'  => '3',
            'menu_id'   => '3',
        ]);
    }
}
