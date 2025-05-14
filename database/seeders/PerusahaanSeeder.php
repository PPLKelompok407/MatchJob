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
                'alamat' => 'Jl. Japati No.1, Bandung 40133',
                'bagian' => 'Software Development',
                'location_type' => 'hybrid',
                'start_date' => '1995-05-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'PT LEN Industri',
                'alamat' => 'Jl. Soekarno Hatta No.442, Bandung 40254',
                'bagian' => 'Hardware Engineering',
                'location_type' => 'on-site',
                'start_date' => '1991-08-22',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Game & Creative Tech
            [
                'nama' => 'Agate Studio',
                'alamat' => 'Jl. Gegerkalong Hilir No.47, Bandung',
                'bagian' => 'Game Design',
                'location_type' => 'remote',
                'start_date' => '2009-04-12',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Digital Happiness',
                'alamat' => 'Jl. Setiabudi No.75, Bandung',
                'bagian' => 'Animation & 3D Modeling',
                'location_type' => 'hybrid',
                'start_date' => '2013-02-28',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Startup & Incubator
            [
                'nama' => 'Bandung Digital Valley',
                'alamat' => 'Jl. Gegerkalong Hilir No.47, Bandung',
                'bagian' => 'Business Development',
                'location_type' => 'on-site',
                'start_date' => '2011-09-05',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Impact Hub Bandung',
                'alamat' => 'Jl. Riau No.88, Bandung',
                'bagian' => 'Marketing & Communications',
                'location_type' => 'on-site',
                'start_date' => '2016-07-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Automotive
            [
                'nama' => 'PT Toyota Astra Motor',
                'alamat' => 'Jl. Soekarno Hatta No.585, Bandung',
                'bagian' => 'Production Engineering',
                'location_type' => 'on-site',
                'start_date' => '1987-03-09',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'PT Honda Prospect Motor',
                'alamat' => 'Jl. Soekarno Hatta No.597, Bandung',
                'bagian' => 'Quality Control',
                'location_type' => 'on-site',
                'start_date' => '1994-11-20',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Car Dealership
            [
                'nama' => 'Auto2000 Bandung Soekarno Hatta',
                'alamat' => 'Jl. Soekarno Hatta No.375, Bandung',
                'bagian' => 'Sales & Marketing',
                'location_type' => 'on-site',
                'start_date' => '2001-12-07',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Honda Prima Dealer Resmi',
                'alamat' => 'Jl. Raya Pajajaran No.90, Bandung',
                'bagian' => 'Customer Relations',
                'location_type' => 'on-site',
                'start_date' => '2005-08-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Auto Repair
            [
                'nama' => 'Bengkel Mobil Beres',
                'alamat' => 'Jl. Surapati No.50, Bandung',
                'bagian' => 'Mechanical Engineering',
                'location_type' => 'on-site',
                'start_date' => '2003-06-10',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Doctor Mobil Bandung',
                'alamat' => 'Jl. Pasteur No.26, Bandung',
                'bagian' => 'Diagnostic Specialist',
                'location_type' => 'on-site',
                'start_date' => '2010-04-22',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Pharmaceutical
            [
                'nama' => 'PT Bio Farma',
                'alamat' => 'Jl. Pasteur No.28, Bandung',
                'bagian' => 'Research & Development',
                'location_type' => 'hybrid',
                'start_date' => '1980-05-19',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'PT Kimia Farma Tbk',
                'alamat' => 'Jl. Pajajaran No.43, Bandung',
                'bagian' => 'Production & Quality Assurance',
                'location_type' => 'hybrid',
                'start_date' => '1975-07-30',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Food & Beverage - Restaurants
            [
                'nama' => 'The Valley Bistro Cafe',
                'alamat' => 'Jl. Lembah Pakar Timur No.28, Bandung',
                'bagian' => 'Culinary & Food Service',
                'location_type' => 'on-site',
                'start_date' => '2018-09-17',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Kopi Toko Djawa',
                'alamat' => 'Jl. Braga No.79, Bandung',
                'bagian' => 'Barista & Coffee Operations',
                'location_type' => 'on-site',
                'start_date' => '2015-11-05',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Food & Beverage - Industry
            [
                'nama' => 'PT Indofood CBP Sukses Makmur Tbk',
                'alamat' => 'Jl. Soekarno Hatta No.525, Bandung',
                'bagian' => 'Food Processing & Technology',
                'location_type' => 'hybrid',
                'start_date' => '1990-02-21',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'PT Ultra Jaya Milk Industry Tbk',
                'alamat' => 'Jl. Raya Cimareme No.131, Padalarang',
                'bagian' => 'Dairy Production & Processing',
                'location_type' => 'on-site',
                'start_date' => '1982-09-04',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Banking
            [
                'nama' => 'Bank Indonesia (BI) Kantor Perwakilan Jawa Barat',
                'alamat' => 'Jl. Braga No.108, Bandung',
                'bagian' => 'Financial Analysis',
                'location_type' => 'hybrid',
                'start_date' => '1953-06-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Bank Mandiri Area Bandung',
                'alamat' => 'Jl. Merdeka No.40, Bandung',
                'bagian' => 'Treasury & Investment',
                'location_type' => 'hybrid',
                'start_date' => '1999-10-02',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // E-Commerce
            [
                'nama' => 'Tokopedia Bandung Office',
                'alamat' => 'Jl. Dipati Ukur No.35, Bandung',
                'bagian' => 'UI/UX Design',
                'location_type' => 'remote',
                'start_date' => '2014-05-12',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Bukalapak Bandung Office',
                'alamat' => 'Jl. Buah Batu No.99, Bandung',
                'bagian' => 'Backend Development',
                'location_type' => 'remote',
                'start_date' => '2015-08-25',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Higher Education
            [
                'nama' => 'Institut Teknologi Bandung (ITB)',
                'alamat' => 'Jl. Ganesha No.10, Bandung',
                'bagian' => 'Computer Science Faculty',
                'location_type' => 'hybrid',
                'start_date' => '1920-07-03',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Universitas Padjadjaran (UNPAD)',
                'alamat' => 'Jl. Dipati Ukur No.35, Bandung',
                'bagian' => 'Medical Research',
                'location_type' => 'hybrid',
                'start_date' => '1957-09-11',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Research Institutions
            [
                'nama' => 'Lembaga Ilmu Pengetahuan Indonesia (LIPI) Bandung',
                'alamat' => 'Jl. Sangkuriang No.21, Bandung',
                'bagian' => 'Scientific Research',
                'location_type' => 'hybrid',
                'start_date' => '1967-08-23',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Badan Riset dan Inovasi Nasional (BRIN) Bandung',
                'alamat' => 'Jl. Cisitu Lama No.21, Bandung',
                'bagian' => 'Innovation & Technology Transfer',
                'location_type' => 'hybrid',
                'start_date' => '2021-04-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Hospitality
            [
                'nama' => 'The Trans Luxury Hotel',
                'alamat' => 'Jl. Gatot Subroto No.289, Bandung',
                'bagian' => 'Hotel Management',
                'location_type' => 'on-site',
                'start_date' => '2012-06-20',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Padma Hotel Bandung',
                'alamat' => 'Jl. Ranca Bentang No.56-58, Bandung',
                'bagian' => 'Guest Relations',
                'location_type' => 'on-site',
                'start_date' => '2009-11-15',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        
        DB::table('perusahaan')->insert($perusahaan);
    }
}