<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Slideshow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
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
            'name'          => 'Aktif',
            'slug'          => 'aktif',
            'color'         => 'success',
        ]);

        Slideshow::create([
            'uuid'          => Str::uuid(),
            'name'          => 'Tidak Aktif',
            'slug'          => 'tidak-aktif',
            'color'         => 'secondary',
        ]);
    }
}
