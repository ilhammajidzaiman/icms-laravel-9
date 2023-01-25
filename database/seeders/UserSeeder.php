<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uuid'          => Str::uuid(),
            'level_id'      => '1',
            'status_id'     => '1',
            'name'          => 'My Name Admin',
            'username'      => 'admin',
            'password'      => Hash::make('*#admin'),
            'email'         => 'admin@gmail.com',
            'file'          => 'default-user.svg',
        ]);

        User::create([
            'uuid'          => Str::uuid(),
            'level_id'      => '2',
            'status_id'     => '1',
            'name'          => 'My Name User',
            'username'      => 'user',
            'password'      => Hash::make('*#user'),
            'email'         => 'user@gmail.com',
            'file'          => 'default-user.svg',
        ]);
    }
}
