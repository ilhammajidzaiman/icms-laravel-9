<?php

namespace Database\Seeders\Post;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Post\BlogArticle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                "blog_category_id" => 1,
                "title" => "Selamat Datang, Ini Adalah Artikel Pertama",
                "content" => "Hello world. Selamat datang, Ini adalah artikel pertama anda. Silahkan edit atau hapus artikel ini.",
            ],
            [
                "blog_category_id" => 3,
                "title" => "Laravel: Kerangka PHP untuk Pengrajin Web",
                "content" => "<p>Laravel adalah kerangka kerja (framework) PHP yang bersifat open-source dan dirancang untuk mempermudah pengembangan aplikasi web. Diciptakan oleh Taylor Otwell pada tahun 2011, Laravel menggunakan pola desain Model-View-Controller (MVC) yang membantu memisahkan logika aplikasi, tampilan, dan data, sehingga memudahkan pengembang dalam memelihara dan mengembangkan aplikasi.<br>Beberapa fitur utama Laravel antara lain:<br><br><\/p><p>**Routing**: Memudahkan pengelolaan URL dan endpoint dalam aplikasi.<\/p><p>**Eloquent ORM**: Sistem ORM (Object-Relational Mapping) yang kuat untuk berinteraksi dengan basis data menggunakan model PHP.<\/p><p>**Blade Templating Engine**: Sistem template yang efisien dan mudah digunakan untuk membuat tampilan aplikasi.<\/p><p>**Middleware**: Memungkinkan pengembang untuk memfilter permintaan HTTP yang masuk ke aplikasi.<\/p><p>**Artisan Command Line Tool**: Alat CLI (Command Line Interface) yang menyediakan berbagai perintah untuk mengotomatisasi tugas-tugas rutin, seperti migrasi basis data dan pengelolaan paket.<\/p><p>**Unit Testing**: Memungkinkan pengujian unit secara langsung di dalam framework untuk memastikan kualitas kode.<br><br><\/p><p>Laravel banyak digunakan oleh pengembang karena kemudahan penggunaannya, dokumentasi yang lengkap, dan komunitas yang aktif.<br>Founder Laravel adalah Taylor Otwell. Dia menciptakan Laravel pada tahun 2011 dengan tujuan menyediakan kerangka kerja PHP yang lebih elegan dan mudah digunakan dibandingkan dengan yang ada saat itu. Sejak peluncurannya, Laravel telah berkembang pesat dan menjadi salah satu kerangka kerja PHP yang paling populer, berkat fitur-fitur canggih, dokumentasi yang baik, dan komunitas yang aktif.<br><br>Taylor Otwell merancang Laravel untuk menyederhanakan dan mempercepat proses pengembangan aplikasi web dengan PHP. Sebelum Laravel, Otwell merasa bahwa banyak framework PHP yang ada terlalu rumit atau tidak memiliki fitur yang memadai untuk kebutuhan modern.&nbsp;<br><br>Beberapa tonggak penting dalam sejarah Laravel meliputi:<br><br>**Laravel 1.0 (2011)**: Versi pertama Laravel diluncurkan dengan fokus pada fitur-fitur dasar seperti autentikasi, routing, dan sesi.<\/p><p>**Laravel 2.0 (2011)**: Memperkenalkan berbagai fitur baru, termasuk Command Line Interface (CLI) yang dinamakan Artisan.<\/p><p>**Laravel 3.0 (2012)**: Memperkenalkan sistem bundel, alat pengujian unit, dan banyak peningkatan lainnya.<\/p><p>**Laravel 4.0 (2013)**: Dirilis sebagai penulisan ulang total dari versi sebelumnya, memperkenalkan Composer untuk manajemen paket dan Eloquent ORM yang lebih baik.<\/p><p>**Laravel 5.0 (2015)**: Memperkenalkan konsep-konsep seperti middleware, kontrak, dan dukungan untuk penjadwalan tugas.<\/p><p>**Laravel 6.0 (2019)**: Memulai sistem versi semantik, memperkenalkan Laravel Vapor untuk penyebaran serverless, dan meningkatkan banyak komponen inti.<\/p><p>**Laravel 8.0 (2020)**: Menambahkan berbagai fitur baru seperti Laravel Jetstream untuk otentikasi frontend, model factory yang ditingkatkan, dan berbagai perbaikan lainnya.<\/p><p>Selain pengembangan inti Laravel, Taylor Otwell juga menciptakan berbagai produk dan layanan pendukung seperti Laravel Forge, Laravel Envoyer, dan Laravel Vapor, yang membantu pengembang dalam mengelola dan menyebarkan aplikasi mereka dengan lebih mudah.<br><br>Komunitas Laravel yang aktif dan beragam telah menghasilkan banyak paket pihak ketiga, tutorial, dan sumber daya lainnya yang memperkaya ekosistem Laravel, menjadikannya salah satu pilihan utama bagi pengembang PHP di seluruh dunia.<\/p>",
            ],
            [
                "blog_category_id" => 3,
                "title" => "PHP: Bahasa pemrograman serbaguna yang populer dan sangat cocok untuk pengembangan web. Cepat, fleksibel, dan praktis, PHP digunakan untuk segala hal mulai dari blog Anda hingga situs web paling populer di dunia.",
                "content" => "<p>PHP (Hypertext Preprocessor) adalah bahasa skrip sisi server yang dirancang khusus untuk pengembangan web. PHP dapat disisipkan ke dalam HTML dan digunakan untuk mengelola konten dinamis, melacak sesi, dan bahkan membangun aplikasi e-commerce. Bahasa ini populer karena kemudahan penggunaannya, fleksibilitasnya, serta dukungan komunitas yang luas. PHP sering digunakan bersama dengan basis data MySQL dan sering digunakan dalam pengembangan sistem manajemen konten (CMS) seperti WordPress, Joomla, dan Drupal.<\/p><p>Berikut adalah beberapa karakteristik utama PHP:<\/p><p>**Skrip Sisi Server: PHP dijalankan di server web dan hasilnya dikirimkan ke browser klien.<\/p><p>**Embedded dalam HTML: PHP dapat disisipkan langsung ke dalam kode HTML, membuatnya mudah digunakan untuk pemula.<\/p><p>**Open Source: PHP adalah perangkat lunak open-source, yang berarti dapat digunakan dan dimodifikasi secara bebas.<\/p><p>**Multi-platform: PHP dapat berjalan di berbagai sistem operasi, termasuk Windows, Linux, dan macOS.<\/p><p>**Banyak Fungsi Bawaan: PHP memiliki banyak fungsi bawaan yang memudahkan manipulasi file, pengelolaan formulir, dan interaksi dengan database.<\/p><p>PHP awalnya dikembangkan oleh Rasmus Lerdorf pada tahun 1994. Lerdorf menciptakan PHP untuk melacak kunjungan ke halaman online miliknya. Pada awalnya, PHP hanya sebuah kumpulan skrip yang disebut \"Personal Home Page Tools\" (Alat Halaman Pribadi). Seiring waktu, PHP berkembang menjadi bahasa skrip yang lebih lengkap dengan kontribusi dari banyak pengembang lain. Pada tahun 1995, Lerdorf merilis PHP\\\/FI (Personal Home Page\\\/Forms Interpreter) kepada publik, yang menjadi dasar dari perkembangan PHP seperti yang kita kenal sekarang.<\/p><p>Setelah rilis awal PHP\\\/FI pada tahun 1995, bahasa ini terus berkembang pesat. Pada tahun 1997, dua programmer, Zeev Suraski dan Andi Gutmans, menulis ulang inti parser PHP, yang menghasilkan PHP 3. Ini adalah versi di mana PHP mulai dikenal secara luas dan digunakan secara global. Mereka juga mendirikan Zend Technologies pada tahun 1999 dan menciptakan Zend Engine, yang menjadi dasar dari PHP 4 dan versi-versi berikutnya.<br><br>Berikut adalah garis waktu utama perkembangan PHP:<br><br>**PHP\\\/FI (1995): Versi awal yang dirilis oleh Rasmus Lerdorf. Berfungsi sebagai alat sederhana untuk melacak kunjungan halaman web.<\/p><p>**PHP 3 (1997): Zeev Suraski dan Andi Gutmans menulis ulang inti PHP dan merilis PHP 3, yang membawa banyak fitur baru dan menjadikan PHP populer.<\/p><p>**PHP 4 (2000): Didorong oleh Zend Engine 1.0, PHP 4 meningkatkan kinerja dan manajemen memori.<\/p><p>**PHP 5 (2004): Memperkenalkan Zend Engine II, dukungan untuk pemrograman berorientasi objek yang lebih baik, serta berbagai perbaikan dalam ekstensi dan fungsi.<\/p><p>**PHP 7 (2015): Lompatan besar dalam kinerja dan efisiensi memori dengan pengenalan Zend Engine 3.0. PHP 6 dilewati karena masalah pengembangan.<\/p><p>**PHP 8 (2020): Memperkenalkan Just-In-Time (JIT) compilation, yang meningkatkan kinerja secara signifikan, serta banyak fitur dan perbaikan baru.<\/p><p>Saat ini, PHP tetap menjadi salah satu bahasa skrip sisi server paling populer di dunia, digunakan oleh jutaan pengembang dan situs web. Dukungan komunitas yang kuat dan pembaruan yang terus-menerus membantu menjaga relevansi dan keefektifan PHP dalam pengembangan web modern.<\/p>",
            ]
        ];
        foreach ($datas as $data) :
            BlogArticle::create(
                [
                    'user_id' => 1,
                    'blog_category_id' => $data['blog_category_id'],
                    'slug' => Str::slug($data['title']),
                    'title' => Str::headline(Str::lower($data['title'])),
                    'content' => $data['content'],
                    'published_at' => now(),
                ],
            );
        endforeach;
    }
}
