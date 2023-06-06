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
            'url'           => '#news',
        ]);

        NavMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '3',
            'name'          => 'Tentang',
            'slug'          => 'tentang',
            'url'           => '#about',
        ]);

        NavMenuParent::create([
            'uuid'          => Str::uuid(),
            'order'         => '4',
            'name'          => 'Kontak',
            'slug'          => 'kontak',
            'url'           => '#contac',
        ]);
    }
}
