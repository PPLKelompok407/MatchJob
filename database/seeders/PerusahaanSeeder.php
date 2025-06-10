<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $location_types = ['on-site', 'hybrid', 'remote'];
        
        $perusahaan = [
            // Teknologi & Telekomunikasi
            [
                'nama' => 'PT Telkom Indonesia',
                'alamat' => 'Gang Suniaraja, Braga, Sumur Bandung, Bandung City, West Java, Java, 40111, Indonesia',
                'bagian' => 'Software Development',
                'fokus' => 'Teknologi & Telekomunikasi',
                'location_type' => 'hybrid',
                'start_date' => '1995-05-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'PT LEN Industri',
                'alamat' => 'Metro Calistro, Jl. Soekarno Hatta, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141, Jalan Soekarno Hatta, Jatimulyo, Malang, Kota Malang, East Java, Java, 65141, Indonesia',
                'bagian' => 'Hardware Engineering',
                'fokus' => 'Teknologi & Telekomunikasi',
                'location_type' => 'on-site',
                'start_date' => '1991-08-22',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Game & Creative Tech
            [
                'nama' => 'Agate Studio',
                'alamat' => 'Jl.Cipedes Tengah II B No 2, 2, Jalan Cipedes Tengah II B, Gegerkalong, Sukajadi, Bandung City, West Java, Java, 40153, Indonesia',
                'bagian' => 'Game Design',
                'fokus' => 'Game & Creative Tech',
                'location_type' => 'remote',
                'start_date' => '2009-04-12',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Digital Happiness',
                'alamat' => 'Jalan Dokter Setiabudi, Isola, Sukajadi, Bandung City, West Java, Java, 40143, Indonesia',
                'bagian' => 'Animation & 3D Modeling',
                'fokus' => 'Game & Creative Tech',
                'location_type' => 'hybrid',
                'start_date' => '2013-02-28',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Startup & Incubator
            [
                'nama' => 'Bandung Digital Valley',
                'alamat' => 'Jl.Cipedes Tengah II B No 2, 2, Jalan Cipedes Tengah II B, Gegerkalong, Sukajadi, Bandung City, West Java, Java, 40153, Indonesia',
                'bagian' => 'Business Development',
                'fokus' => 'Startup & Incubator',
                'location_type' => 'on-site',
                'start_date' => '2011-09-05',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Impact Hub Bandung',
                'alamat' => 'Jalan L.L. RE. Martadinata, Citarum, Bandung Wetan, Bandung City, West Java, Java, 40117, Indonesia',
                'bagian' => 'Marketing & Communications',
                'fokus' => 'Startup & Incubator',
                'location_type' => 'on-site',
                'start_date' => '2016-07-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Automotive
            [
                'nama' => 'PT Toyota Astra Motor',
                'alamat' => 'Soekarno Hatta, East Kotawaringin, Central Kalimantan, Kalimantan, 74325, Indonesia',
                'bagian' => 'Production Engineering',
                'fokus' => 'Automotive',
                'location_type' => 'on-site',
                'start_date' => '1987-03-09',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'PT Honda Prospect Motor',
                'alamat' => 'Indonesian Old Cinema Museum, Jl. Soekarno Hatta No.45, Mojolangu, Kec. Lowokwaru, Kota Malang, Jawa Timur, Jalan Soekarno-Hatta, Mojolangu, Malang, Kota Malang, East Java, Java, 65142, Indonesia',
                'bagian' => 'Quality Control',
                'fokus' => 'Automotive',
                'location_type' => 'on-site',
                'start_date' => '1994-11-20',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Car Dealership
            [
                'nama' => 'Auto2000 Bandung Soekarno Hatta',
                'alamat' => 'Soekarno Hatta, East Kotawaringin, Central Kalimantan, Kalimantan, 74325, Indonesia',
                'bagian' => 'Sales & Marketing',
                'fokus' => 'Car Dealership',
                'location_type' => 'on-site',
                'start_date' => '2001-12-07',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Honda Prima Dealer Resmi',
                'alamat' => 'Jalan Raya Pajajaran, Bogor Timur, Bogor, West Java, Java, 16143, Indonesia',
                'bagian' => 'Customer Relations',
                'fokus' => 'Car Dealership',
                'location_type' => 'on-site',
                'start_date' => '2005-08-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Auto Repair
            [
                'nama' => 'Bengkel Mobil Beres',
                'alamat' => 'Ruko Surapati Core, Pasirlayung, Cibeunying Kidul, Bandung City, West Java, Java, Indonesia',
                'bagian' => 'Mechanical Engineering',
                'fokus' => 'Auto Repair',
                'location_type' => 'on-site',
                'start_date' => '2003-06-10',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Doctor Mobil Bandung',
                'alamat' => 'Jl. Jurang, Jalan Jurang, Pasteur, Sukasari, Bandung City, West Java, Java, 40161, Indonesia',
                'bagian' => 'Diagnostic Specialist',
                'fokus' => 'Auto Repair',
                'location_type' => 'on-site',
                'start_date' => '2010-04-22',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Pharmaceutical
            [
                'nama' => 'PT Bio Farma',
                'alamat' => 'Jl. Jurang, Jalan Jurang, Pasteur, Sukasari, Bandung City, West Java, Java, 40161, Indonesia',
                'bagian' => 'Research & Development',
                'fokus' => 'Pharmaceutical',
                'location_type' => 'hybrid',
                'start_date' => '1980-05-19',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'PT Kimia Farma Tbk',
                'alamat' => 'Pajajaran, Cicendo, Bandung City, West Java, Java, Indonesia',
                'bagian' => 'Production & Quality Assurance',
                'fokus' => 'Pharmaceutical',
                'location_type' => 'hybrid',
                'start_date' => '1975-07-30',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Food & Beverage - Restaurants
            [
                'nama' => 'The Valley Bistro Cafe',
                'alamat' => 'Jalan Lembah Pakar Timur, Ciburial, Kabupaten Bandung, West Java, Java, 40119, Indonesia',
                'bagian' => 'Culinary & Food Service',
                'fokus' => 'Food & Beverage - Restaurants',
                'location_type' => 'on-site',
                'start_date' => '2018-09-17',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Kopi Toko Djawa',
                'alamat' => 'Braga, Sumur Bandung, Bandung City, West Java, Java, 40111, Indonesia',
                'bagian' => 'Barista & Coffee Operations',
                'fokus' => 'Food & Beverage - Restaurants',
                'location_type' => 'on-site',
                'start_date' => '2015-11-05',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Food & Beverage - Industry
            [
                'nama' => 'PT Indofood CBP Sukses Makmur Tbk',
                'alamat' => 'Indonesian Old Cinema Museum, Jl. Soekarno Hatta No.45, Mojolangu, Kec. Lowokwaru, Kota Malang, Jawa Timur, Jalan Soekarno-Hatta, Mojolangu, Malang, Kota Malang, East Java, Java, 65142, Indonesia',
                'bagian' => 'Food Processing & Technology',
                'fokus' => 'Food & Beverage - Industry',
                'location_type' => 'hybrid',
                'start_date' => '1990-02-21',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'PT Ultra Jaya Milk Industry Tbk',
                'alamat' => 'Jalan Raya Cimareme, Margajaya, West Bandung, West Java, Java, 40552, Indonesia',
                'bagian' => 'Dairy Production & Processing',
                'fokus' => 'Food & Beverage - Industry',
                'location_type' => 'on-site',
                'start_date' => '1982-09-04',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Banking
            [
                'nama' => 'Bank Indonesia (BI) Kantor Perwakilan Jawa Barat',
                'alamat' => 'JL Bar, Avenida do Loureiro, Louleiro, Delães, Vila Nova de Famalicão, Braga, 4765-620, Portugal',
                'bagian' => 'Financial Analysis',
                'fokus' => 'Banking',
                'location_type' => 'hybrid',
                'start_date' => '1953-06-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Bank Mandiri Area Bandung',
                'alamat' => 'Jl. Jawa/Jl. Sumatra, Jalan Sumatra, Merdeka, Sumur Bandung, Bandung City, West Java, Java, 40111, Indonesia',
                'bagian' => 'Treasury & Investment',
                'fokus' => 'Banking',
                'location_type' => 'hybrid',
                'start_date' => '1999-10-02',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // E-Commerce
            [
                'nama' => 'Tokopedia Bandung Office',
                'alamat' => 'Jalan Dipati Ukur, Banjar, West Java, Java, 46311, Indonesia',
                'bagian' => 'UI/UX Design',
                'fokus' => 'E-Commerce',
                'location_type' => 'remote',
                'start_date' => '2014-05-12',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Bukalapak Bandung Office',
                'alamat' => 'Buah Batu, Kujangsari, Bandung Kidul, Cipagalo, Kabupaten Bandung, West Java, Java, 40257, Indonesia',
                'bagian' => 'Backend Development',
                'fokus' => 'E-Commerce',
                'location_type' => 'remote',
                'start_date' => '2015-08-25',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Higher Education
            [
                'nama' => 'Institut Teknologi Bandung (ITB)',
                'alamat' => 'Jalan Ganesha, Lebak Siliwangi, Coblong, Bandung City, West Java, Java, 40132, Indonesia',
                'bagian' => 'Computer Science Faculty',
                'fokus' => 'Higher Education',
                'location_type' => 'hybrid',
                'start_date' => '1920-07-03',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Universitas Padjadjaran (UNPAD)',
                'alamat' => 'Jalan Dipati Ukur, Banjar, West Java, Java, 46311, Indonesia',
                'bagian' => 'Medical Research',
                'fokus' => 'Higher Education',
                'location_type' => 'hybrid',
                'start_date' => '1957-09-11',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Research Institutions
            [
                'nama' => 'Lembaga Ilmu Pengetahuan Indonesia (LIPI) Bandung',
                'alamat' => 'Jalan Sangkuriang, Dago, Coblong, Bandung City, West Java, Java, 40132, Indonesia',
                'bagian' => 'Scientific Research',
                'fokus' => 'Research Institutions',
                'location_type' => 'hybrid',
                'start_date' => '1967-08-23',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Badan Riset dan Inovasi Nasional (BRIN) Bandung',
                'alamat' => 'Cisitu Lama, Dago, Coblong, Bandung City, West Java, Java, Indonesia',
                'bagian' => 'Innovation & Technology Transfer',
                'fokus' => 'Research Institutions',
                'location_type' => 'hybrid',
                'start_date' => '2021-04-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Hospitality
            [
                'nama' => 'The Trans Luxury Hotel',
                'alamat' => 'Jl. Jend. Gatot Subroto, Baledono, Purworejo, Central Java, Java, 54118, Indonesia',
                'bagian' => 'Hotel Management',
                'fokus' => 'Hospitality',
                'location_type' => 'on-site',
                'start_date' => '2012-06-20',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Padma Hotel Bandung',
                'alamat' => 'Jalan Ranca Bentang, Kawasan Industri Cimahi Selatan, Cibeureum, Cimahi, West Java, Java, 40535, Indonesia',
                'bagian' => 'Guest Relations',
                'fokus' => 'Hospitality',
                'location_type' => 'on-site',
                'start_date' => '2009-11-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        
        DB::table('perusahaan')->insert($perusahaan);
    }
}