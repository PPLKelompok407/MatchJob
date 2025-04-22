<div class="sidebar-container">
    <!-- Sidebar -->
    <div 
        class="fixed left-0 top-0 bottom-0 h-full bg-white flex flex-col items-center z-50 transition-all duration-300 ease-in-out"
        :class="$store.sidebar.open ? 'w-64 shadow-xl' : 'w-[70px]'"
        @mouseenter="$store.sidebar.setOpen(true)" 
        @mouseleave="$store.sidebar.setOpen(false)"
        x-data
    >
        <div class="mt-4 px-4 w-full">
            <div class="text-gray-500 font-medium mb-6" :class="$store.sidebar.open ? 'block text-left mt-[60px]' : 'hidden'">
                MENU
            </div>
        </div>
        
        <div class="w-full flex flex-col items-start">
            {{-- Icon Profil --}}
            <a href="{{ route('pages.profile.personal') }}" class="w-full flex items-center px-4 py-3 transition-colors duration-200 hover:bg-blue-50 relative group rounded-tr-md rounded-br-md" :class="$store.sidebar.open ? 'ml-[5px]' : 'mt-[108px]'">
                <span class="flex items-center justify-center w-[24px]">
                    @if(request()->routeIs('pages.profile.personal'))
                        <img src="{{ asset('profile_sidebar_hover.png') }}" alt="Profil" class="w-[24px] ml-2">
                    @else
                        <img src="{{ asset('profile_sidebar.png') }}" alt="Profil" class="w-[24px] ml-2">
                    @endif
                </span>
                <span 
                    class="ml-4 text-sm transition-all duration-200 text-gray-700 whitespace-nowrap overflow-hidden" 
                    :class="$store.sidebar.open ? 'opacity-100 w-auto' : 'opacity-0 w-0'"
                >
                    Edit Profil
                </span>
            </a>

            {{-- Icon Analisis --}}
            <a href="{{ route('pages.profile.analys') }}" class="w-full flex items-center px-4 py-3 transition-colors duration-200 hover:bg-blue-50 relative group rounded-tr-md rounded-br-md" :class="$store.sidebar.open ? 'ml-[5px]' : ''">
                <span class="flex items-center justify-center w-[24px]">
                    @if(request()->routeIs('pages.profile.analys'))
                        <img src="{{ asset('analys_sidebar_hover.png') }}" alt="Analisis" class="w-[24px] ml-2">
                    @else
                        <img src="{{ asset('analys_sidebar.png') }}" alt="Analisis" class="w-[24px] ml-2">
                    @endif
                </span>
                <span 
                    class="ml-4 text-sm transition-all duration-200 text-gray-700 whitespace-nowrap overflow-hidden" 
                    :class="$store.sidebar.open ? 'opacity-100 w-auto' : 'opacity-0 w-0'"
                >
                    Hasil Tes
                </span>
            </a>
        </div>
    </div>

    <!-- Overlay for dark background -->
    <div 
        x-data
        x-show="$store.sidebar.open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-30 z-40"
    ></div>
</div>

<!-- Initialize Alpine.js store for sidebar -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('sidebar', {
            open: false,
            setOpen(value) {
                this.open = value;
            }
        });
    });
</script> 