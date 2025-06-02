<?php

namespace Database\Seeders\Media;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Media\FileCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FileCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['title' => 'Lainnya',],
            ['title' => 'Dokumentasi',],
            ['title' => 'Produk',],
        ];
        foreach ($data as $item) :
            FileCategory::create(
                [
                    'user_id' => 1,
                    'slug' => Str::slug($item['title']),
                    'title' => Str::headline(Str::lower($item['title'])),
                ],
            );
        endforeach;
    }
}
