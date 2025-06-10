<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSosec extends Seeder
{
    public function run()
    {
        $data = [
            'Saya senang bekerja dengan mesin atau peralatan teknis',
            'Saya lebih suka aktivitas fisik dan bekerja di luar ruangan',
            'Saya suka memperbaiki barang-barang yang rusak',
            'Saya senang menggunakan tangan untuk membuat atau memperbaiki sesuatu',
            'Saya lebih suka hasil yang konkret dan dapat diukur',
            'Saya suka memecahkan teka-teki dan masalah kompleks',
            'Saya tertarik melakukan penelitian dan eksperimen',
            'Saya senang menganalisis data dan informasi',
            'Saya suka mempelajari hal-hal baru secara mendalam',
            'Saya senang mengajukan pertanyaan dan mencari jawaban',
            'Saya suka mengekspresikan diri melalui seni',
            'Saya memiliki imajinasi yang kuat',
            'Saya senang menciptakan hal-hal yang original',
            'Saya tertarik dengan aktivitas yang membutuhkan kreativitas',
            'Saya suka bekerja dalam lingkungan yang tidak terlalu terstruktur',
            'Saya senang membantu dan mengajar orang lain',
            'Saya mudah berempati dengan perasaan orang lain',
            'Saya suka bekerja dalam tim',
            'Saya senang berkomunikasi dan berinteraksi dengan banyak orang',
            'Saya tertarik untuk memahami motivasi dan perilaku manusia',
            'Saya suka memimpin dan mempengaruhi orang lain',
            'Saya senang mengambil risiko dalam berbisnis',
            'Saya tertarik dengan penjualan dan pemasaran',
            'Saya suka membuat keputusan dan bertanggung jawab',
            'Saya senang bersaing dan mencapai target',
            'Saya suka mengatur dan mengorganisir',
            'Saya teliti dalam mengerjakan detail',
            'Saya senang mengikuti prosedur dan rutinitas yang jelas',
            'Saya nyaman bekerja dengan angka dan data',
            'Saya suka pekerjaan yang terstruktur dan predictable',
        ];

        foreach ($data as $pertanyaan) {
            DB::table('test_sosec')->insert([
                'pertanyaan' => $pertanyaan,
            ]);
        }
    }
}
