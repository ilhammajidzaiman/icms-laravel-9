<?php

namespace Database\Seeders;

use App\Models\Blog\BlogStatus;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogStatus::create([
            'uuid'          => Str::uuid(),
            'name'          => 'Diterbitkan',
            'slug'          => 'diterbitkan',
            'color'         => 'success',
        ]);

        BlogStatus::create([
            'uuid'          => Str::uuid(),
            'name'          => 'Draft',
            'slug'          => 'draft',
            'color'         => 'secondary',
        ]);
    }
}
