<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Test Softskill RIASEC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-[#F4F8FF]">
    @include('component.navbar')
    
    <div class="container mx-auto px-4 py-[46px]">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="81" height="6" viewBox="0 0 81 6" fill="none">
                    <path d="M3 3L78 3" stroke="#4880FF" stroke-width="5" stroke-linecap="round"/>
                </svg>
                <h1 class="text-[32px] font-[700] text-[#1C1C1C]">HASIL TEST SOFTSKILL RIASEC</h1>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h2 class="text-2xl font-bold mb-6 text-center">Ringkasan Hasil</h2>
                
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Chart -->
                    <div class="w-full md:w-1/2">
                        <canvas id="resultChart" width="400" height="400"></canvas>
                    </div>
                    
                    <!-- Result details -->
                    <div class="w-full md:w-1/2">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold mb-2">Tipe Dominan</h3>
                            <div class="bg-blue-100 border-l-4 border-blue-500 p-4">
                                <p class="text-lg font-medium">{{ Auth::user()->test_sosec }}</p>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-xl font-bold mb-2">Skor per Kategori</h3>
                            <ul class="space-y-4">
                                <li class="flex justify-between items-center">
                                    <span class="font-medium">Realistic:</span>
                                    <div class="flex items-center">
                                        <div class="w-40 bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-red-600 h-2.5 rounded-full" style="width: {{ ($skor['realistic'] / $totalSkor) * 100 }}%"></div>
                                        </div>
                                        <span>{{ $skor['realistic'] }}</span>
                                    </div>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class="font-medium">Investigative:</span>
                                    <div class="flex items-center">
                                        <div class="w-40 bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-orange-600 h-2.5 rounded-full" style="width: {{ ($skor['investigative'] / $totalSkor) * 100 }}%"></div>
                                        </div>
                                        <span>{{ $skor['investigative'] }}</span>
                                    </div>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class="font-medium">Artistic:</span>
                                    <div class="flex items-center">
                                        <div class="w-40 bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ ($skor['artistic'] / $totalSkor) * 100 }}%"></div>
                                        </div>
                                        <span>{{ $skor['artistic'] }}</span>
                                    </div>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class="font-medium">Social:</span>
                                    <div class="flex items-center">
                                        <div class="w-40 bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ ($skor['social'] / $totalSkor) * 100 }}%"></div>
                                        </div>
                                        <span>{{ $skor['social'] }}</span>
                                    </div>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class="font-medium">Enterprising:</span>
                                    <div class="flex items-center">
                                        <div class="w-40 bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($skor['enterprising'] / $totalSkor) * 100 }}%"></div>
                                        </div>
                                        <span>{{ $skor['enterprising'] }}</span>
                                    </div>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class="font-medium">Conventional:</span>
                                    <div class="flex items-center">
                                        <div class="w-40 bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="bg-purple-600 h-2.5 rounded-full" style="width: {{ ($skor['conventional'] / $totalSkor) * 100 }}%"></div>
                                        </div>
                                        <span>{{ $skor['conventional'] }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h2 class="text-2xl font-bold mb-6">Deskripsi Tipe Kepribadian Anda</h2>
                
                <div class="space-y-4">
                    @foreach($topThree as $type => $score)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-xl font-bold mb-2">{{ ucfirst($type) }}</h3>
                            <p class="text-gray-700">{{ $deskripsi[$type] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold mb-6">Rekomendasi Karir</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($rekomendasi as $karir)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-blue-50 transition-colors">
                            <h3 class="font-medium text-lg">{{ $karir }}</h3>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8 text-center">
                    <a href="{{ route('pages.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition duration-300">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Chart data
        const ctx = document.getElementById('resultChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Realistic', 'Investigative', 'Artistic', 'Social', 'Enterprising', 'Conventional'],
                datasets: [{
                    label: 'Skor',
                    data: [
                        {{ $skor['realistic'] }},
                        {{ $skor['investigative'] }},
                        {{ $skor['artistic'] }},
                        {{ $skor['social'] }},
                        {{ $skor['enterprising'] }},
                        {{ $skor['conventional'] }}
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                    pointBackgroundColor: 'rgb(54, 162, 235)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(54, 162, 235)'
                }]
            },
            options: {
                elements: {
                    line: {
                        borderWidth: 3
                    }
                },
                scales: {
                    r: {
                        angleLines: {
                            display: true
                        },
                        suggestedMin: 0,
                        suggestedMax: 25
                    }
                }
            }
        });
    </script>
</body>
</html>
