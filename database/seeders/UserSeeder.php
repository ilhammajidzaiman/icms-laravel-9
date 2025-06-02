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
     */
    public function run(): void
    {
        $datas = [
            ['name' => 'Super Admin',],
            ['name' => 'Rasmus Lerdorf',],
            ['name' => 'Taylor Otwell',],
            ['name' => 'Caleb Porzio',],
            ['name' => 'Dan Harrin',],
            ['name' => 'Brendan Eich',],
        ];
        foreach ($datas as $data) :
            User::create(
                [
                    'name' => $data['name'],
                    'username' => Str::lower(Str::replace(' ', '', $data['name'])),
                    'email' => Str::lower(Str::replace(' ', '', $data['name'])) . '@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('*#' . Str::lower(Str::replace(' ', '', $data['name']))),
                ],
            );
        endforeach;
    }
}
