<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perusahaan - MatchJob</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('component.navbar')
    <div class="min-h-screen z-10">
        <div class="bg-gradient-to-r bg-[#EDF2FF] py-12 px-6 md:px-12 lg:px-20 overflow-hidden">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-2 hidden md:block">
                    <img class="w-[100px]" src="{{ asset('perusahaan1_icon.png') }}" alt="">
                </div>
                <div class="md:col-span-8 text-center text-[#25324B]">
                    <h1 class="text-[24px] font-[600] mb-4">Langkah Awal Menuju <span class="text-[#4880FF]">Karier Impian</span> Dimulai di Sini.</h1>
                    <h3 class="text-[20px] font-[600] mt-[-20px]">Temukan <span class="text-[#4880FF]">perusahaan</span> yang <span class="text-[#4880FF]">tepat</span> untuk Anda</h3>
                </div>
                <div class="md:col-span-2 hidden md:block">
                    <img class="w-full max-w-[200px] ml-auto" src="{{ asset('perusahaan2_icon.png') }}" alt="">
                </div>
            </div>
            
        </div>
        
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="mb-8">
                <form action="{{ route('perusahaan.list') }}" method="GET" class="flex items-center w-full">
                    <input type="text" name="search" placeholder="Cari perusahaan" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500" value="{{ request('search') }}" />
                    <button type="submit" class="bg-[#4880FF] text-white font-medium px-6 py-2 rounded-md ml-2 shadow-sm hover:bg-blue-600 transition-colors">Cari</button>
                </form>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Rekomendasi <span class="text-[#4880FF]">perusahaan</span> untuk Anda</h2>
            
            <div class="grid grid-cols-1 gap-6">
                @forelse($perusahaan as $company)
                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 bg-gray-100 rounded-md flex items-center justify-center">
                                <span class="font-bold text-gray-500">{{ substr($company->nama, 0, 2) }}</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $company->nama }}</h3>
                                <p class="text-gray-600">{{ $company->bagian }}</p>
                                <p class="text-gray-500">{{ $company->alamat }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-gray-700 font-medium">
                                @if($company->location_type == 'remote')
                                    Remote
                                @elseif($company->location_type == 'hybrid')
                                    Hybrid
                                @else
                                    On-Site
                                @endif
                            </span>
                            <span class="text-gray-500">{{ \Carbon\Carbon::parse($company->start_date)->format('d F Y') }}</span>
                            <a href="#" class="mt-2 bg-[#4880FF] text-white px-4 py-2 rounded-lg inline-flex items-center gap-2">
                                Details
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <p class="text-center text-gray-500">Tidak ada perusahaan yang ditemukan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('component.footer')
</body>
</html>