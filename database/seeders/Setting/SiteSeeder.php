<?php

namespace Database\Seeders\Setting;

use App\Models\Setting\Site;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'iCMS Filamenthp V3',
                'email' => 'icmsfilamentphpv3@gmail.com',
                'address' => 'Jl. Jend. Sudirman No. 375 Pekanbaru',
                'phone' => '(0812) 3456789',
                'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16328182.633267699!2d107.22171031843773!3d-2.3813608494441247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c4c07d7496404b7%3A0xe37b4de71badf485!2sIndonesia!5e0!3m2!1sid!2sid!4v1722322760161!5m2!1sid!2sid',
            ],
        ];
        foreach ($data as $item) :
            Site::create(
                [
                    'name' => $item['name'],
                    'email' => $item['email'],
                    'address' => $item['address'],
                    'phone' => $item['phone'],
                    'map' => $item['map'],
                ],
            );
        endforeach;
    }
}
