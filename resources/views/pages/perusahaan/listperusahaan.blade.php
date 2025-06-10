@php
use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perusahaan - MatchJob</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="anonymous" />
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="anonymous"></script>
    <!-- Leaflet Control Geocoder for address search -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>
<body>
    @include('component.navbar')
    <div class="min-h-screen z-10">
        <div class="bg-gradient-to-r bg-[#EDF2FF] h-[155px] pt-4 px-6 md:px-12 lg:px-20 overflow-hidden">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-2 hidden md:block">
                    <img class="w-[90px] mt-[30px]" src="{{ asset('perusahaan1_icon.png') }}" alt="">
                </div>
                <div class="md:col-span-8 text-center text-[#25324B]">
                    <h1 class="text-[24px] font-[600] mb-4">Langkah Awal Menuju <span class="text-[#4880FF]">Karier Impian</span> Dimulai di Sini.</h1>
                    <h3 class="text-[20px] font-[600] mt-[-20px]">Temukan <span class="text-[#4880FF]">perusahaan</span> yang <span class="text-[#4880FF]">tepat</span> untuk Anda</h3>
                </div>
                <div class="md:col-span-2 hidden md:block">
                    <img class="w-[141px] h-[96px] ml-auto" src="{{ asset('perusahaan2_icon.png') }}" alt="">
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="mb-8">
                <form action="{{ route('perusahaan.list') }}" method="GET" class="flex items-center w-full">
                    <input type="text" name="search" placeholder="Cari perusahaan" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500" value="{{ request('search') }}" />
                    <button type="submit" class="bg-[#4880FF] text-white font-medium px-6 py-2 rounded-md ml-2 shadow-sm hover:bg-blue-600 transition-colors">Cari</button>
                </form>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Rekomendasi<span class="text-[#4880FF]">perusahaan</span> untuk Anda</h2>
            
            <div class="grid grid-cols-1 gap-6">
                @forelse($perusahaan as $company)
                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 bg-gray-100 rounded-md flex items-center justify-center">
                                <span class="p-10 font-bold text-gray-500">{{ substr($company->nama, 0, 2) }}</span>
                            </div>
                            <div class="w-full">
                                <h3 class="text-xl font-bold text-gray-800">{{ $company->nama }}</h3>
                                <p class="text-gray-600">{{ $company->bagian }}</p>
                                <p class="text-gray-500" data-company-address="{{ $company->alamat }}" data-company-id="{{ $company->id }}">{{ $company->alamat }}</p>
                                <p id="distance_{{ $company->id }}" class="text-sm text-blue-600 hidden"></p>
                                @if(Auth::check() && isset($company->match_score))
                                <div class="mt-2 w-[300px]">
                                    @php
                                        $matchPercentage = round($company->match_score * 100);
                                        $matchColor = 'bg-red-500';
                                        if ($matchPercentage >= 80) {
                                            $matchColor = 'bg-green-500';
                                        } elseif ($matchPercentage >= 60) {
                                            $matchColor = 'bg-blue-500';
                                        } elseif ($matchPercentage >= 40) {
                                            $matchColor = 'bg-yellow-500';
                                        }
                                    @endphp
                                    <div class="flex items-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                                            <div class="{{ $matchColor }} h-2.5 rounded-full" style="width: {{ $matchPercentage }}%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">{{ $matchPercentage }}% Cocok</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-gray-700 font-medium">
                                @if($company->location_type == 'remote')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        Remote
                                    </span>
                                @elseif($company->location_type == 'hybrid')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        Hybrid
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        On-site
                                    </span>
                                @endif
                            </span>
                            <a href="{{ route('perusahaan.detail', $company->id) }}" class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                                Lihat Detail
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <p class="text-center text-gray-500">Tidak ada perusahaan yang ditemukan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('component.footer')
    
    @if(Auth::check())
    <script>
        // Function to get user's coordinates
        function getUserCoordinates() {
            return new Promise((resolve, reject) => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        position => {
                            const userCoords = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            // Store user coordinates in localStorage
                            localStorage.setItem('userCoordinates', JSON.stringify(userCoords));
                            resolve(userCoords);
                        },
                        error => {
                            console.error('Error getting user location:', error);
                            // Fallback to geocoding the user's address
                            geocodeUserAddress().then(resolve).catch(reject);
                        },
                        { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 }
                    );
                } else {
                    console.error('Geolocation is not supported by this browser');
                    // Fallback to geocoding the user's address
                    geocodeUserAddress().then(resolve).catch(reject);
                }
            });
        }

        // Function to geocode user's address from profile
        function geocodeUserAddress() {
            return new Promise((resolve, reject) => {
                const userAddress = "{{ Auth::user()->alamat }}";
                if (!userAddress) {
                    reject('No user address available');
                    return;
                }
                
                const geocoder = L.Control.Geocoder.nominatim();
                geocoder.geocode(userAddress, results => {
                    if (results && results.length > 0) {
                        const userCoords = {
                            lat: results[0].center.lat,
                            lng: results[0].center.lng
                        };
                        // Store user coordinates in localStorage
                        localStorage.setItem('userCoordinates', JSON.stringify(userCoords));
                        resolve(userCoords);
                    } else {
                        reject('Could not geocode user address');
                    }
                });
            });
        }

        // Function to geocode company addresses
        function geocodeCompanyAddresses() {
            const companies = document.querySelectorAll('[data-company-address]');
            const geocoder = L.Control.Geocoder.nominatim();
            
            companies.forEach(company => {
                const companyAddress = company.getAttribute('data-company-address');
                const companyId = company.getAttribute('data-company-id');
                
                geocoder.geocode(companyAddress, results => {
                    if (results && results.length > 0) {
                        const companyCoords = {
                            lat: results[0].center.lat,
                            lng: results[0].center.lng
                        };
                        
                        // Store company coordinates in localStorage
                        localStorage.setItem(`companyCoordinates_${companyId}`, JSON.stringify(companyCoords));
                        
                        // Calculate and display distance if user coordinates are available
                        const userCoordsStr = localStorage.getItem('userCoordinates');
                        if (userCoordsStr) {
                            const userCoords = JSON.parse(userCoordsStr);
                            const distance = calculateDistance(
                                userCoords.lat, userCoords.lng,
                                companyCoords.lat, companyCoords.lng
                            );
                            
                            // Update distance display
                            const distanceElement = document.getElementById(`distance_${companyId}`);
                            if (distanceElement) {
                                distanceElement.textContent = `${distance.toFixed(1)} km dari lokasi Anda`;
                                distanceElement.classList.remove('hidden');
                            }
                        }
                    }
                });
            });
        }

        // Calculate distance between two points using Haversine formula
        function calculateDistance(lat1, lng1, lat2, lng2) {
            const R = 6371; // Earth's radius in kilometers
            const dLat = deg2rad(lat2 - lat1);
            const dLng = deg2rad(lng2 - lng1);
            const a = 
                Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
                Math.sin(dLng/2) * Math.sin(dLng/2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            const distance = R * c; // Distance in kilometers
            return distance;
        }

        function deg2rad(deg) {
            return deg * (Math.PI/180);
        }

        // Initialize when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Get user coordinates first
            getUserCoordinates().then(() => {
                // Then geocode company addresses
                geocodeCompanyAddresses();
            }).catch(error => {
                console.error('Error in location processing:', error);
            });
        });
    </script>
    @endif
</body>
</html>