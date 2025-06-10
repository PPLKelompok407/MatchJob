<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Artikel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artikel = [
            [
                'link' => 'https://www.recruitfirst.co.id/id/blog/hard-skill-yang-dibutuhkan-dalam-dunia-kerja/',
                'image' => 'artikel/artikel_hard_skill.png',
                'category' => 'Hard Skill',
                'judul' => '5 Hard Skill yang Dibutuhkan dalam Dunia Kerja saat ini',
                'description' => 'Class, launched less than a year ago by Blackboard co-founder Michael Chasen, integrates...',
            ],
            [
                'link' => 'https://ruanginspirasimu.com/2025/01/22/pentingnya-soft-skill-hard-skill-dan-life-skill-dalam-pengembangan-diri-dan-karir/',
                'image' => 'artikel/artikel_soft_skill.png',
                'category' => 'Soft Skill',
                'judul' => 'Pentingnya Soft Skill dalam Pengembangan Diri dan Karir',
                'description' => 'Class, launched less than a year ago by Blackboard co-founder Michael Chasen, integrates...',
            ],
            [
                'link' => 'https://www.ruangkerja.id/blog/strategi-pengembangan-karir',
                'image' => 'artikel/artikel_tutorial.png',
                'category' => 'Tutorial',
                'judul' => 'Strategi Pengembangan Karir yang Efektif untuk Karyawan',
                'description' => 'Career development atau pengembangan karir adalah serangkaian langkah atau tahapan yang...',
            ],
            [
                'link' => 'https://lifestyle.kompas.com/read/2025/01/08/133500720/5-tren-karier-2025-kecerdasan-buatan-hingga-freelance',
                'image' => 'artikel/artikel_berita.jpg',
                'category' => 'Berita',
                'judul' => '5 Tren Karier 2025, Kecerdasan Buatan hingga Freelance',
                'description' => 'Para pencari kerja harus mempelajari keterampilan baru untuk menghadapi tantangan masa...',
            ],
            [
                'link' => 'https://www.karier.mu/blog/umum/tips-karir-agar-sukses-kerja/',
                'image' => 'artikel/artikel_tips.jpg',
                'category' => 'Tips',
                'judul' => 'Ingin Sukses Kerja? 7 Tips Karir yang Bisa Kamu Coba dari Sekarang',
                'description' => 'Tips karir akan membantu seseorang lebih cepat mencapai level prestasi yang diinginkan...',
            ],
            [
                'link' => 'https://fah.uinjkt.ac.id/id/aicif-2025-virtual-career-fair-terbesar-di-indonesia-hadirkan-ratusan-lowongan-kerja-dan-magang-dari-perusahaan-ternama',
                'image' => 'artikel/artikel_event.jpg',
                'category' => 'Event',
                'judul' => 'Virtual Career Fair Terbesar di Indonesia Hadirkan Ratusan Lowongan Kerja',
                'description' => 'AICIF 2025 merupakan acara yang diselenggarakan oleh Pusat Karier UIN Syarif Hidayatullah...',
            ],
        ];

        DB::table('artikel')->insert($artikel);
    }
}
