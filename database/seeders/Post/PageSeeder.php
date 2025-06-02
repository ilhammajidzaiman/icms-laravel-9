<?php

namespace Database\Seeders\Post;

use App\Models\Post\Page;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'title'     => 'Selamat datang',
                'content'   => 'Hello world. Selamat datang, Ini adalah halaman pertama anda. Silahkan edit atau hapus halaman ini.',
            ]
        ];
        foreach ($datas as $data) :
            Page::create(
                [
                    'user_id' => 1,
                    'slug' => Str::slug($data['title']),
                    'title' => Str::headline(Str::lower($data['title'])),
                    'content' => $data['content'],
                ],
            );
        endforeach;
    }
}
