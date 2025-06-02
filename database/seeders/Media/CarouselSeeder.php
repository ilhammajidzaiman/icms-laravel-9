<?php

namespace Database\Seeders\Media;

use Illuminate\Support\Str;
use App\Models\Media\Carousel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "title" => "PHP: Hypertext Preprocessor",
                "description" => "Bahasa pemrograman serbaguna yang populer dan sangat cocok untuk pengembangan web. Cepat, fleksibel, dan praktis, PHP digunakan untuk segala hal mulai dari blog Anda hingga situs web paling populer di dunia.",
            ],
            [
                "title" => "Laravel: Framework PHP untuk Pengrajin Web",
                "description" => "Laravel adalah kerangka kerja aplikasi web dengan sintaks yang ekspresif dan elegan. Kami sudah meletakkan dasarnya, membebaskan Anda untuk menciptakan tanpa perlu pusing dengan hal-hal kecil.",
            ],
        ];
        foreach ($data as $item) :
            Carousel::create(
                [
                    'user_id' => 1,
                    'slug' => Str::slug($item['title']),
                    'title' => Str::headline(Str::lower($item['title'])),
                    'description' => $item['description'],
                ],
            );
        endforeach;
    }
}
