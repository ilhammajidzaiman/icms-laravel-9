<?php

namespace Database\Seeders\Feature;

use Illuminate\Support\Str;
use App\Models\Feature\People;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'people_position_id' => '1',
                'order' => '1',
                'name' => 'Rasmus Lerdorf',
                'description' => "rasmus Lerdorf adalah seorang pemrogram komputer asal Greenland-Denmark yang dikenal sebagai pencipta bahasa pemrograman PHP. 
                                Dia merilis versi pertama PHP pada tahun 1995 sebagai serangkaian skrip Common Gateway Interface (CGI) yang ditulis dalam bahasa pemrograman C. 
                                Skrip ini awalnya dirancang untuk mengelola halaman web pribadi Lerdorf, tetapi kemudian berkembang menjadi bahasa pemrograman yang banyak digunakan untuk pengembangan web.
                                Lerdorf terus berkontribusi pada pengembangan PHP selama bertahun-tahun dan memainkan peran penting dalam komunitas PHP. 
                                Selain PHP, dia juga telah bekerja pada berbagai proyek sumber terbuka lainnya dan telah bekerja untuk perusahaan teknologi besar seperti Yahoo! dan Etsy.
                                Selain pencapaiannya dalam dunia teknologi, Lerdorf sering menjadi pembicara di konferensi teknologi dan memberikan ceramah tentang pengembangan web dan teknologi sumber terbuka."
            ],
            [
                'people_position_id' => '1',
                'order' => '2',
                'name' => 'Taylor Otwell',
                'description' => "Taylor Otwell adalah seorang pengembang perangkat lunak yang dikenal sebagai pencipta Laravel, sebuah framework PHP yang populer untuk pengembangan aplikasi web. 
                                Laravel dirancang untuk membuat pengembangan web lebih mudah dan efisien dengan menyediakan sintaks yang elegan dan berbagai fitur yang lengkap. 
                                Taylor Otwell pertama kali merilis Laravel pada tahun 2011, dan sejak itu, framework ini telah menjadi salah satu pilihan utama bagi pengembang PHP di seluruh dunia. 
                                Selain Laravel, Taylor juga terlibat dalam berbagai proyek dan inisiatif lain dalam komunitas pengembangan perangkat lunak."
            ],
            [
                'people_position_id' => '1',
                'order' => '3',
                'name' => 'Caleb Porzio',
                'description' => "Caleb Porzio adalah seorang pengembang perangkat lunak yang terkenal di komunitas Laravel dan JavaScript. 
                                Dia dikenal karena kontribusinya pada ekosistem Laravel, terutama melalui alat dan paket yang membantu pengembang bekerja lebih efisien. 
                                Salah satu karyanya yang terkenal adalah **Livewire**, sebuah library full-stack untuk Laravel yang memungkinkan pengembangan komponen antarmuka pengguna dinamis menggunakan PHP tanpa perlu banyak JavaScript. 
                                Caleb juga mengembangkan **Alpine.js**, sebuah framework JavaScript minimalis yang digunakan untuk meningkatkan interaktivitas halaman web.
                                Caleb aktif berbagi pengetahuannya melalui blog, video, dan konferensi, serta sering berpartisipasi dalam diskusi komunitas tentang praktik terbaik dan inovasi dalam pengembangan web."
            ],
            [
                'people_position_id' => '1',
                'order' => '4',
                'name' => 'Dan Harrin',
                'description' => "Dan Harrin adalah seorang pengembang perangkat lunak yang dikenal dalam komunitas Laravel dan pengembangan web. 
                                Dia bekerja pada proyek-proyek yang terkait dengan ekosistem Laravel dan sering berkontribusi dengan alat-alat dan paket yang membantu pengembang dalam meningkatkan produktivitas mereka. 
                                Salah satu kontribusinya yang terkenal adalah keterlibatannya dalam pengembangan **Inertia.js**, sebuah framework yang memungkinkan pengembang membangun aplikasi single-page menggunakan Laravel dan Vue.js (atau React).
                                Dan juga aktif berbagi pengetahuan melalui blog, video, dan partisipasi dalam konferensi serta diskusi komunitas, membantu pengembang lain memahami dan memanfaatkan alat-alat terbaru dalam pengembangan web."
            ],
            [
                'people_position_id' => '1',
                'order' => '5',
                'name' => 'Brendan Eich',
                'description' => "Brendan Eich adalah seorang ilmuwan komputer dan pengembang perangkat lunak terkenal yang menciptakan JavaScript, salah satu bahasa pemrograman yang paling penting di web. 
                                Dia menulis versi pertama JavaScript pada tahun 1995 ketika bekerja di Netscape Communications. 
                                JavaScript telah menjadi bahasa standar untuk pengembangan web dan digunakan oleh jutaan pengembang di seluruh dunia.
                                Selain menciptakan JavaScript, Brendan Eich juga merupakan salah satu pendiri Mozilla Corporation, organisasi di balik browser web Firefox. 
                                Dia menjabat sebagai CTO (Chief Technology Officer) dan kemudian sebagai CEO Mozilla Corporation. Setelah meninggalkan Mozilla, Eich mendirikan Brave Software, perusahaan di balik Brave Browser, yang fokus pada privasi dan keamanan pengguna di internet."
            ],
        ];
        foreach ($data as $item) :
            People::create(
                [
                    'user_id' => 1,
                    'people_position_id' => $item['people_position_id'],
                    'order' => $item['order'],
                    'name' => Str::headline(Str::lower($item['name'])),
                    'description' => $item['description'],
                ],
            );
        endforeach;
    }
}
