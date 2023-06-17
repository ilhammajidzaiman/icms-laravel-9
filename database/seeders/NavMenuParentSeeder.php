<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\NavMenu\NavMenuParent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NavMenuParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NavMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '1',
            'name'          => 'Beranda',
            'slug'          => 'beranda',
            'url'           => '#home',
        ]);

        NavMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '2',
            'name'          => 'Berita',
            'slug'          => 'berita',
            'url'           => '#post',
        ]);

        NavMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '3',
            'name'          => 'Galeri',
            'slug'          => 'galeri',
            'url'           => '#galery',
        ]);

        NavMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '4',
            'name'          => 'Kontak',
            'slug'          => 'kontak',
            'url'           => '#contac',
        ]);

        NavMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '5',
            'name'          => 'Download',
            'slug'          => 'download',
            'url'           => '/download',
        ]);
    }
}
