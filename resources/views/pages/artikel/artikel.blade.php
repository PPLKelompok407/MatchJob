<div class="mt-[77px] flex flex-col items-center w-full px-4 md:px-8 lg:px-16">
    <form action="{{ request()->url() }}" method="GET" class="w-full flex justify-center" id="filterForm">
        <div class="w-full max-w-6xl flex flex-col md:flex-row items-center justify-center gap-4 mb-[53px] bg-white p-4 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row w-full gap-4 justify-center">
                <div class="w-full md:w-64">
                    <div class="flex flex-col">
                        <button type="button" id="categoryDropdownButton" class="flex items-center justify-between w-full bg-white border border-gray-300 rounded-lg py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M17 14V20M14 17H20M6 10H8C8.53043 10 9.03914 9.78929 9.41421 9.41421C9.78929 9.03914 10 8.53043 10 8V6C10 5.46957 9.78929 4.96086 9.41421 4.58579C9.03914 4.21071 8.53043 4 8 4H6C5.46957 4 4.96086 4.21071 4.58579 4.58579C4.21071 4.96086 4 5.46957 4 6V8C4 8.53043 4.21071 9.03914 4.58579 9.41421C4.96086 9.78929 5.46957 10 6 10ZM16 10H18C18.5304 10 19.0391 9.78929 19.4142 9.41421C19.7893 9.03914 20 8.53043 20 8V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4H16C15.4696 4 14.9609 4.21071 14.5858 4.58579C14.2107 4.96086 14 5.46957 14 6V8C14 8.53043 14.2107 9.03914 14.5858 9.41421C14.9609 9.78929 15.4696 10 16 10ZM6 20H8C8.53043 20 9.03914 19.7893 9.41421 19.4142C9.78929 19.0391 10 18.5304 10 18V16C10 15.4696 9.78929 14.9609 9.41421 14.5858C9.03914 14.2107 8.53043 14 8 14H6C5.46957 14 4.96086 14.2107 4.58579 14.5858C4.21071 14.9609 4 15.4696 4 16V18C4 18.5304 4.21071 19.0391 4.58579 19.4142C4.96086 19.7893 5.46957 20 6 20Z" stroke="#282938" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>Category</span>
                            </div>
                            <svg class="w-5 h-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div id="categoryDropdownMenu" class="absolute z-10 w-[200px] mt-1 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                            <div class="p-3">
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" id="selectAll" class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Semua</span>
                                </label>
                                <hr class="my-2">
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="categories[]" value="tips" {{ in_array('tips', request('categories', [])) ? 'checked' : '' }} class="category-checkbox form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Tips & Tricks</span>
                                </label>
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="categories[]" value="event" {{ in_array('event', request('categories', [])) ? 'checked' : '' }} class="category-checkbox form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Event</span>
                                </label>
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="categories[]" value="berita" {{ in_array('berita', request('categories', [])) ? 'checked' : '' }} class="category-checkbox form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Berita</span>
                                </label>
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="categories[]" value="soft skill" {{ in_array('soft skill', request('categories', [])) ? 'checked' : '' }} class="category-checkbox form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Soft Skill</span>
                                </label>
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" name="categories[]" value="hard skill" {{ in_array('hard skill', request('categories', [])) ? 'checked' : '' }} class="category-checkbox form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Hard Skill</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="categories[]" value="tutorial" {{ in_array('tutorial', request('categories', [])) ? 'checked' : '' }} class="category-checkbox form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Tutorial</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Blog, Event atau Berita . . ." class="appearance-none bg-white border border-gray-300 rounded-lg py-2 px-4 w-full text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300 ease-in-out w-full md:w-auto">Search</button>
        </div>
    </form>
    <div class="w-full max-w-6xl">
        <h1 class="text-[40px] font-[800] text-[#4880FF] mb-12">Rekomendasi Artikel</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            @php
                $artikelQuery = \App\Models\Artikel::query();
                
                // Fitur Filter berdasarkan katagori
                if(request('categories') && is_array(request('categories'))) {
                    $artikelQuery->whereIn('category', request('categories'));
                }
                
                // Fitur Fitler berdasarkan search kata kunci
                if(request('search')) {
                    $search = request('search');
                    $artikelQuery->where(function($query) use ($search) {
                        $query->where('judul', 'like', "%{$search}%")
                              ->orWhere('description', 'like', "%{$search}%");
                    });
                }
                
                $artikels = $artikelQuery->get();
            @endphp
            
            @if($artikels->count() > 0)
                @foreach($artikels as $artikel)
                <a href="{{ $artikel->link }}" target="_blank" class="block group">
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="h-[269px] w-[589px] overflow-hidden">
                            <img src="{{ asset($artikel->image) }}" class="w-full h-full object-cover transition-transform duration-300">
                        </div>
                        <div class="p-5">
                            <span class="inline-block bg-[#F4C467] text-[#252641] text-[20px] font-[500] rounded-[80px] px-[23px] py-[5px] mb-3">{{ $artikel->category }}</span>
                            <h3 class="text-[24px] font-[500] text-gray-800 mb-2 group-hover:text-blue-600 transition-colors duration-300">{{ $artikel->judul }}</h3>
                            <p class="text-[16px] font-[400] text-gray-600 line-clamp-3">{{ $artikel->description }} <span class="text-[#4880FF]">selengkapnya</span></p>
                        </div>
                    </div>
                </a>
                @endforeach
            @else
                <div class="col-span-2 text-center py-12">
                    <p class="text-xl text-gray-600">Tidak ada artikel yang ditemukan.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownButton = document.getElementById('categoryDropdownButton');
        const dropdownMenu = document.getElementById('categoryDropdownMenu');
        const selectAllCheckbox = document.getElementById('selectAll');
        const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
        const filterForm = document.getElementById('filterForm');
        
        // Save scroll position before form submission
        if (filterForm) {
            filterForm.addEventListener('submit', function(e) {
                // Store current scroll position in session storage
                sessionStorage.setItem('scrollPosition', window.scrollY);
            });
        }
        
        // Restore scroll position after page load if coming from form submission
        const savedScrollPosition = sessionStorage.getItem('scrollPosition');
        if (savedScrollPosition) {
            window.scrollTo(0, parseInt(savedScrollPosition));
            // Clear the saved position after using it
            sessionStorage.removeItem('scrollPosition');
        }
        
        // Toggle dropdown menu
        dropdownButton.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
        
        // Select all functionality
        selectAllCheckbox.addEventListener('change', function() {
            categoryCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
        
        // Update select all checkbox state based on individual checkboxes
        function updateSelectAllCheckbox() {
            const allChecked = Array.from(categoryCheckboxes).every(checkbox => checkbox.checked);
            const someChecked = Array.from(categoryCheckboxes).some(checkbox => checkbox.checked);
            
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = someChecked && !allChecked;
        }
        
        // Initialize select all checkbox state
        updateSelectAllCheckbox();
        
        // Add event listeners to category checkboxes
        categoryCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectAllCheckbox);
        });
    });
</script>