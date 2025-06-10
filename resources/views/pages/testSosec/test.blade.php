<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Softskill RIASEC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#F4F8FF]">
    @include('component.navbar')
    
    <div class="flex h-screen">
        <!-- Main Content -->
        <div class="flex-1 px-4 py-[46px]">
            <div class="flex flex-col">
                <!-- Header -->
                <div class="flex flex-col gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="81" height="6" viewBox="0 0 81 6" fill="none">
                        <path d="M3 3L78 3" stroke="#4880FF" stroke-width="5" stroke-linecap="round"/>
                    </svg>
                    <h1 class="text-[32px] font-[700] text-[#1C1C1C]">TES SOFTSKILL RIASEC</h1>
                </div>

                <!-- Flash Messages -->
                @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
                @endif
                
                @if(session('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                    <p>{{ session('warning') }}</p>
                </div>
                @endif
                
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                <div class="flex flex-row gap-8">
                    <!-- Left column - Question indicator -->
                    <div class="w-1/4">
                        <div class="mb-6">
                            <h2 class="text-xl font-bold mb-1">Pertanyaan {{ $currentPage ?? 1 }}</h2>
                            <p class="text-gray-600">
                                @if(isset($answers['jawaban'][$currentPage]))
                                    Sudah dijawab
                                @elseif(in_array($currentPage, $flaggedQuestions ?? []))
                                    Ditandai
                                @else
                                    Belum dijawab
                                @endif
                            </p>
                            <div class="flex items-center mt-2 cursor-pointer" id="flagToggle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                                    <line x1="4" y1="22" x2="4" y2="15"></line>
                                </svg>
                                <span class="ml-2 text-gray-600">Tandai pertanyaan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Middle column - Question -->
                    <div class="w-2/4">
                        <form id="testForm" method="POST" action="{{ route('sosec.answer', ['page' => $currentPage ?? 1]) }}">
                            @csrf
                            <input type="hidden" name="current_time" id="current_time">
                            <div class="bg-white rounded-lg shadow-md p-8">
                                <div class="bg-[#EBF5FF] p-4 rounded-lg mb-6">
                                    <p class="text-gray-800">{{ $soalSosec[$currentPage-1]->pertanyaan ?? 'Saya senang bekerja dengan mesin atau peralatan teknis' }}</p>
                                </div>

                                <div class="pl-2">
                                    <p class="font-medium mb-4"></p>

                                    <div class="space-y-3">
                                        <!-- Standard radio button list format -->
                                        <label class="flex items-center">
                                            <input type="radio" name="jawaban[{{ $currentPage ?? 1 }}]" value="5" class="w-5 h-5 mr-3 text-blue-500 border-gray-300 focus:ring-blue-500" {{ isset($answers['jawaban'][$currentPage]) && $answers['jawaban'][$currentPage] == 5 ? 'checked' : '' }}>
                                            <span>Sangat Sesuai</span>
                                        </label>

                                        <label class="flex items-center">
                                            <input type="radio" name="jawaban[{{ $currentPage ?? 1 }}]" value="4" class="w-5 h-5 mr-3 text-blue-500 border-gray-300 focus:ring-blue-500" {{ isset($answers['jawaban'][$currentPage]) && $answers['jawaban'][$currentPage] == 4 ? 'checked' : '' }}>
                                            <span>Sesuai</span>
                                        </label>

                                        <label class="flex items-center">
                                            <input type="radio" name="jawaban[{{ $currentPage ?? 1 }}]" value="3" class="w-5 h-5 mr-3 text-blue-500 border-gray-300 focus:ring-blue-500" {{ isset($answers['jawaban'][$currentPage]) && $answers['jawaban'][$currentPage] == 3 ? 'checked' : '' }}>
                                            <span>Netral</span>
                                        </label>

                                        <label class="flex items-center">
                                            <input type="radio" name="jawaban[{{ $currentPage ?? 1 }}]" value="2" class="w-5 h-5 mr-3 text-blue-500 border-gray-300 focus:ring-blue-500" {{ isset($answers['jawaban'][$currentPage]) && $answers['jawaban'][$currentPage] == 2 ? 'checked' : '' }}>
                                            <span>Tidak Sesuai</span>
                                        </label>

                                        <label class="flex items-center">
                                            <input type="radio" name="jawaban[{{ $currentPage ?? 1 }}]" value="1" class="w-5 h-5 mr-3 text-blue-500 border-gray-300 focus:ring-blue-500" {{ isset($answers['jawaban'][$currentPage]) && $answers['jawaban'][$currentPage] == 1 ? 'checked' : '' }}>
                                            <span>Sangat Tidak Sesuai</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation buttons -->
                            <div class="flex justify-between mt-6 mb-8">
                                <a href="{{ route('sosec.show', ['page' => ($currentPage ?? 1) - 1]) }}" class="bg-blue-200 hover:bg-blue-300 text-blue-800 font-medium py-2 px-6 rounded-md transition duration-300 {{ ($currentPage ?? 1) <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ ($currentPage ?? 1) <= 1 ? 'disabled' : '' }}>
                                    Halaman Sebelumnya
                                </a>
                                
                                <input type="hidden" name="next_page" value="{{ ($currentPage ?? 1) + 1 }}">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition duration-300">
                                    {{ ($currentPage ?? 1) >= count($soalSosec) ? 'Submit' : 'Halaman Selanjutnya' }}
                                </button>
                            </div>
                            
                            <!-- Legend moved here -->
                            <div class="flex justify-center space-x-8 mb-6">
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-green-600 rounded-full mr-2"></div>
                                    <span class="text-sm">Saat ini</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-blue-500 rounded-full mr-2"></div>
                                    <span class="text-sm">Sudah dijawab</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-orange-500 rounded-full mr-2"></div>
                                    <span class="text-sm">Ditandai</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-gray-200 rounded-full mr-2"></div>
                                    <span class="text-sm">Belum dijawab</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right sidebar - Timer and Question navigation -->
        <div class="w-[280px] min-h-screen bg-white p-6 flex flex-col items-center">
            <div class="text-center mb-6">
                <h3 class="text-lg font-medium bg-blue-500 text-white py-2 w-full rounded-md mb-6">Waktu Tersisa</h3>
                <div class="flex justify-center space-x-4">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full border-4 border-green-500 flex items-center justify-center">
                            <span id="hours" class="text-xl font-bold">00</span>
                        </div>
                        <span class="mt-1 text-sm text-gray-500">jam</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full border-4 border-yellow-500 flex items-center justify-center">
                            <span id="minutes" class="text-xl font-bold">30</span>
                        </div>
                        <span class="mt-1 text-sm text-gray-500">menit</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full border-4 border-red-500 flex items-center justify-center">
                            <span id="seconds" class="text-xl font-bold">00</span>
                        </div>
                        <span class="mt-1 text-sm text-gray-500">detik</span>
                    </div>
                </div>
            </div>

            <!-- Question navigation grid -->
            <div class="grid grid-cols-5 gap-2 w-full">
                @for ($i = 1; $i <= 30; $i++)
                    <a href="{{ route('sosec.show', ['page' => $i]) }}" 
                       class="flex items-center justify-center h-10 text-center 
                              {{ $i == ($currentPage ?? 1) ? 'bg-green-600 text-white' : '' }}
                              {{ isset($answers['jawaban'][$i]) ? 'bg-blue-500 text-white' : '' }}
                              {{ in_array($i, $flaggedQuestions ?? []) ? 'bg-orange-500 text-white' : '' }}
                              {{ !isset($answers['jawaban'][$i]) && $i != ($currentPage ?? 1) && !in_array($i, $flaggedQuestions ?? []) ? 'bg-gray-200' : '' }}
                              rounded-md">
                        {{ $i }}
                    </a>
                @endfor
            </div>
        </div>
    </div>

    <script>
        // Check if server requested timer reset
        @if(session('clear_timer'))
            localStorage.removeItem('sosecTestStartTime');
        @endif
        
        // Set the time limit in seconds (30 minutes = 1800 seconds)
        const TIME_LIMIT = 1800;
        
        // Get start time from localStorage or set new one
        let startTime = localStorage.getItem('sosecTestStartTime');
        if (!startTime) {
            startTime = new Date().getTime();
            localStorage.setItem('sosecTestStartTime', startTime);
        }
        
        // Update timer every second
        let timer = setInterval(function() {
            // Calculate elapsed time in seconds
            const elapsedTime = Math.floor((new Date().getTime() - startTime) / 1000);
            const remainingTime = TIME_LIMIT - elapsedTime;
            
            if (remainingTime <= 0) {
                // Time's up
                clearInterval(timer);
                Swal.fire({
                    title: 'Waktu Habis!',
                    text: 'Anda harus mengulang tes dari awal.',
                    icon: 'warning',
                    confirmButtonText: 'Mulai Ulang',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Clear localStorage and redirect to first question
                        localStorage.removeItem('sosecTestStartTime');
                        window.location.href = "{{ route('sosec.show', ['page' => 1]) }}";
                    }
                });
                return;
            }
            
            // Update timer display
            const hours = Math.floor(remainingTime / 3600);
            const minutes = Math.floor((remainingTime % 3600) / 60);
            const seconds = remainingTime % 60;
            
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            
            // Update hidden input for form submission
            document.getElementById('current_time').value = elapsedTime;
        }, 1000);
        
        // Flag question functionality
        document.getElementById('flagToggle').addEventListener('click', function() {
            // Create a form to submit the flag request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('sosec.flag', ['page' => $currentPage ?? 1]) }}";
            
            // Add CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = "{{ csrf_token() }}";
            form.appendChild(csrfToken);
            
            // Add current time
            const currentTime = document.createElement('input');
            currentTime.type = 'hidden';
            currentTime.name = 'current_time';
            currentTime.value = document.getElementById('current_time').value;
            form.appendChild(currentTime);
            
            // Submit the form
            document.body.appendChild(form);
            form.submit();
        });
    </script>
</body>
</html>
