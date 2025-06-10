<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<!-- Leaflet Routing Machine CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />

<style>
    #map {
        height: 500px;
        width: 100%;
        border-radius: 8px;
    }
</style>

<!-- Map Section -->
<div class="container mx-auto px-4 py-8 mb-12 max-w-6xl">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Rute ke Lokasi Perusahaan</h2>
        <div id="map"></div>
        <p class="mt-4 text-sm text-gray-600">
            <i class="fas fa-info-circle mr-2"></i>
            Rute menunjukkan jarak dari alamat Anda ke lokasi perusahaan. Waktu tempuh dapat bervariasi berdasarkan kondisi lalu lintas.
        </p>
    </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<!-- Leaflet Routing Machine JS -->
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get user and company addresses from PHP variables
        const userAddress = "{{ Auth::user()->alamat }}";
        const companyAddress = "{{ $perusahaan->alamat }}";
        
        // Initialize map
        const map = L.map('map').setView([-6.9175, 107.6191], 13); // Default to Bandung coordinates
        
        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Function to calculate distance between two coordinates in kilometers
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius of the earth in km
            const dLat = deg2rad(lat2 - lat1);
            const dLon = deg2rad(lon2 - lon1);
            const a = 
                Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
                Math.sin(dLon/2) * Math.sin(dLon/2); 
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
            const distance = R * c; // Distance in km
            return distance.toFixed(1); // Return with 1 decimal place
        }
        
        function deg2rad(deg) {
            return deg * (Math.PI/180);
        }
        
        // Function to update distance in the UI
        function updateDistanceUI(distance) {
            // Update the distance in the UI
            const distanceElements = document.querySelectorAll('.distance-value');
            distanceElements.forEach(element => {
                element.textContent = distance;
            });
            
            // Update the parent page directly
            if (window.parent && window.parent !== window) {
                window.parent.postMessage({ distance: distance }, '*');
            } else {
                // Direct DOM update if not in an iframe
                const parentDistanceElements = document.querySelectorAll('.distance-value');
                parentDistanceElements.forEach(element => {
                    element.textContent = distance;
                });
            }
        }
        
        // Function to geocode address to coordinates
        async function geocodeAddress(address) {
            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`);
                const data = await response.json();
                if (data && data.length > 0) {
                    return [parseFloat(data[0].lat), parseFloat(data[0].lon)];
                }
                return null;
            } catch (error) {
                console.error('Geocoding error:', error);
                return null;
            }
        }
        
        // Function to initialize routing
        async function initializeRouting() {
            try {
                // Geocode user and company addresses
                const userCoords = await geocodeAddress(userAddress);
                const companyCoords = await geocodeAddress(companyAddress);
                
                if (userCoords && companyCoords) {
                    // Calculate initial distance between coordinates
                    const initialDistanceKm = calculateDistance(
                        userCoords[0], userCoords[1], 
                        companyCoords[0], companyCoords[1]
                    );
                    
                    // Update the UI with initial distance calculation
                    updateDistanceUI(initialDistanceKm);
                    // Add markers for user and company locations
                    L.marker(userCoords).addTo(map)
                        .bindPopup('Lokasi Anda')
                        .openPopup();
                        
                    L.marker(companyCoords).addTo(map)
                        .bindPopup(`${companyAddress}`)
                        .openPopup();
                    
                    // Create routing control
                    const routingControl = L.Routing.control({
                        waypoints: [
                            L.latLng(userCoords[0], userCoords[1]),
                            L.latLng(companyCoords[0], companyCoords[1])
                        ],
                        routeWhileDragging: true,
                        lineOptions: {
                            styles: [{ color: '#4880FF', weight: 4 }]
                        },
                        createMarker: function() { return null; } // Don't create default markers
                    }).addTo(map);
                    
                    // Get more accurate distance from routing machine when route is calculated
                    routingControl.on('routesfound', function(e) {
                        const routes = e.routes;
                        const summary = routes[0].summary;
                        // Distance is in meters, convert to kilometers
                        const routeDistanceKm = (summary.totalDistance / 1000).toFixed(1);
                        
                        // Update the UI with the more accurate route distance
                        updateDistanceUI(routeDistanceKm);
                    });
                    
                    // Fit map to show both points
                    const bounds = L.latLngBounds([userCoords, companyCoords]);
                    map.fitBounds(bounds, { padding: [50, 50] });
                } else {
                    document.getElementById('map').innerHTML = '<div class="p-4 text-center text-red-500">Tidak dapat menemukan koordinat untuk alamat yang diberikan.</div>';
                }
            } catch (error) {
                console.error('Routing error:', error);
            }
        }
        
        // Initialize routing
        initializeRouting();
    });
</script>
