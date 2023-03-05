<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\UserLevel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserLevel::create([
            'id'            => '1',
            'uuid'          => Str::uuid(),
            'name'          => 'Developer',
            'slug'          => 'developer.html',
            'color'         => 'danger',
        ]);

        UserLevel::create([
            'id'            => '2',
            'uuid'          => Str::uuid(),
            'name'          => 'Admin',
            'slug'          => 'admin.html',
            'color'         => 'warning',
        ]);

        UserLevel::create([
            'id'            => '3',
            'uuid'          => Str::uuid(),
            'name'          => 'User',
            'slug'          => 'user.html',
            'color'         => 'success',
        ]);
    }
}
