<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Status;
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
        Status::create([
            'uuid'          => Str::uuid(),
            'name'          => 'Aktif',
            'slug'          => 'aktif',
            'color'         => 'success',
        ]);

        Status::create([
            'uuid'          => Str::uuid(),
            'name'          => 'Tidak Aktif',
            'slug'          => 'tidak-aktif',
            'color'         => 'secondary',
        ]);
    }
}
