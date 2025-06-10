<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Before Test Minat dan Bakat</title>
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
                    <h3 class="text-[32px] font-[700]">TES MINAT DAN BAKAT - PILIHAN GANDA</h3>
                </div>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md">
                <p class="mb-6 text-gray-700">Welcome to your test preparation page! We're here to ensure you're ready to face the test with confidence. Before you begin, there are some important points you need to know:</p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start">
                        <span class="font-[500] text-[#1C1C1C] text-[18px] mr-2 mt-1">•</span>
                        <span class="text-gray-700">This test will close on April 26, 2024, at 23:59. You have 90 minutes to complete the entire test. Make sure you make the most of your time to answer all the questions.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-[500] text-[#1C1C1C] text-[18px] mr-2 mt-1">•</span>
                        <span class="text-gray-700">The test consists of two types of questions: 20 multiple choice and 5 essay. Make sure to carefully read each instruction before answering the questions.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-[500] text-[#1C1C1C] text-[18px] mr-2 mt-1">•</span>
                        <span class="text-gray-700">You will not be able to return to previous multiple-choice questions while on the essay questions page. Be sure to provide your best answer to each question, as there is no opportunity to go back and change your answers.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-[500] text-[#1C1C1C] text-[18px] mr-2 mt-1">•</span>
                        <span class="text-gray-700">To ensure the authenticity of the test, we ask you not to open any other pages or tabs during the test. This helps us ensure that each participant receives a fair and balanced test experience.</span>
                    </li>
                </ul>
                <div class="flex justify-center">
                    <a href="{{ route('mikat.show', ['page' => 1]) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition duration-300">Mulai Tes</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>