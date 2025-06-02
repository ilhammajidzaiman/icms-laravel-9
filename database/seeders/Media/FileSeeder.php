<?php

namespace Database\Seeders\Media;

use App\Models\Media\File;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'file_category_id' => '2',
                'title' => 'petunjuk penggunaan aplikasi iCMS',
            ],
            [
                'file_category_id' => '3',
                'title' => 'produk  aplikasi iCMS',
            ],
        ];
        foreach ($data as $item) :
            File::create(
                [
                    'user_id' => 1,
                    'file_category_id' => $item['file_category_id'],
                    'slug' => Str::slug($item['title']),
                    'title' => Str::headline(Str::lower($item['title'])),
                ],
            );
        endforeach;
    }
}
