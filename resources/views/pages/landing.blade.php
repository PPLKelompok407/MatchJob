<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing pages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @include('component.navbar')

    <div class="flex flex-col items-center bg-[#EDF2FF]">
        <div class="flex flex-col">
            <div class="w-full h-[739px] px-7 grid grid-cols-6 mt-[93px]">
                <div class="flex flex-col items-center-safe mt-[40px] col-span-4 gap-[23px]">
                    <div class="flex flex-col leading-tight text-[64px] font-[600]">
                        <p class="mb-0">Langkah Awal</p> 
                        <p class="mt-[-10px] mb-0">Menuju <span class="text-[#4880FF]">Karier Impian</span></p>
                        <p class="mt-[-10px]">Dimulai di Sini.</p>
                    </div>
                    <div class="text-[#515B6F] text-[20px] font-[400]">
                        <p>Temukan pekerjaan yang benar-benar cocok denganmu.</p>
                        <p>Match Job, sahabat terbaik pencari kerja.</p>
                    </div>

                    <button class="w-[187px] h-[60px] bg-[#4880FF] text-[18px] font-[500] text-white rounded-[10px]">
                        Mulai cari kerja
                    </button>
                </div>

                <div class="col-span-2 flex flex-col">
                    <img class="w-[508px] self-end" src="{{ asset('landing.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    

    <div class="flex justify-center mt-[93px]">
        <div class="w-[1580px] px-7 flex justify-between">
            <div class="flex flex-col w-[488px]">
                <img class="w-[488px]" src="{{ asset('landing2.png') }}" alt="">
            </div>

            <div class="flex flex-col gap-[48px] justify-between w-[950px] ml-[-80px]">
                <div class="flex flex-col gap-[21px] pr-20">
                    <h3 class="text-[40px] font-[700]">Apa itu <span class="text-[#4880FF]">tes teknis</span> ?</h3>
                    <p class="text-[#696984] text-[20px] font-[400]">Tes teknis adalah sebuah proses evaluasi yang dirancang untuk mengukur kemampuan teknis seseorang dalam bidang tertentu, seperti pemrograman, analisis data, desain, atau keterampilan teknis lainnya yang relevan dengan pekerjaan atau proyek tertentu. </p>
                </div>
                <a href=""><img class="w-[400px]" src="{{ asset('landing3.png') }}" alt=""></a>
            </div>
        </div>
    </div>
    
    <div class="flex justify-center items-center mt-[116px] h-[500px] bg-[rgba(243,172,80,0.2)]">
        <div class="">
            <div class="w-[1580px] px-7 flex justify-between">
                <div class="flex flex-col gap-[48px] justify-between w-[950px]">
                    <div class="flex flex-col gap-[21px] pr-20">
                        <h3 class="text-[40px] font-[700]">Apa itu <span class="text-[#4880FF]">tes minat dan bakat</span> ?</h3>
                        <p class="text-[#696984] text-[20px] font-[400]">Tes minat dan bakat adalah jenis evaluasi yang bertujuan untuk membantu seseorang memahami minat, kepribadian, serta bakat atau kemampuan alami yang dimilikinya. Tes ini biasanya digunakan untuk panduan dalam pengambilan keputusan penting, seperti pemilihan jurusan pendidikan, karier, atau pengembangan diri.</p>
                    </div>
                    <a href=""><img class="w-[400px]" src="{{ asset('landing5.png') }}" alt=""></a>
                </div>
    
                <div class="flex flex-col w-[488px]">
                    <img class="h-full" src="{{ asset('landing4.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center h-[840px]">
        <div class="flex flex-col items-center gap-[50px]">
            <h2 class="text-[40px] font-[700]">How <span class="text-[#4880FF]">Match</span>Job Work</h2>
            
            <div class="w-[1320px]">
                <img src="{{ asset('landing6.png') }}" alt="">
            </div>
        </div>
    </div>

    <div class="mt=[77px] flex flex-col justify-center items-center">
        <div class="flex flex-col gap-4 justify-center items-center">
            <h3 class="text-[36px] font-[700]">Belajar <span class="text-[#4880FF]">Gak Pake Ribet</span>, Karier Makin <span class="text-[#4880FF]">Ngebut</span>!</h3 class="text-[]">
            <p class="text-[#696984] text-[20px] font-[400] w-[731px] text-center">Akses materi pembelajaran interaktif yang siap bantu kamu upgrade skill dan jadi kandidat idaman perusahaan.</p>
        </div>
    </div>

    <div class="mt-52 text-center text-[20px] font-[400]">
        ini footer nantii
    </div>





    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK",
                confirmButtonColor: "#3085d6"
            });
        });
    </script>
    @endif
</body>
</html>