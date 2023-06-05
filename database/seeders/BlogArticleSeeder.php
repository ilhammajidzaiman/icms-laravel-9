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
            'title'             => 'Hello world. Selamat datang. Ini adalah post artikel pertama anda',
            'slug'              => 'hello-world-selamat-datang-ini-adalah-post-artikel-pertama-anda',
            'content'           => 'Selamat datang. Ini adalah post artikel pertama anda. Silahkan edit atau hapus post artikel ini.',
            'truncated'         => 'Selamat datang. Ini adalah post artikel pertama anda. Silahkan edit atau hapus post artikel ini...',
            'path'              => null,
            'file'              => 'default-img.svg',
        ]);
    }
}
