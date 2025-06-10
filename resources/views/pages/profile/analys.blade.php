<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Analisis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!--Alpine.js-->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
=======
    <title>Analisis Profil - MatchJob</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
>>>>>>> origin/main
</head>
<body class="bg-[#EDF2FF]">
    @include('component.navbar')
    
<<<<<<< HEAD
    {{--Sidebar--}}
    @include('component.sidebar')

=======
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <div class="">
                @include('component.sidebar')
            </div>
            
            <!-- Main Content -->
            <div class="">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <!-- User Profile Section -->
                        <div class="flex flex-col md:flex-row items-center mb-8">
                            <div class="flex flex-col items-center md:w-1/3 mb-6 md:mb-0">
                                <div class="w-[152px] h-[152px] rounded-full overflow-hidden border-4 border-white shadow-lg mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="147" height="147" viewBox="0 0 16 16" fill="none">
                                        <g clip-path="url(#clip0_429_313)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 14.5C9.1411 14.5017 10.2623 14.2015 11.25 13.63V11.5C11.25 10.9033 11.0129 10.331 10.591 9.90901C10.169 9.48705 9.59674 9.25 9 9.25H7C6.40326 9.25 5.83097 9.48705 5.40901 9.90901C4.98705 10.331 4.75 10.9033 4.75 11.5V13.63C5.73766 14.2015 6.8589 14.5017 8 14.5ZM12.75 11.5V12.437C13.6147 11.5113 14.1901 10.3531 14.4054 9.10483C14.6207 7.85653 14.4666 6.57251 13.962 5.41062C13.4574 4.24874 12.6243 3.25961 11.5651 2.56484C10.5059 1.87007 9.26673 1.49994 8 1.49994C6.73327 1.49994 5.49413 1.87007 4.43493 2.56484C3.37573 3.25961 2.54261 4.24874 2.038 5.41062C1.53339 6.57251 1.37927 7.85653 1.59459 9.10483C1.80992 10.3531 2.3853 11.5113 3.25 12.437V11.5C3.2497 10.7268 3.48841 9.97243 3.93344 9.34015C4.37847 8.70788 5.00806 8.22862 5.736 7.968C5.35839 7.53366 5.11368 6.99987 5.03107 6.4303C4.94845 5.86072 5.03142 5.27941 5.27008 4.75568C5.50873 4.23196 5.89299 3.78794 6.37704 3.47658C6.86108 3.16523 7.42447 2.99967 8 2.99967C8.57553 2.99967 9.13892 3.16523 9.62296 3.47658C10.107 3.78794 10.4913 4.23196 10.7299 4.75568C10.9686 5.27941 11.0515 5.86072 10.9689 6.4303C10.8863 6.99987 10.6416 7.53366 10.264 7.968C10.9919 8.22862 11.6215 8.70788 12.0666 9.34015C12.5116 9.97243 12.7503 10.7268 12.75 11.5ZM8 16C10.1217 16 12.1566 15.1571 13.6569 13.6569C15.1571 12.1566 16 10.1217 16 8C16 5.87827 15.1571 3.84344 13.6569 2.34315C12.1566 0.842855 10.1217 0 8 0C5.87827 0 3.84344 0.842855 2.34315 2.34315C0.842855 3.84344 0 5.87827 0 8C0 10.1217 0.842855 12.1566 2.34315 13.6569C3.84344 15.1571 5.87827 16 8 16ZM9.5 6C9.5 6.39782 9.34196 6.77936 9.06066 7.06066C8.77936 7.34196 8.39782 7.5 8 7.5C7.60218 7.5 7.22064 7.34196 6.93934 7.06066C6.65804 6.77936 6.5 6.39782 6.5 6C6.5 5.60218 6.65804 5.22064 6.93934 4.93934C7.22064 4.65804 7.60218 4.5 8 4.5C8.39782 4.5 8.77936 4.65804 9.06066 4.93934C9.34196 5.22064 9.5 5.60218 9.5 6Z" fill="black"/>
                                        </g>
                                    </svg>
                                </div>
                                <h2 class="text-[16px] font-[500] text-center">Hi {{ Auth::user()->name }}!</h2>
                                <p class="text-[12px] text-[#7e7e7e] font-[500] text-center mt-1">Kenali Diri Anda Lebih Dalam Dengan Mengetahui Skill Yang Anda Miliki</p>
                            </div>
                            
                            <!-- Test Results Charts -->
                            <div class="md:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Mikat Test Chart -->
                                <div>
                                    <h3 class="text-lg font-semibold text-center mb-4">Hasil Test Minat dan Bakat</h3>
                                    <div style="height: 268px; width: 268px; margin: 0 auto;">
                                        <canvas id="mikatChart"></canvas>
                                    </div>
                                    <div class="flex flex-wrap justify-center gap-4 mt-4">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                                            <span class="text-sm">Kreatif</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-purple-400 mr-2"></div>
                                            <span class="text-sm">Sosial</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-pink-400 mr-2"></div>
                                            <span class="text-sm">Manajerial</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-orange-300 mr-2"></div>
                                            <span class="text-sm">Teknikal</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Sosec Test Chart -->
                                <div>
                                    <h3 class="text-lg font-semibold text-center mb-4">Hasil Test Softskill Riasec</h3>
                                    <div style="height: 268px; width: 268px; margin: 0 auto;">
                                        <canvas id="sosecChart"></canvas>
                                    </div>
                                    <div class="flex flex-wrap justify-center gap-4 mt-4">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-blue-300 mr-2"></div>
                                            <span class="text-sm">Realistic</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-purple-300 mr-2"></div>
                                            <span class="text-sm">Artistic</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-pink-300 mr-2"></div>
                                            <span class="text-sm">Social</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#FDEEDC] rounded-lg p-6">
                        <h2 class="text-2xl font-bold mb-6"><span class="text-blue-500">Rekomendasi</span> Karir untuk Kamu!</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @forelse($recommendedCompanies as $company)
                                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-md flex items-center justify-center mb-4">
                                        <span class="font-bold text-gray-500">{{ substr($company->nama, 0, 2) }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-center">{{ $company->bagian }}</h3>
                                    <p class="text-sm text-gray-600 text-center">{{ $company->nama }}</p>
                                    <p class="text-sm text-gray-800 font-medium text-center mt-2">{{ explode(',', $company->alamat)[0] }}</p>
                                    <p class="text-sm text-gray-600 text-center">{{ $company->fokus }}</p>
                                    <a href="{{ route('perusahaan.detail', $company->id) }}" class="mt-4 text-blue-500 hover:text-blue-700 text-sm font-medium">Lihat Detail</a>
                                </div>
                            @empty
                                <div class="col-span-3 text-center py-8">
                                    <p class="text-gray-500">Tidak ada rekomendasi perusahaan saat ini.</p>
                                    <p class="text-gray-500 mt-2">Silakan lengkapi profil dan tes untuk mendapatkan rekomendasi.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mikat Test Chart (Minat dan Bakat)
            const mikatCtx = document.getElementById('mikatChart').getContext('2d');
            const mikatChart = new Chart(mikatCtx, {
                type: 'pie',
                data: {
                    labels: ['Kreatif', 'Sosial', 'Manajerial', 'Teknikal'],
                    datasets: [{
                        data: [67, 11, 21, 27], // Percentages from the image
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)', // Blue
                            'rgba(167, 139, 250, 0.8)', // Purple
                            'rgba(244, 114, 182, 0.8)', // Pink
                            'rgba(251, 146, 60, 0.8)'  // Orange
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.raw + '%';
                                }
                            }
                        }
                    }
                }
            });
            
            // Sosec Test Chart (Softskill Riasec)
            const sosecCtx = document.getElementById('sosecChart').getContext('2d');
            const sosecChart = new Chart(sosecCtx, {
                type: 'pie',
                data: {
                    labels: ['Realistic', 'Artistic', 'Social'],
                    datasets: [{
                        data: [67, 11, 22], // Adjusted percentages for 3 categories
                        backgroundColor: [
                            'rgba(96, 165, 250, 0.8)', // Light Blue
                            'rgba(192, 132, 252, 0.8)', // Light Purple
                            'rgba(249, 168, 212, 0.8)'  // Light Pink
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.raw + '%';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
>>>>>>> origin/main
</body>
</html>
