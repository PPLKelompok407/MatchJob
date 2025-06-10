@php
// Menggunakan facade Auth dari Laravel untuk autentikasi pengguna
use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Perusahaan - MatchJob</title>
    <!-- Memuat library Tailwind CSS dari CDN untuk styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Menyisipkan komponen navbar dari folder component -->
    @include('component.navbar')

    <div class="bg-gradient-to-r bg-[#EDF2FF] h-[155px] pt-4 px-6 md:px-12 lg:px-20 overflow-hidden">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            <div class="md:col-span-2 hidden md:block">
                <img class="w-[90px] mt-[30px]" src="{{ asset('perusahaan1_icon.png') }}" alt="">
            </div>
            <div class="md:col-span-8 text-center text-[#25324B]">
                <h1 class="text-[24px] font-[600] mb-4">Langkah Awal Menuju <span class="text-[#4880FF]">Karier Impian</span> Dimulai di Sini.</h1>
                <h3 class="text-[20px] font-[600] mt-[-20px]">Temukan <span class="text-[#4880FF]">perusahaan</span> yang <span class="text-[#4880FF]">tepat</span> untuk Anda</h3>
            </div>
            <div class="md:col-span-2 hidden md:block">
                <img class="w-[141px] h-[96px] ml-auto" src="{{ asset('perusahaan2_icon.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- aku saprina hihi -->
    
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Back button -->
        <a href="{{ url()->previous() }}" class="inline-flex items-center mb-6 text-gray-700 hover:text-blue-600">
            <i class="fas fa-arrow-left mr-2"></i>
        </a>
        
        <!-- Main content -->
        <div>
            <div class="flex flex-col md:flex-row justify-between">
                <!-- Left column - Company details -->
                <div class="md:w-7/12">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $perusahaan->nama }}</h1>
                    <h2 class="text-xl font-medium text-gray-700 mb-6">{{ $perusahaan->bagian }} Intern Staff</h2>
                    
                    <div class="space-y-4 mb-6">
                        <!-- Location -->
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-lg mr-4">
                                <i class="fas fa-map-marker-alt text-gray-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-700">{{ $perusahaan->alamat }}</p>
                            </div>
                        </div>
                        
                        <!-- Focus -->
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-lg mr-4">
                                <i class="fas fa-briefcase text-gray-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-700">{{ $perusahaan->fokus }}</p>
                            </div>
                        </div>
                        
                        <!-- Work type -->
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-lg mr-4">
                                <i class="fas fa-clock text-gray-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-700 capitalize">{{ $perusahaan->location_type }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right column - Apply button and match info -->
                <div class="md:w-4/12">
                    <!-- Apply button -->
                    <a href="#" class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-3 px-4 rounded-lg font-medium mb-6 transition duration-300">
                        Lamar Sekarang
                    </a>
                    
                    <!-- Match info box -->
                    <div class="bg-amber-50 border border-amber-100 rounded-lg p-4">
                        <h3 class="font-medium text-gray-800 mb-3">Jarak kantor dari rumah mu</h3>
                        <div class="flex items-center mb-4">
                            <i class="fas fa-location-dot mr-2 text-gray-600"></i>
                            <span class="font-medium">{{ $distance }} KM</span>
                        </div>
                        
                        <h3 class="font-medium text-gray-800 mb-3">Keakuratan posisi dengan hasil tesmu</h3>
                        
                        <!-- Test match percentages -->
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-bullseye mr-2 text-gray-600"></i>
                                <span>Test Bakat {{ $testBakatScore }}%</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-bullseye mr-2 text-gray-600"></i>
                                <span>Tes Riasec {{ $testRiasecScore }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-[88px] flex flex-col gap-[76px]">
                <div class="flex flex-col gap-[26px]">
                    <h3 class="text-[24px] font-[700] text-[#25324B]">Tentang Pekerjaan</h3>
                    <p class="text-[16px] font-[400] text-[#25324B]">
                    Sebagai Quality Assurance Intern Staff di PT. Telkom Indonesia, Anda akan membantu menguji 
                    dan memastikan kualitas produk digital perusahaan. Tugas mencakup pembuatan dan pelaksanaan 
                    skenario pengujian, identifikasi bug, serta koordinasi dengan tim pengembang. Anda juga akan 
                    memantau performa aplikasi dan terlibat dalam proses pengembangan perangkat lunak untuk 
                    memastikan hasil sesuai standar mutu perusahaan.
                    </p>
                </div>
                <div class="flex flex-col gap-[26px]">
                    <h3 class="text-[24px] font-[700] text-[#25324B]">Tentang Perusahaan</h3>
                    <ul class="list-disc ml-6">
                        <li>Membuat dan menjalankan test case untuk produk digital.</li>
                        <li>Melakukan pengujian fungsional, regresi, dan performa sistem.</li>
                        <li>Mengidentifikasi, mencatat, dan melaporkan bug atau error.</li>
                        <li>Berkoordinasi dengan tim pengembang untuk perbaikan isu teknis.</li>
                        <li>Membantu memastikan kualitas produk sesuai standar perusahaan.</li>
                        <li>Mendokumentasikan hasil pengujian secara sistematis.</li>
                    </ul>
                </div>
                <div class="flex flex-col gap-[26px]">
                    <h3 class="text-[24px] font-[700] text-[#25324B]">Syarat dan Ketentuan</h3>
                    <ul class="list-disc ml-6">
                        <li>Mahasiswa aktif atau fresh graduate dari jurusan Teknik Informatika, Sistem Informasi, atau bidang terkait.</li>
                        <li>Memahami dasar pengujian perangkat lunak (software testing).</li>
                        <li>Mampu membuat test case dan menggunakan tools QA (misalnya: JIRA, Postman, Selenium, dll.).</li>
                        <li>Memiliki kemampuan analisis dan problem-solving yang baik.</li>
                        <li>Teliti, detail, dan mampu bekerja secara tim maupun mandiri.</li>
                        <li>Bersedia menjalani program magang dalam jangka waktu yang ditentukan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>
</html>