<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Slideshow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SlideshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slideshow::create([
            'uuid'          => Str::uuid(),
            'status_id'     => '1',
            'title'         => 'Slideshow Pertama',
            'slug'          => 'slideshow-pertama',
            'detail'        => 'Selamat datang. Ini adalah rincian slideshow pertama. Silahkan edit atau hapus slideshow ini.',
            'path'          => null,
            'file'          => 'default-slideshow.svg',
        ]);
    }
}
