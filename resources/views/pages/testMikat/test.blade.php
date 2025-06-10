<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Minat dan Bakat</title>
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
                    <h1 class="text-[32px] font-[700] text-[#1C1C1C]">TES MINAT DAN BAKAT - PILIHAN GANDA</h1>
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
                                @if(isset($answers['jawaban_'.$currentPage]))
                                    Sudah dijawab
                                @elseif(in_array($currentPage, $flaggedQuestions ?? []))
                                    Ditandai
                                @else
                                    Belum dijawab
                                @endif
                            </p>
                            <div class="flex items-center mt-2 cursor-pointer" id="flagToggle">
                                <img src="{{ asset('flag.png') }}" class="w-[18px]" alt="">
                                <span class="ml-2 text-gray-600">Tandai pertanyaan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Middle column - Question -->
                    <div class="w-2/4">
                        <form id="testForm" method="POST" action="{{ route('mikat.answer', ['page' => $currentPage ?? 1]) }}">
                            @csrf
                            <input type="hidden" name="current_time" id="current_time">
                            <div class="bg-white rounded-lg shadow-md p-8">
                                <div class="bg-gray-100 p-4 rounded-lg mb-6">
                                    <div class="flex items-start justify-between">
                                        <p class="text-gray-800">{{ $soalMikat[$currentPage-1]->pertanyaan ?? 'Ketika menghadapi tantangan atau kesulitan, bagaimana Anda biasanya merespons?' }}</p>
                                        
                                        @if(($currentPage ?? 1) == 1)
                                        <div class="ml-4">
                                            <img src="{{ asset('gambar_wajah.png') }}" alt="Gambar Wajah" class="w-32 h-32 object-cover rounded">
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <p class="font-medium mb-4">Select one:</p>

                                <div class="space-y-4">
                                    <label class="flex items-center">
                                        <input type="radio" name="jawaban_{{ $currentPage ?? 1 }}" value="opsi_1" class="w-5 h-5 mr-3 text-blue-500 border-gray-300 focus:ring-blue-500" {{ isset($answers['jawaban_'.$currentPage]) && $answers['jawaban_'.$currentPage] == 'opsi_1' ? 'checked' : '' }}>
                                        <span>{{ $soalMikat[$currentPage-1]->opsi_1 ?? 'Mencari solusi secara langsung dan mencoba mencari jalan keluar.' }}</span>
                                    </label>

                                    <label class="flex items-center">
                                        <input type="radio" name="jawaban_{{ $currentPage ?? 1 }}" value="opsi_2" class="w-5 h-5 mr-3 text-blue-500 border-gray-300 focus:ring-blue-500" {{ isset($answers['jawaban_'.$currentPage]) && $answers['jawaban_'.$currentPage] == 'opsi_2' ? 'checked' : '' }}>
                                        <span>{{ $soalMikat[$currentPage-1]->opsi_2 ?? 'Mendiskusikan masalah dengan orang lain untuk mendapatkan perspektif baru.' }}</span>
                                    </label>

                                    <label class="flex items-center">
                                        <input type="radio" name="jawaban_{{ $currentPage ?? 1 }}" value="opsi_3" class="w-5 h-5 mr-3 text-blue-500 border-gray-300 focus:ring-blue-500" {{ isset($answers['jawaban_'.$currentPage]) && $answers['jawaban_'.$currentPage] == 'opsi_3' ? 'checked' : '' }}>
                                        <span>{{ $soalMikat[$currentPage-1]->opsi_3 ?? 'Mengambil waktu sejenak untuk merenung sebelum mengambil tindakan.' }}</span>
                                    </label>

                                    <label class="flex items-center">
                                        <input type="radio" name="jawaban_{{ $currentPage ?? 1 }}" value="opsi_4" class="w-5 h-5 mr-3 text-blue-500 border-gray-300 focus:ring-blue-500" {{ isset($answers['jawaban_'.$currentPage]) && $answers['jawaban_'.$currentPage] == 'opsi_4' ? 'checked' : '' }}>
                                        <span>{{ $soalMikat[$currentPage-1]->opsi_4 ?? 'Mencari dukungan dari teman atau keluarga untuk membantu mengatasi situasi.' }}</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Navigation buttons -->
                            <div class="flex justify-between mt-6 mb-8">
                                <a href="{{ route('mikat.show', ['page' => ($currentPage ?? 1) - 1]) }}" class="bg-blue-200 hover:bg-blue-300 text-blue-800 font-medium py-2 px-6 rounded-md transition duration-300 {{ ($currentPage ?? 1) <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ ($currentPage ?? 1) <= 1 ? 'disabled' : '' }}>
                                    Halaman Sebelumnya
                                </a>
                                
                                <input type="hidden" name="next_page" value="{{ ($currentPage ?? 1) + 1 }}">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition duration-300" id="submitButton">
                                    {{ ($currentPage ?? 1) >= count($soalMikat) ? 'Submit' : 'Halaman Selanjutnya' }}
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
                            <span id="hours" class="text-xl font-bold">01</span>
                        </div>
                        <span class="mt-1 text-sm text-gray-500">jam</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full border-4 border-yellow-500 flex items-center justify-center">
                            <span id="minutes" class="text-xl font-bold">29</span>
                        </div>
                        <span class="mt-1 text-sm text-gray-500">menit</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full border-4 border-red-500 flex items-center justify-center">
                            <span id="seconds" class="text-xl font-bold">05</span>
                        </div>
                        <span class="mt-1 text-sm text-gray-500">detik</span>
                    </div>
                </div>
            </div>

            <!-- Question navigation grid -->
            <div class="grid grid-cols-5 gap-2 w-full">
                @for ($i = 1; $i <= 15; $i++)
                    <a href="{{ route('mikat.show', ['page' => $i]) }}" 
                       class="flex items-center justify-center h-10 text-center 
                              {{ $i == ($currentPage ?? 1) ? 'bg-green-600 text-white' : '' }}
                              {{ isset($answers['jawaban_'.$i]) ? 'bg-blue-500 text-white' : '' }}
                              {{ in_array($i, $flaggedQuestions ?? []) ? 'bg-orange-500 text-white' : '' }}
                              {{ !isset($answers['jawaban_'.$i]) && $i != ($currentPage ?? 1) && !in_array($i, $flaggedQuestions ?? []) ? 'bg-gray-200' : '' }}
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
            localStorage.removeItem('testStartTime');
            localStorage.removeItem('timeoutAlertShown');
        @endif
        
        // Set the time limit in seconds (90 minutes = 5400 seconds)
        const TIME_LIMIT = 5400;
        
        // Check if this is a new page load (not a refresh or navigation within the test)
        const currentPage = {{ $currentPage ?? 1 }};
        const lastVisitedPage = localStorage.getItem('lastVisitedPageMikat');
        
        // If this is the first page (page 1) and we're coming from outside the test
        // or if this is the first time visiting any page of the test, reset the timer
        if (currentPage == 1 && (!lastVisitedPage || lastVisitedPage == 'external')) {
            localStorage.removeItem('testStartTime');
            localStorage.removeItem('timeoutAlertShown');
        }
        
        // Update the last visited page
        localStorage.setItem('lastVisitedPageMikat', currentPage);
        
        // Get start time from localStorage or set new one
        let startTime = localStorage.getItem('testStartTime');
        if (!startTime) {
            startTime = new Date().getTime();
            localStorage.setItem('testStartTime', startTime);
        }
        
        // Update timer every second
        let timer = setInterval(function() {
            // Calculate elapsed time in seconds
            const elapsedTime = Math.floor((new Date().getTime() - startTime) / 1000);
            const remainingTime = TIME_LIMIT - elapsedTime;
            
            if (remainingTime <= 0) {
                // Time's up
                clearInterval(timer);
                
                // Check if this is a genuine timeout (not just page load with expired timer)
                const timeoutShown = localStorage.getItem('timeoutAlertShown');
                if (!timeoutShown) {
                    // Mark that we've shown the timeout alert
                    localStorage.setItem('timeoutAlertShown', 'true');
                    
                    Swal.fire({
                        title: 'Waktu Habis!',
                        text: 'Anda harus mengulang tes dari awal.',
                        icon: 'warning',
                        confirmButtonText: 'Mulai Ulang',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Clear localStorage and redirect to first question
                            localStorage.removeItem('testStartTime');
                            localStorage.removeItem('timeoutAlertShown');
                            localStorage.removeItem('lastVisitedPageMikat');
                            window.location.href = "{{ route('mikat.show', ['page' => 1]) }}";
                        }
                    });
                }
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
        
        // Check if this is the last page and add event listener to reset timer on submit
        const isLastPage = {{ ($currentPage ?? 1) >= count($soalMikat) ? 'true' : 'false' }};
        if (isLastPage) {
            document.getElementById('submitButton').addEventListener('click', function() {
                // Reset all timer related localStorage items when submitting the final page
                localStorage.removeItem('testStartTime');
                localStorage.removeItem('timeoutAlertShown');
                localStorage.removeItem('lastVisitedPageMikat');
            });
        }
        
        // Flag question functionality
        document.getElementById('flagToggle').addEventListener('click', function() {
            // Create a form to submit the flag request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('mikat.flag', ['page' => $currentPage ?? 1]) }}";
            
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