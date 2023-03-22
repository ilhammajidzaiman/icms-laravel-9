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
            'uuid'              => Str::uuid(),
            'user_level_id'     => '1',
            'user_status_id'    => '1',
            'name'              => 'Nama Ku Developer',
            'username'          => 'developer',
            'password'          => Hash::make('*#developer'),
            'email'             => 'developer@gmail.com',
            'file'              => 'default-user.svg',
        ]);

        User::create([
            'uuid'              => Str::uuid(),
            'user_level_id'     => '2',
            'user_status_id'    => '1',
            'name'              => 'Nama Ku Admin',
            'username'          => 'admin',
            'password'          => Hash::make('*#admin'),
            'email'             => 'admin@gmail.com',
            'file'              => 'default-user.svg',
        ]);

        User::create([
            'uuid'              => Str::uuid(),
            'user_level_id'     => '3',
            'user_status_id'    => '1',
            'name'              => 'Nama Ku User',
            'username'          => 'user',
            'password'          => Hash::make('*#user'),
            'email'             => 'user@gmail.com',
            'file'              => 'default-user.svg',
        ]);
    }
}
