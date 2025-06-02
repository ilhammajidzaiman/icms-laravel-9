<?php

namespace Database\Seeders\Post;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Post\BlogCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['title' => 'Lainnya',],
            ['title' => 'Tutorial',],
            ['title' => 'Programming',],
            ['title' => 'Backend',],
            ['title' => 'Frontend',],
            ['title' => 'Full Stack',],
        ];
        foreach ($datas as $data) :
            BlogCategory::create(
                [
                    'user_id' => 1,
                    'slug' => Str::slug($data['title']),
                    'title' => Str::headline(Str::lower($data['title'])),
                ],
            );
        endforeach;
    }
}
