<?php

namespace Database\Seeders\Media;

use App\Models\Media\Video;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Php',
                'url' => 'https://youtu.be/l1W2OwV5rgY?si=rfHKWvUKxY1WBQja',
                'embed' => 'https://www.youtube.com/embed/l1W2OwV5rgY?si=rfHKWvUKxY1WBQja',
            ],
            [
                'title' => 'Laravel',
                'url' => 'https://youtu.be/HqAMb6kqlLs?si=568unkfX-iLnnzS5',
                'embed' => 'https://www.youtube.com/embed/HqAMb6kqlLs?si=568unkfX-iLnnzS5',
            ],
        ];
        foreach ($data as $item) :
            Video::create(
                [
                    'user_id' => 1,
                    'slug' => Str::slug($item['title']),
                    'title' => Str::headline(Str::lower($item['title'])),
                    'url' => $item['url'],
                    'embed' => $item['embed'],
                    'is_show' => true,
                ],
            );
        endforeach;
    }
}
