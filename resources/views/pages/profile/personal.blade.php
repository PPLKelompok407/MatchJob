<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#EDF2FF]">
    @include('component.navbar')
    
    {{-- Sidebar --}}
    @include('component.sidebar')

    <div class="mt-[53px] flex justify-center">
        <div class="flex flex-col">
            <div class="h-[50px] overflow-hidden">
                <img src="{{ asset('personal_card.png') }}" alt="" class="w-full object-cover">
            </div>

            <div class="personal-card bg-white rounded-b-2xl shadow-md p-6 mb-10 mt-[-1px]">
                <div class="flex flex-col md:flex-row items-start justify-center md:items-center mb-8 space-y-4 md:space-y-0">

                    <div class="flex items-center gap-[24px] mb-4">
                        <img src="{{ asset('profile.png') }}" alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 mb-[-35px] border-white -mt-10 shadow-md">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-500 text-sm">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    
                    <div class="md:ml-auto">
                        <a href="{{ route('pages.profile.editData') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition inline-block">
                            Edit
                        </a>
                    </div>
                </div>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div>
                        <div class="mb-6">
                            <h3 class="text-[16px] font-[400] mb-2">Nama Lengkap</h3>
                            <input type="text" name="" id="" placeholder="{{ auth()->user()->name }}" class="border border-gray-200 rounded-md p-3 bg-gray-50 w-[593px]" disabled>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-[16px] font-[400] mb-2">Jenis Kelamin</h3>
                            <div class="relative">
                                <select class="block appearance-none w-[593px] bg-gray-50 border border-gray-200 text-gray-400 py-3 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="gender" disabled>
                                    <option>{{ auth()->user()->jenisa_kelamin ?? 'Belum diisi' }}</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 pr-6">
                                    <img src="{{ asset('dropdown.png') }}" alt="" class="w-[24px] opacity-50">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-[16px] font-[400] mb-2">Riwayat Pendidikan</h3>
                            <input type="text" name="" id="" placeholder="{{ auth()->user()->riwayat_pendidikan ?? 'Belum diisi' }}" class="border border-gray-200 rounded-md p-3 bg-gray-50 w-[593px]" disabled>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div>
                        <div class="mb-6">
                            <h3 class="text-[16px] font-[400] mb-2">Tempat Tanggal Lahir</h3>
                            <input type="text" name="" id="" placeholder="{{ auth()->user()->tempat_tanggal_lahir ?? 'Belum diisi' }}" class="border border-gray-200 rounded-md p-3 bg-gray-50 w-[593px]" disabled>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-[16px] font-[400] mb-2">Alamat Lengkap</h3>
                            <input type="text" name="" id="" placeholder="{{ auth()->user()->alamat ?? 'Belum diisi' }}" class="border border-gray-200 rounded-md p-3 bg-gray-50 w-[593px]" disabled>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-[16px] font-[400] mb-2">Riwayat Kerja</h3>
                            <input type="text" name="" id="" placeholder="{{ auth()->user()->riwayat_kerja ?? 'Belum diisi' }}" class="border border-gray-200 rounded-md p-3 bg-gray-50 w-[593px]" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>