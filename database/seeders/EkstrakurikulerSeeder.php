<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekstrakurikulers = [
            [
                'nama' => 'Palang Merah Remaja (PMR)',
                'deskripsi' => 'Organisasi kepemudaan yang bergerak di bidang kesehatan dan kemanusiaan. PMR mengajarkan siswa tentang pertolongan pertama, kesehatan, dan kepedulian sosial.',
                'pembina' => 'Ibu Sari, S.Kep',
                'hari_kegiatan' => 'Rabu',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00',
                'tempat' => 'Ruang PMR',
                'status' => true,
            ],
            [
                'nama' => 'Paskibraka',
                'deskripsi' => 'Pasukan pengibar bendera yang melatih kedisiplinan dan nasionalisme. Paskibraka mengajarkan siswa tentang kedisiplinan, kepemimpinan, dan cinta tanah air.',
                'pembina' => 'Pak Budi, S.Pd',
                'hari_kegiatan' => 'Selasa',
                'jam_mulai' => '15:00',
                'jam_selesai' => '17:00',
                'tempat' => 'Lapangan Upacara',
                'status' => true,
            ],
            [
                'nama' => 'Pramuka',
                'deskripsi' => 'Gerakan kepanduan yang mengembangkan karakter dan keterampilan hidup. Pramuka mengajarkan siswa tentang kemandirian, kerja sama, dan keterampilan praktis.',
                'pembina' => 'Pak Agus, S.Pd',
                'hari_kegiatan' => 'Sabtu',
                'jam_mulai' => '08:00',
                'jam_selesai' => '12:00',
                'tempat' => 'Lapangan Pramuka',
                'status' => true,
            ],
            [
                'nama' => 'Futsal',
                'deskripsi' => 'Olahraga sepak bola dalam ruangan yang mengembangkan teamwork dan skill. Futsal mengajarkan siswa tentang kerja sama tim, strategi, dan kebugaran fisik.',
                'pembina' => 'Pak Rudi, S.Pd',
                'hari_kegiatan' => 'Jumat',
                'jam_mulai' => '15:30',
                'jam_selesai' => '17:30',
                'tempat' => 'Lapangan Futsal',
                'status' => true,
            ],
            [
                'nama' => 'Basket',
                'deskripsi' => 'Olahraga basket yang mengembangkan koordinasi, kecepatan, dan strategi. Basket mengajarkan siswa tentang kerja sama tim dan sportivitas.',
                'pembina' => 'Pak Andi, S.Pd',
                'hari_kegiatan' => 'Kamis',
                'jam_mulai' => '16:00',
                'jam_selesai' => '18:00',
                'tempat' => 'Lapangan Basket',
                'status' => true,
            ],
            [
                'nama' => 'Voli',
                'deskripsi' => 'Olahraga voli yang mengembangkan refleks, koordinasi, dan kerja sama tim. Voli mengajarkan siswa tentang strategi permainan dan kebugaran fisik.',
                'pembina' => 'Ibu Rina, S.Pd',
                'hari_kegiatan' => 'Senin',
                'jam_mulai' => '15:00',
                'jam_selesai' => '17:00',
                'tempat' => 'Lapangan Voli',
                'status' => true,
            ],
            [
                'nama' => 'Teater',
                'deskripsi' => 'Seni pertunjukan yang mengembangkan kreativitas, kepercayaan diri, dan ekspresi diri. Teater mengajarkan siswa tentang seni peran dan komunikasi.',
                'pembina' => 'Ibu Maya, S.Sn',
                'hari_kegiatan' => 'Rabu',
                'jam_mulai' => '16:00',
                'jam_selesai' => '18:00',
                'tempat' => 'Aula Teater',
                'status' => true,
            ],
            [
                'nama' => 'Musik',
                'deskripsi' => 'Ekstrakurikuler musik yang mengembangkan bakat seni dan kreativitas. Musik mengajarkan siswa tentang berbagai alat musik dan teknik vokal.',
                'pembina' => 'Pak Dedi, S.Sn',
                'hari_kegiatan' => 'Jumat',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00',
                'tempat' => 'Ruang Musik',
                'status' => true,
            ],
        ];

        foreach ($ekstrakurikulers as $ekstrakurikuler) {
            Ekstrakurikuler::create($ekstrakurikuler);
        }
    }
}