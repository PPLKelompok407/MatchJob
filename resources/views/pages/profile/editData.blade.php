<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
                        <a href="{{ route('pages.profile.personal') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium transition inline-block mr-2">
                            Kembali
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div>
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Nama Lengkap</h3>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Jenis Kelamin</h3>
                                <div class="relative">
                                    <select name="jenisa_kelamin" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                        <option value="" {{ auth()->user()->jenisa_kelamin === null ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ auth()->user()->jenisa_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ auth()->user()->jenisa_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 pr-6">
                                        <img src="{{ asset('dropdown.png') }}" alt="" class="w-[24px] opacity-50">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Riwayat Pendidikan</h3>
                                <input type="text" name="riwayat_pendidikan" value="{{ auth()->user()->riwayat_pendidikan }}" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>

                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Nomor Telepon</h3>
                                <input type="text" name="notelp" value="{{ auth()->user()->notelp }}" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div>
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Tempat Tanggal Lahir</h3>
                                <input type="text" name="tempat_tanggal_lahir" value="{{ auth()->user()->tempat_tanggal_lahir }}" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Alamat Lengkap</h3>
                                <textarea name="alamat" rows="3" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">{{ auth()->user()->alamat }}</textarea>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Riwayat Kerja</h3>
                                <textarea name="riwayat_kerja" rows="3" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">{{ auth()->user()->riwayat_kerja }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md text-sm font-medium transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
