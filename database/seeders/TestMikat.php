<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestMikat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'pertanyaan' => 'Gambar apa yang pertama kali anda lihat?',
                'opsi_1' => 'Orang main alat music',
                'opsi_2' => 'Orang berbaju Putih',
                'opsi_3' => 'Orang berbaju merah',
                'opsi_4' => 'Wajah',
            ],
            [
                'pertanyaan' => 'Saat bertemu dengan orang lain apa yang anda lihat tentang dia?',
                'opsi_1' => 'Wajahnya',
                'opsi_2' => 'Namanya',
                'opsi_3' => 'Apa yang sudah dilakukan dengan dia',
                'opsi_4' => 'Apa yang dirasakan bersama dia?',
            ],
            [
                'pertanyaan' => 'Tutup mata anda dan bayangkan “TIGA”, apa yang anda lihat?',
                'opsi_1' => 'Huruf T-I-G-A',
                'opsi_2' => 'Angka 3',
                'opsi_3' => 'Benda, binatang, atau orang yang berjumlah tiga',
                'opsi_4' => 'Tiga macam warna',
            ],
            [
                'pertanyaan' => 'Jika Anda memiliki waktu tanpa batas, apa yang akan Anda lakukan?',
                'opsi_1' => 'Mempelajari sesuatu yang baru',
                'opsi_2' => 'Mengembangkan proyek kreatif',
                'opsi_3' => 'Berkontribusi ke komunitas',
                'opsi_4' => 'Menjalani petualangan',
            ],
            [
                'pertanyaan' => 'Apa aktivitas yang paling Anda nikmati di waktu luang?',
                'opsi_1' => 'Membaca buku',
                'opsi_2' => 'Menggambar atau melukis',
                'opsi_3' => 'Berolahraga',
                'opsi_4' => 'Bekerja di proyek DIY',
            ],
            [
                'pertanyaan' => 'Dalam kelompok, peran apa yang biasanya Anda ambil?',
                'opsi_1' => 'Pemimpin yang mengatur dan memimpin',
                'opsi_2' => 'Pemberi ide kreatif',
                'opsi_3' => 'Pendengar yang baik dan penghubung antar anggota tim',
                'opsi_4' => 'Pelaksana yang menyelesaikan tugas',
            ],
            [
                'pertanyaan' => 'Apa keterampilan yang ingin Anda kembangkan lebih lanjut?',
                'opsi_1' => 'Negosiasi dan manajemen konflik',
                'opsi_2' => 'Kemampuan teknis',
                'opsi_3' => 'Presentasi dan komunikasi public',
                'opsi_4' => 'Analisis data atau riset pasar',
            ],
            [
                'pertanyaan' => 'Di bidang mana Anda lebih suka bekerja?',
                'opsi_1' => 'Kreatif (seni, desain, penulisan)',
                'opsi_2' => 'Sosial (psikologi, pendidikan, bantuan sosial)',
                'opsi_3' => 'Teknologi (IT, engineering, sains)',
                'opsi_4' => 'Bisnis (manajemen, pemasaran, keuangan)',
            ],
            [
                'pertanyaan' => 'Apa yang paling memotivasi Anda dalam pekerjaan?',
                'opsi_1' => 'Menciptakan sesuatu yang baru',
                'opsi_2' => 'Membantu orang lain',
                'opsi_3' => 'Memecahkan masalah kompleks',
                'opsi_4' => 'Mencapai target dan mengelola proyek',
            ],
            [
                'pertanyaan' => 'Pekerjaan apa yang paling Anda impikan?',
                'opsi_1' => 'Seniman atau desainer',
                'opsi_2' => 'Psikolog atau konselor',
                'opsi_3' => 'Insinyur atau ilmuwan',
                'opsi_4' => 'Manajer atau pemimpin bisnis',
            ],
            [
                'pertanyaan' => 'Bagaimana pandangan Anda tentang kerja di bawah tekanan?',
                'opsi_1' => 'Saya dapat bekerja dengan baik dan terkendali',
                'opsi_2' => 'Saya perlu waktu untuk menyesuaikan diri',
                'opsi_3' => 'Saya lebih suka suasana kerja yang santai',
                'opsi_4' => 'Terkadang saya merasa tertekan tetapi mampu mengatasinya',
            ],
            [
                'pertanyaan' => 'Apa yang Anda anggap sebagai kekuatan utama Anda?',
                'opsi_1' => 'Kreativitas',
                'opsi_2' => 'Kemampuan interpersonal',
                'opsi_3' => 'Kemampuan analitis',
                'opsi_4' => 'Keterampilan teknis',
            ],
            [
                'pertanyaan' => 'Apa yang paling Anda harapkan dari pekerjaan Anda di masa depan?',
                'opsi_1' => 'Kepuasan dan pengakuan pribadi',
                'opsi_2' => 'Dampak positif pada orang lain',
                'opsi_3' => 'Pertumbuhan dan perkembangan karir',
                'opsi_4' => 'Kebebasan dan fleksibilitas',
            ],
            [
                'pertanyaan' => 'Ketika menghadapi tantangan atau kesulitan, bagaimana Anda biasanya merespons?',
                'opsi_1' => 'Mencari solusi secara langsung dan mencoba mencari jalan keluar.',
                'opsi_2' => 'Mendiskusikan masalah dengan orang lain untuk mendapatkan perspektif baru',
                'opsi_3' => 'Mengambil waktu sejenak untuk merenung sebelum mengambil Tindakan',
                'opsi_4' => 'Mencari dukungan dari teman atau keluarga untuk membantu mengatasi situasi.',
            ],
            [
                'pertanyaan' => 'Apa yang Anda harapkan untuk capai dalam lima tahun ke depan?',
                'opsi_1' => 'Mencapai posisi tinggi dalam karir yang saya pilih',
                'opsi_2' => 'Mengembangkan keterampilan baru dan mengikuti pendidikan lanjutan.',
                'opsi_3' => 'Menjadi pengaruh positif dalam komunitas atau bidang yang saya geluti.',
                'opsi_4' => 'Menemukan keseimbangan yang baik antara kehidupan pribadi dan pekerjaan.',
            ],
        ];

        foreach ($data as $item) {
            DB::table('test_mikat')->insert($item);
        }
    }
}
