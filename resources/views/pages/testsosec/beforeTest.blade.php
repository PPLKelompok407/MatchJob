<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Before Test Softskill RIASEC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    @include('component.navbar')

    <div class="container mx-auto px-4 py-[46px]">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="81" height="6" viewBox="0 0 81 6" fill="none">
                    <path d="M3 3L78 3" stroke="#4880FF" stroke-width="5" stroke-linecap="round"/>
                </svg>
                <div class="flex items-center gap-[21px] mb-4 ml-[-65px]">
                    <a href="{{ url()->previous() }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[40px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <h3 class="text-[32px] font-[700]">TES SOFTSKILL RIASEC</h3>
                </div>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md">
                <p class="mb-6 text-gray-700">Welcome to the RIASEC Soft Skills Test! This test will help identify your career interests and personal preferences. Before you begin, please read these important instructions:</p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start">
                        <span class="font-[500] text-[#1C1C1C] text-[18px] mr-2 mt-1">•</span>
                        <span class="text-gray-700">This test will take approximately 30 minutes to complete. You'll be presented with a series of statements about different activities and you'll need to rate your interest level for each one.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-[500] text-[#1C1C1C] text-[18px] mr-2 mt-1">•</span>
                        <span class="text-gray-700">The test consists of 30 questions covering six categories of RIASEC : Realistic, Investigative, Artistic, Social, Enterprising, and Conventional. Your responses will determine your primary personality type.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-[500] text-[#1C1C1C] text-[18px] mr-2 mt-1">•</span>
                        <span class="text-gray-700">Be honest with your responses. There are no right or wrong answers—the goal is to identify your genuine interests and preferences to help guide future career decisions.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-[500] text-[#1C1C1C] text-[18px] mr-2 mt-1">•</span>
                        <span class="text-gray-700">To ensure accurate results, please complete the test in one sitting without interruptions. Your responses will be saved as you progress through the test.</span>
                    </li>
                </ul>
                <div class="flex justify-center">
                    <a href="{{ route('sosec.show', ['page' => 1]) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition duration-300">Mulai Tes</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
