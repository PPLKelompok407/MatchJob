<nav class="bg-white shadow-md py-4 sticky top-0 left-0 right-0 w-full z-50">
    <div class="container mx-auto px-4 grid grid-cols-3 items-center">
        <!-- Logo and Name -->
        <div>
            <img src="{{ asset('logo.png') }}" alt="MatchJob Logo" class="">
        </div>
        
        <!-- Navigation Links -->
        <div class="hidden md:block justify-self-center">
            <div class="grid grid-flow-col gap-8">
                <a href="#" class="text-gray-500 hover:text-gray-700 transition">Beranda</a>
                <a href="#" class="text-gray-500 hover:text-gray-700 transition">Layanan</a>
                <a href="#" class="text-gray-500 hover:text-gray-700 transition">Artikel</a>
                <a href="#" class="text-gray-500 hover:text-gray-700 transition">Tentang Kami</a>
            </div>
        </div>
        
        <!-- Login Button / User Profile -->
        <div class="justify-self-end">
            @auth
                <div class="relative">
                    <!-- User Profile Button -->
                    <div class="flex items-center gap-3 cursor-pointer" id="profile-dropdown-button">
                        <span class="text-[#222] text-[16px] font-medium">{{ auth()->user()->name }}</span>
                        <div class="flex items-center">
                            <img src="{{ asset('profile.png') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                            <img src="{{ asset('dropdown.png') }}" alt="Profile" class="w-[27px] rounded-full object-cover">
                            
                        </div>
                    </div>
                    
                    <!-- Dropdown Menu -->
                    <div id="profile-dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden z-50">
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-[#353535] font-[500] hover:bg-gray-100">
                            <img src="{{ asset('profile.png') }}" alt="Profile Icon" class="w-5 h-5 mr-3">
                            Profil Saya
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm font-[600] text-[#A51535] hover:bg-gray-100">
                                <img src="{{ asset('logout.png') }}" alt="Profile Icon" class="w-5 h-5 mr-3">
                                Log out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition">
                    Login
                </a>
            @endauth
        </div>
        
        <!-- Mobile Menu Button (Hidden on Desktop) -->
        <div class="md:hidden justify-self-end">
            <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Mobile menu (Hidden by Default) -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pt-2 pb-4 bg-white grid gap-2 z-40">
        <a href="#" class="block py-2 text-gray-500 hover:text-gray-700 transition">Beranda</a>
        <a href="#" class="block py-2 text-gray-500 hover:text-gray-700 transition">Layanan</a>
        <a href="#" class="block py-2 text-gray-500 hover:text-gray-700 transition">Artikel</a>
        <a href="#" class="block py-2 text-gray-500 hover:text-gray-700 transition">Tentang Kami</a>
        @auth
            <div class="py-2">
                <a href="#" class="block py-2 text-gray-500 hover:text-gray-700 transition">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('profile.png') }}" alt="Profile Icon" class="w-5 h-5">
                        Profil Saya
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block py-2 text-red-500 hover:text-red-700 transition">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('logout.png') }}" alt="Profile Icon" class="w-5 h-5 mr-3">
                            Log out
                        </div>
                    </button>
                </form>
            </div>
        @endauth
    </div>
</nav>

<!-- JavaScript for Mobile Menu and Profile Dropdown Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Profile dropdown toggle
        const profileDropdownButton = document.getElementById('profile-dropdown-button');
        const profileDropdownMenu = document.getElementById('profile-dropdown-menu');
        
        if (profileDropdownButton && profileDropdownMenu) {
            profileDropdownButton.addEventListener('click', function() {
                profileDropdownMenu.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!profileDropdownButton.contains(event.target) && !profileDropdownMenu.contains(event.target)) {
                    profileDropdownMenu.classList.add('hidden');
                }
            });
        }
    });
</script>