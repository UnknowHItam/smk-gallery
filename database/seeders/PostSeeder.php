<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Posts;
use App\Models\Kategori;
use App\Models\Petugas;
use App\Models\Galery;
use App\Models\Foto;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada petugas
        $petugas = Petugas::first();
        if (!$petugas) {
            $petugas = Petugas::create([
                'username' => 'admin',
                'email' => 'admin@smkn4bogor.sch.id',
                'password' => bcrypt('password'),
            ]);
        }

        // Pastikan kategori ada, jika tidak buat baru
        $beritaKategori = Kategori::firstOrCreate(
            ['judul' => 'Berita'],
            ['judul' => 'Berita']
        );
        
        $kejuaraanKategori = Kategori::firstOrCreate(
            ['judul' => 'Kejuaraan'],
            ['judul' => 'Kejuaraan']
        );
        
        $eskulKategori = Kategori::firstOrCreate(
            ['judul' => 'Ekstrakurikuler'],
            ['judul' => 'Ekstrakurikuler']
        );
        
        $agendaKategori = Kategori::firstOrCreate(
            ['judul' => 'Agenda'],
            ['judul' => 'Agenda']
        );

        // Data postingan
        $posts = [
            [
                'judul' => 'Siswa SMKN 4 Bogor Raih Juara 1 Volly Tingkat Provinsi',
                'isi' => 'Prestasi membanggakan diraih oleh tim volly putra SMKN 4 Bogor yang berhasil meraih juara 1 dalam kompetisi volly tingkat provinsi. Kemenangan ini menunjukkan dedikasi dan kerja keras para atlet dalam berlatih dan berkompetisi. Tim yang terdiri dari 12 siswa ini telah berlatih keras selama 6 bulan untuk persiapan kompetisi.',
                'kategori_id' => $kejuaraanKategori->id,
                'status' => 'published',
            ],
            [
                'judul' => 'Ekstrakurikuler Futsal SMKN 4 Bogor Raih Prestasi Gemilang',
                'isi' => 'Ekstrakurikuler futsal SMKN 4 Bogor terus menunjukkan prestasi yang membanggakan. Tim futsal sekolah berhasil meraih berbagai penghargaan dalam berbagai kompetisi tingkat regional dan nasional. Program ekstrakurikuler ini diikuti oleh 30 siswa yang terbagi dalam tim putra dan putri.',
                'kategori_id' => $eskulKategori->id,
                'status' => 'published',
            ],
            [
                'judul' => 'Agenda Rantang Berbagi SMKN 4 Bogor',
                'isi' => 'Program Rantang Berbagi merupakan agenda rutin SMKN 4 Bogor yang bertujuan untuk membantu sesama dan menumbuhkan rasa kepedulian sosial di kalangan siswa. Kegiatan ini diadakan setiap bulan dengan melibatkan seluruh warga sekolah. Program ini telah berjalan selama 2 tahun dan telah membantu ratusan keluarga yang membutuhkan.',
                'kategori_id' => $agendaKategori->id,
                'status' => 'published',
            ],
            [
                'judul' => 'Workshop Teknologi Terbaru untuk Siswa SMKN 4 Bogor',
                'isi' => 'SMKN 4 Bogor mengadakan workshop teknologi terbaru yang diikuti oleh 100 siswa dari berbagai jurusan. Workshop ini menghadirkan pembicara dari industri teknologi dan memberikan pelatihan hands-on tentang teknologi terkini. Kegiatan ini bertujuan untuk meningkatkan kompetensi siswa dalam menghadapi era digital.',
                'kategori_id' => $beritaKategori->id,
                'status' => 'published',
            ],
            [
                'judul' => 'Tim Basket Putri SMKN 4 Bogor Juara 1 Tingkat Kabupaten',
                'isi' => 'Tim basket putri SMKN 4 Bogor berhasil meraih juara 1 dalam kompetisi basket tingkat kabupaten. Prestasi ini diraih setelah mengalahkan 8 sekolah lain dalam turnamen yang berlangsung selama 3 hari. Pelatih tim, Ibu Sari, mengungkapkan kebanggaannya atas pencapaian para atlet.',
                'kategori_id' => $kejuaraanKategori->id,
                'status' => 'published',
            ],
            [
                'judul' => 'Pameran Karya Siswa SMKN 4 Bogor',
                'isi' => 'Pameran karya siswa SMKN 4 Bogor akan diselenggarakan pada tanggal 30 Oktober 2025. Pameran ini akan menampilkan berbagai karya kreatif siswa dari semua jurusan, mulai dari karya seni, teknologi, hingga produk inovatif. Acara ini terbuka untuk umum dan diharapkan dapat menginspirasi masyarakat.',
                'kategori_id' => $agendaKategori->id,
                'status' => 'published',
            ],
        ];

        foreach ($posts as $postData) {
            $post = Posts::create([
                'judul' => $postData['judul'],
                'isi' => $postData['isi'],
                'kategori_id' => $postData['kategori_id'],
                'petugas_id' => $petugas->id,
                'status' => $postData['status'],
                'created_at' => now(),
            ]);

            // Buat galery untuk setiap post
            $galery = Galery::create([
                'post_id' => $post->id,
                'position' => 1,
                'status' => 1,
            ]);

            // Buat foto dummy (karena kita belum punya file foto asli)
            // Foto akan ditampilkan sebagai placeholder
        }
    }
};