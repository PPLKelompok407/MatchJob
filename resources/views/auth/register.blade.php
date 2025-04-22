<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MatchJob</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    @include('component.navbar')
    
    <div class="flex-grow flex items-center justify-center py-8 mt-4">
        <div class="w-[690px] h-[766px] px-[65px] py-[48px] bg-white rounded-lg shadow-md">
        <div class="mb-6 flex flex-col gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang!</h2>
            <p class="text-[#9D9D9D] text-[16px] font-[400]">Silahkan masuk untuk dapat menggunakan layanan MatchJob atau klik tombol Register untuk membuat akun anda.</p>
        </div>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input placeholder="Masukkan Nama" type="text" id="name" name="name" value="{{ old('name') }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') @enderror" 
                        required autofocus>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input placeholder="Masukkan Email" type="email" id="email" name="email" value="{{ old('email') }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') @enderror" 
                        required>
                </div>
                
                <div class="mb-4">
                    <label for="notelp" class="block text-gray-700 text-sm font-bold mb-2">Nomor HP</label>
                    <input placeholder="Masukkan Nomor HP" type="text" id="notelp" name="notelp" value="{{ old('notelp') }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('notelp') @enderror" 
                        required>
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input placeholder="Masukkan Kata Sandi" type="password" id="password" name="password" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') @enderror" 
                        required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 text-[16px] font-[400] mb-2">Konfirmasi Kata Sandi</label>
                    <input placeholder="Konfirmasi Kata Sandi" type="password" id="password_confirmation" name="password_confirmation" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password_confirmation') @enderror" 
                        required>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200">
                        Register
                    </button>
                </div>
            </form>
            
            <div class="text-center text-sm">
                <p class="text-gray-600">Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 font-semibold">Login</a>
                </p>
            </div>
        </div>
    </div>

    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "Error!",
                text: "{{ $errors->first() }}",
                icon: "error",
                confirmButtonText: "OK",
                confirmButtonColor: "#3085d6"
            });
        });
    </script>
    @endif
</body>
</html> 