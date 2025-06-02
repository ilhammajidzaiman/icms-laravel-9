<?php

namespace Database\Seeders\Post;

use Illuminate\Support\Str;
use App\Models\Post\NavMenu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NavMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "parent_id" => -1,
                "order" => 1,
                "modelable_type" => "App\\Models\\Post\\Page",
                "modelable_id" => 1,
                "title" => "Tentang",
            ],
            [
                "parent_id" => 1,
                "order" => 1,
                "modelable_type" => "App\\Models\\Post\\Page",
                "modelable_id" => 1,
                "title" => "Profil",
            ],
            [
                "parent_id" => 1,
                "order" => 2,
                "modelable_type" => "App\\Models\\Post\\Page",
                "modelable_id" => 1,
                "title" => "Layanan",
            ],
            [
                "parent_id" => 1,
                "order" => 3,
                "modelable_type" => "App\\Models\\Post\\Page",
                "modelable_id" => 1,
                "title" => "Produk",
            ],
            [
                "parent_id" => -1,
                "order" => 2,
                "modelable_type" => "App\\Models\\Post\\Page",
                "modelable_id" => 1,
                "title" => "Kontak",
            ],
            [
                "parent_id" => -1,
                "order" => 3,
                "modelable_type" => "App\\Models\\Post\\Page",
                "modelable_id" => 1,
                "title" => "Media",
            ],
            [
                "parent_id" => 6,
                "order" => 1,
                "modelable_type" => "App\\Models\\Post\\Link",
                "modelable_id" => 2,
                "title" => "Galeri",
            ],
            [
                "parent_id" => 6,
                "order" => 2,
                "modelable_type" => "App\\Models\\Post\\Link",
                "modelable_id" => 3,
                "title" => "Vidio",
            ],
            [
                "parent_id" => -1,
                "order" => 4,
                "modelable_type" => "App\\Models\\Post\\Link",
                "modelable_id" => 1,
                "title" => "Dokumen",
            ]
        ];
        foreach ($data as $item) :
            NavMenu::create(
                [
                    'user_id' => 1,
                    'parent_id' => $item['parent_id'],
                    'order' => $item['order'],
                    'modelable_type' => $item['modelable_type'],
                    'modelable_id' => $item['modelable_id'],
                    'slug' => Str::slug($item['title']),
                    'title' => Str::headline(Str::lower($item['title'])),
                ],
            );
        endforeach;
    }
}
