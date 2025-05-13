<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Leaflet Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>
<body class="bg-[#EDF2FF]">
    @include('component.navbar')
    
    {{-- Sidebar --}}
    @include('component.sidebar')

    <div class="mt-[53px] flex justify-center">
        <div class="flex flex-col">
            <div class="h-[50px] overflow-hidden">
                <img src="{{ asset('personal_card.png') }}" alt="" class="w-full object-cover">
            </div>

            <div class="personal-card bg-white rounded-b-2xl shadow-md p-6 mb-10 mt-[-1px]">
                <div class="flex flex-col md:flex-row items-start justify-center md:items-center mb-8 space-y-4 md:space-y-0">

                    <div class="flex items-center gap-[24px] mb-4">
                        <img src="{{ asset('profile.png') }}" alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 mb-[-35px] border-white -mt-10 shadow-md">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-500 text-sm">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    
                    <div class="md:ml-auto">
                        <a href="{{ route('pages.profile.personal') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium transition inline-block mr-2">
                            Kembali
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div>
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Nama Lengkap</h3>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Jenis Kelamin</h3>
                                <div class="relative">
                                    <select name="jenisa_kelamin" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                        <option value="" {{ auth()->user()->jenisa_kelamin === null ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ auth()->user()->jenisa_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ auth()->user()->jenisa_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 pr-6">
                                        <img src="{{ asset('dropdown.png') }}" alt="" class="w-[24px] opacity-50">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Riwayat Pendidikan</h3>
                                <input type="text" name="riwayat_pendidikan" value="{{ auth()->user()->riwayat_pendidikan }}" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>

                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Nomor Telepon</h3>
                                <input type="text" name="notelp" value="{{ auth()->user()->notelp }}" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div>
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Tempat Tanggal Lahir</h3>
                                <input type="text" name="tempat_tanggal_lahir" value="{{ auth()->user()->tempat_tanggal_lahir }}" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Alamat Lengkap</h3>
                                <textarea id="alamat-input" name="alamat" rows="3" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">{{ auth()->user()->alamat }}</textarea>
                                <div id="map" class="h-64 w-full mt-4 rounded-md border border-gray-200">
                                </div>
                                <input type="hidden" id="latitude" name="latitude" value="{{ auth()->user()->latitude ?? '-6.914744' }}">
                                <input type="hidden" id="longitude" name="longitude" value="{{ auth()->user()->longitude ?? '107.609810' }}">
                                <p class="text-xs text-gray-500 mt-2">Cari alamat di kotak pencarian atau klik pada peta untuk menandai lokasi Anda</p>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-[16px] font-[400] mb-2">Riwayat Kerja</h3>
                                <textarea name="riwayat_kerja" rows="3" class="border border-gray-200 rounded-md p-3 bg-white w-full focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">{{ auth()->user()->riwayat_kerja }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md text-sm font-medium transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert for Address Required -->
    @if(session('address_required'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "Perhatian!",
                text: "{{ session('address_message') }}",
                icon: "warning",
                confirmButtonText: "OK",
                confirmButtonColor: "#4880FF"
            }).then(() => {
                // Focus on alamat field after alert is closed
                document.getElementById('alamat-input').focus();
            });
        });
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get stored coordinates or default to Bandung, Indonesia
            const defaultLat = parseFloat(document.getElementById('latitude').value) || -6.914744;
            const defaultLng = parseFloat(document.getElementById('longitude').value) || 107.609810;
            
            // Initialize map centered on default location
            const map = L.map('map').setView([defaultLat, defaultLng], 15);
            
            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);
            
            // Create a marker and add it to the map
            let marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);
            
            // Update marker position and get address when marker is moved
            marker.on('dragend', function(event) {
                const position = marker.getLatLng();
                updateCoordinates(position.lat, position.lng);
                reverseGeocode(position.lat, position.lng);
            });
            
            // Add click event on map to place/move marker
            map.on('click', function(event) {
                const position = event.latlng;
                marker.setLatLng(position);
                updateCoordinates(position.lat, position.lng);
                reverseGeocode(position.lat, position.lng);
            });
            
            // Add geocoder control for searching addresses
            const geocoder = L.Control.geocoder({
                defaultMarkGeocode: false,
                placeholder: 'Cari alamat...',
                errorMessage: 'Alamat tidak ditemukan',
                collapsed: false
            }).addTo(map);
            
            // When location is found via geocoder
            geocoder.on('markgeocode', function(event) {
                const result = event.geocode;
                
                // Center map on result
                map.fitBounds(result.bbox);
                
                // Move marker to result
                marker.setLatLng(result.center);
                
                // Update coordinates and address
                updateCoordinates(result.center.lat, result.center.lng);
                document.getElementById('alamat-input').value = result.name;
            });
            
            // Function to update hidden fields with coordinates
            function updateCoordinates(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }
            
            // Function to convert coordinates to address (reverse geocoding)
            function reverseGeocode(lat, lng) {
                // Use Nominatim reverse geocoding service
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.display_name) {
                            document.getElementById('alamat-input').value = data.display_name;
                        }
                    })
                    .catch(error => {
                        console.error('Error during reverse geocoding:', error);
                    });
            }
            
            // Watch for changes in the address input
            const alamatInput = document.getElementById('alamat-input');
            
            // If we have coordinates but no address, do reverse geocoding
            if (alamatInput.value === '' && 
                document.getElementById('latitude').value && 
                document.getElementById('longitude').value) {
                reverseGeocode(defaultLat, defaultLng);
            }
            
            // Manual geocoding when user submits the address field
            alamatInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    geocodeAddress(alamatInput.value);
                }
            });
            
            // Function to convert address to coordinates (geocoding)
            function geocodeAddress(address) {
                // Use Nominatim geocoding service
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            const lat = parseFloat(data[0].lat);
                            const lng = parseFloat(data[0].lon);
                            
                            // Update map and marker
                            map.setView([lat, lng], 16);
                            marker.setLatLng([lat, lng]);
                            
                            // Update coordinates
                            updateCoordinates(lat, lng);
                        }
                    })
                    .catch(error => {
                        console.error('Error during geocoding:', error);
                    });
            }
        });
    </script>
</body>
</html>
