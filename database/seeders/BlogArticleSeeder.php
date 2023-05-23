<?php

namespace Database\Seeders;

use App\Models\Blog\BlogArticle;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogArticle::create([
            'uuid'              => Str::uuid(),
            'user_id'           => '1',
            'blog_status_id'    => '1',
            'title'             => 'Hello world',
            'slug'              => 'hello-world',
            'content'           => 'Selamat datang, ini halaman tampilan awal website dibuat',
            'truncated'         => 'Selamat datang, ini halaman tampilan awal website dibuat...',
            'file'              => 'default-img.svg',
        ]);
    }
}
