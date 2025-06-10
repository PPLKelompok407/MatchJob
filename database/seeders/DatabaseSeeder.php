<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Only create the test user if it doesn't exist
        if (!User::where('email', 'ajam@gmail.com')->exists()) {
            User::factory()->create([
                'name' => 'ajam_gamink',
                'email' => 'ajam@gmail.com',
                'notelp' => 628138523522,
                'password' =>  'qwe123qwe',
                'jenisa_kelamin' => 'Laki-laki',
                'riwayat_pendidikan' => 'S1 Sistem Informasi Telkom University',
                'tempat_tanggal_lahir' => 'Bekasi, 25 september 2004',
                'alamat' => 'Jalan Pecinan Lama, Braga, Sumur Bandung, Bandung City, West Java, Java, 40181, Indonesia',
                'riwayat_kerja' => 'Ngoding sampai tamat',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Run additional seeders
        $this->call([
            AdminSeeder::class,
            Artikel::class,
            TestMikat::class,
            TestSosec::class,
            PerusahaanSeeder::class
        ]);
    }
}
