<?php

namespace Database\Seeders\Feature;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Feature\FeedbackCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeedbackCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['title' => 'Desain dan Tampilan (User Interface)',],
            ['title' => 'Pengalaman Pengguna (User Experience)',],
            ['title' => 'Kinerja dan Kecepatan (Performance and Speed)',],
            ['title' => 'Kegunaan (Usability)',],
            ['title' => 'Fungsionalitas (Functionality)',],
            ['title' => 'Konten',],
            ['title' => 'Masalah Teknis (Technical Issues)',],
            ['title' => 'Keamanan (Security)',],
        ];
        foreach ($datas as $data) :
            FeedbackCategory::create(
                [
                    'user_id' => 1,
                    'slug' => Str::slug($data['title']),
                    'title' => Str::headline(Str::lower($data['title'])),
                ],
            );
        endforeach;
    }
}
