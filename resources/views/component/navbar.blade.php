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
        
        <!-- Login Button -->
        <div class="justify-self-end">
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-[23px] font-[500] bg-transparent border-none cursor-pointer">Welcome, {{ auth()->user()->name }}</button>
                </form>
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
    </div>
</nav>

<!-- Simple JavaScript for Mobile Menu Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>