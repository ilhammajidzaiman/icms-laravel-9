<?php

namespace Database\Seeders\Feature;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Feature\PeoplePosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeoplePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['title' => 'Founder',],
        ];
        foreach ($data as $item) :
            PeoplePosition::create(
                [
                    'user_id' => 1,
                    'slug' => Str::slug($item['title']),
                    'title' => Str::headline(Str::lower($item['title'])),
                ],
            );
        endforeach;
    }
}
