<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the companies.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Perusahaan::query();
        
        // Handle search if provided
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('bagian', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
        }
        
        // Get all companies
        $allCompanies = $query->get();
        
        // If user is logged in, sort companies by relevance
        if (Auth::check()) {
            $user = Auth::user();
            $perusahaan = $this->getRecommendedCompanies($allCompanies, $user);
        } else {
            $perusahaan = $allCompanies;
        }
        
        return view('pages.perusahaan.listperusahaan', compact('perusahaan'));
    }
    
    /**
     * Get recommended companies based on user test results and address proximity
     * 
     * @param \Illuminate\Database\Eloquent\Collection $companies
     * @param \App\Models\User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getRecommendedCompanies($companies, $user)
    {
        // Define weights for each factor
        $weights = [
            'test_mikat' => 0.3,  // 30%
            'test_sosec' => 0.3,  // 30%
            'alamat' => 0.4       // 40%
        ];
        
        // Calculate scores for each company
        foreach ($companies as $company) {
            $score = 0;
            
            // Calculate test_mikat match score (30%)
            if ($user->test_mikat) {
                $mikatScore = $this->calculateMikatScore($company->bagian, $user->test_mikat);
                $score += $mikatScore * $weights['test_mikat'];
            }
            
            // Calculate test_sosec match score (30%)
            if ($user->tes_teknis) {
                $sosecScore = $this->calculateSosecScore($company->bagian, $user->tes_teknis);
                $score += $sosecScore * $weights['test_sosec'];
            }
            
            // Calculate address proximity score (40%)
            // This uses the improved calculateAddressScore method that aligns with Leaflet map calculations
            if ($user->alamat && $company->alamat) {
                $addressScore = $this->calculateAddressScore($company->alamat, $user->alamat);
                
                // Store the raw address score for display purposes
                $company->address_match = round($addressScore * 100);
                
                // Add the weighted score to the total
                $score += $addressScore * $weights['alamat'];
            } else {
                $company->address_match = 0;
            }
            
            // Store the score with the company
            $company->match_score = $score;
        }
        
        // Sort companies by match score (descending)
        $sortedCompanies = $companies->sortByDesc('match_score');
        
        // Take top 5 companies or all if less than 5
        return $sortedCompanies->take(5)->values();
    }
    
    /**
     * Calculate match score between company division and user's mikat test result
     * 
     * @param string $companyDivision
     * @param string $userMikat
     * @return float
     */
    private function calculateMikatScore($companyDivision, $userMikat)
    {
        // Division categories based on mikat test results
        $mikatCategories = [
            'Kreatif (Seni, Desain, dan Kreativitas)' => [
                'desain', 'kreatif', 'seni', 'grafis', 'media', 'konten', 'produksi', 'visual'
            ],
            'Sosial (Komunikasi dan Hubungan Interpersonal)' => [
                'komunikasi', 'humas', 'customer service', 'pelayanan', 'hr', 'sdm', 'marketing', 'sales'
            ],
            'Teknikal (Teknik dan Analisis)' => [
                'teknik', 'it', 'developer', 'programmer', 'analis', 'teknisi', 'sistem', 'data', 'engineering'
            ],
            'Manajerial (Kepemimpinan dan Manajemen)' => [
                'manajer', 'supervisor', 'koordinator', 'pimpinan', 'direktur', 'kepala', 'manajemen', 'administrasi'
            ]
        ];
        
        // Get user's mikat category
        $userCategory = null;
        foreach ($mikatCategories as $category => $keywords) {
            if (Str::contains($userMikat, $category)) {
                $userCategory = $category;
                break;
            }
        }
        
        if (!$userCategory) {
            return 0.5; // Default score if category not found
        }
        
        // Check if company division matches user's mikat category
        $companyDivisionLower = Str::lower($companyDivision);
        $matchScore = 0.5; // Default medium score
        
        foreach ($mikatCategories[$userCategory] as $keyword) {
            if (Str::contains($companyDivisionLower, $keyword)) {
                $matchScore = 1.0; // Perfect match
                break;
            }
        }
        
        // Check other categories for partial matches
        if ($matchScore < 1.0) {
            foreach ($mikatCategories as $category => $keywords) {
                if ($category === $userCategory) continue;
                
                foreach ($keywords as $keyword) {
                    if (Str::contains($companyDivisionLower, $keyword)) {
                        $matchScore = 0.3; // Partial match with other category
                        break 2;
                    }
                }
            }
        }
        
        return $matchScore;
    }
    
    /**
     * Calculate match score between company division and user's sosec test result
     * 
     * @param string $companyDivision
     * @param string $userSosec
     * @return float
     */
    private function calculateSosecScore($companyDivision, $userSosec)
    {
        // RIASEC categories mapping to job divisions
        $sosecCategories = [
        'R' => ['engineering', 'mechanical', 'production', 'construction', 'operator', 'technician', 'field work'],
        'I' => ['research', 'analysis', 'data', 'laboratory', 'scientific', 'development', 'analyst'],
        'A' => ['design', 'art', 'creative', 'media', 'content', 'visual', 'music', 'writing'],
        'S' => ['education', 'health', 'counseling', 'service', 'customer service', 'social', 'hr', 'human resources'],
        'E' => ['marketing', 'sales', 'business', 'management', 'coordinator', 'supervisor', 'leadership', 'persuasion'],
        'C' => ['administration', 'finance', 'accounting', 'audit', 'data entry', 'secretary', 'documentation', 'clerical']
        ];
        
        // Extract RIASEC code from user's sosec result (assuming format like "RIA - Realistic, Investigative, Artistic")
        $riasecCode = '';
        if (preg_match('/([A-Z]{3})/', $userSosec, $matches)) {
            $riasecCode = $matches[1];
        } else {
            // If no code found, try to extract from text description
            $riasecTypes = ['Realistic', 'Investigative', 'Artistic', 'Social', 'Enterprising', 'Conventional'];
            foreach ($riasecTypes as $type) {
                if (Str::contains($userSosec, $type)) {
                    $riasecCode .= substr($type, 0, 1);
                }
            }
        }
        
        if (empty($riasecCode)) {
            return 0.5; // Default score if no RIASEC code found
        }
        
        // Check if company division matches user's RIASEC code
        $companyDivisionLower = Str::lower($companyDivision);
        $matchScore = 0.5; // Default medium score
        
        // Primary match (first letter of RIASEC code)
        $primaryType = substr($riasecCode, 0, 1);
        if (isset($sosecCategories[$primaryType])) {
            foreach ($sosecCategories[$primaryType] as $keyword) {
                if (Str::contains($companyDivisionLower, $keyword)) {
                    $matchScore = 1.0; // Perfect match with primary type
                    break;
                }
            }
        }
        
        // Secondary match (second letter of RIASEC code)
        if ($matchScore < 1.0 && strlen($riasecCode) > 1) {
            $secondaryType = substr($riasecCode, 1, 1);
            if (isset($sosecCategories[$secondaryType])) {
                foreach ($sosecCategories[$secondaryType] as $keyword) {
                    if (Str::contains($companyDivisionLower, $keyword)) {
                        $matchScore = 0.8; // Good match with secondary type
                        break;
                    }
                }
            }
        }
        
        // Tertiary match (third letter of RIASEC code)
        if ($matchScore < 0.8 && strlen($riasecCode) > 2) {
            $tertiaryType = substr($riasecCode, 2, 1);
            if (isset($sosecCategories[$tertiaryType])) {
                foreach ($sosecCategories[$tertiaryType] as $keyword) {
                    if (Str::contains($companyDivisionLower, $keyword)) {
                        $matchScore = 0.6; // Moderate match with tertiary type
                        break;
                    }
                }
            }
        }
        if ($matchScore < 0.8 && strlen($riasecCode) > 2) {
            $tertiaryType = substr($riasecCode, 2, 1);
            if (isset($sosecCategories[$tertiaryType])) {
                foreach ($sosecCategories[$tertiaryType] as $keyword) {
                    if (Str::contains($companyDivisionLower, $keyword)) {
                        $matchScore = 0.6; // Moderate match with tertiary type
                        break;
                    }
                }
            }
        }
        
        return $matchScore;
    }
    
    // Tertiary match (third letter of RIASEC code)

    /**
     * Calculate address proximity score between company and user addresses
     * 
     * @param string $companyAddress
     * @param string $userAddress
     * @return float
     */
    private function calculateAddressScore($companyAddress, $userAddress)
    {
        // First try to get coordinates for both addresses
        $companyCoords = $this->getCoordinatesFromAddress($companyAddress);
        $userCoords = $this->getCoordinatesFromAddress($userAddress);
        
        // If we have valid coordinates for both addresses, calculate distance-based score
        if ($companyCoords && $userCoords) {
            // Calculate distance in kilometers
            $distance = $this->calculateDistance(
                $userCoords['lat'],
                $userCoords['lng'],
                $companyCoords['lat'],
                $companyCoords['lng']
            );
            
            // Convert distance to a score (closer = higher score) using an inverse exponential function
            // This provides a smoother transition between distances and better aligns with Leaflet routing
            
            // Maximum distance to consider (in km)
            $maxDistance = 100;
            
            // Cap the distance at the maximum
            $distance = min($distance, $maxDistance);
            
            // Calculate score: 1.0 (at 0km) to 0.4 (at maxDistance km)
            // Using exponential decay formula: score = min_score + (max_score - min_score) * e^(-distance/scale_factor)
            $minScore = 0.4;  // Minimum score for very distant locations
            $maxScore = 1.0;  // Maximum score for exact same location
            $scaleFactor = 20; // Controls how quickly the score drops with distance
            
            $score = $minScore + ($maxScore - $minScore) * exp(-$distance / $scaleFactor);
            
            // Round to 2 decimal places for consistency
            return round($score, 2);
        }
        
        // Fallback to region-based matching if coordinates are not available
        $companyRegions = $this->extractRegions($companyAddress);
        $userRegions = $this->extractRegions($userAddress);
        
        // Calculate match score based on region overlap
        $maxScore = 0;
        
        foreach ($userRegions as $userRegion) {
            foreach ($companyRegions as $companyRegion) {
                // Calculate similarity between regions
                $similarity = $this->calculateStringSimilarity($userRegion, $companyRegion);
                $maxScore = max($maxScore, $similarity);
                
                // Exact match gets perfect score
                if ($similarity == 1) {
                    return 0.9; // Slightly lower than coordinate-based exact match
                }
            }
        }
        
        // Scale the score (0.3 minimum score for any address)
        return max(0.3, $maxScore);
    }
    
    /**
     * Extract regions (city, district, etc.) from an address string
     * 
     * @param string $address
     * @return array
     */
    private function extractRegions($address)
    {
        // Common Indonesian regions and cities
        $knownRegions = [
            'jakarta', 'bandung', 'surabaya', 'medan', 'semarang', 'makassar', 'palembang', 'depok',
            'tangerang', 'bekasi', 'bogor', 'malang', 'yogyakarta', 'jogja', 'solo', 'bali', 'denpasar',
            'balikpapan', 'samarinda', 'pontianak', 'banjarmasin', 'manado', 'jayapura', 'ambon',
            'jawa', 'sumatra', 'kalimantan', 'sulawesi', 'papua', 'barat', 'timur', 'tengah',
            'selatan', 'utara', 'dki', 'jabar', 'jatim', 'jateng', 'banten'
        ];
        
        $address = Str::lower($address);
        $regions = [];
        
        // Extract known regions
        foreach ($knownRegions as $region) {
            if (Str::contains($address, $region)) {
                $regions[] = $region;
            }
        }
        
        // If no known regions found, split by common separators and take words that might be regions
        if (empty($regions)) {
            $parts = preg_split('/[,\.\s\-]+/', $address);
            foreach ($parts as $part) {
                $part = trim($part);
                if (strlen($part) > 3 && !is_numeric($part) && !in_array($part, ['jalan', 'street', 'no', 'rt', 'rw', 'kode', 'pos', 'zip'])) {
                    $regions[] = $part;
                }
            }
        }
        
        return $regions;
    }
    
    /**
     * Calculate similarity between two strings (simplified version)
     * 
     * @param string $str1
     * @param string $str2
     * @return float
     */
    private function calculateStringSimilarity($str1, $str2)
    {
        // Exact match
        if ($str1 === $str2) {
            return 1.0;
        }
        
        // One string contains the other
        if (Str::contains($str1, $str2) || Str::contains($str2, $str1)) {
            return 0.8;
        }
        
        // Calculate Levenshtein distance for similar strings
        $len1 = strlen($str1);
        $len2 = strlen($str2);
        
        // If strings are very different in length, they're probably not similar
        if (abs($len1 - $len2) > 3) {
            return 0.1;
        }
        
        $distance = levenshtein($str1, $str2);
        $maxLen = max($len1, $len2);
        
        if ($maxLen === 0) {
            return 0;
        }
        
        // Convert distance to similarity score (0-1)
        $similarity = 1 - ($distance / $maxLen);
        
        return $similarity;
    }
    
    /**
     * Get coordinates (latitude and longitude) from an address using geocoding
     * 
     * @param string $address The address to geocode
     * @return array|null Array with 'lat' and 'lng' keys or null if geocoding failed
     */
    private function getCoordinatesFromAddress($address)
    {
        if (empty($address)) {
            return null;
        }
        
        // Create a cache key based on the address
        $cacheKey = 'geocode_' . md5($address);
        
        // Check if we have this address cached
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        
        // Use Nominatim API for geocoding (same as what Leaflet uses on client-side)
        $encodedAddress = urlencode($address);
        $url = "https://nominatim.openstreetmap.org/search?q={$encodedAddress}&format=json&limit=1&addressdetails=0";
        
        // Set a custom user agent as required by Nominatim's usage policy
        $options = [
            'http' => [
                'header' => "User-Agent: JobMatch-App/1.0\r\n",
                'timeout' => 5 // Set a 5 second timeout
            ]
        ];
        $context = stream_context_create($options);
        
        try {
            // No sleep delay - we'll use caching instead to respect rate limits
            $response = @file_get_contents($url, false, $context);
            if ($response === false) {
                return null;
            }
            
            $data = json_decode($response, true);
            if (empty($data)) {
                return null;
            }
            
            // Extract coordinates from the first result
            $result = [
                'lat' => (float) $data[0]['lat'],
                'lng' => (float) $data[0]['lon']
            ];
            
            // Cache the result for 30 days
            Cache::put($cacheKey, $result, now()->addDays(30));
            
            return $result;
        } catch (\Exception $e) {
            // Log error if needed
            // \Log::error('Geocoding error: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Calculate the distance between two points using the Haversine formula
     * 
     * @param float $lat1 Latitude of first point
     * @param float $lng1 Longitude of first point
     * @param float $lat2 Latitude of second point
     * @param float $lng2 Longitude of second point
     * @return float Distance in kilometers
     */
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        // Convert latitude and longitude from degrees to radians
        // Using PHP's built-in deg2rad function
        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);
        
        // Haversine formula
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        $a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlng/2) * sin($dlng/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = 6371 * $c; // Earth's radius in kilometers
        
        return $distance;
    }
    
    /**
     * Custom method to convert degrees to radians (not used, using PHP's built-in deg2rad instead)
     * Kept for reference
     * 
     * @param float $deg Angle in degrees
     * @return float Angle in radians
     */
    private function convertDegreesToRadians($deg) {
        return $deg * pi() / 180;
    }
    
    /**
     * Display the specified company details.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        
        // Initialize with default values
        $distance = 0; // Will be calculated by Leaflet map component
        $testBakatScore = 78; // Default placeholder value
        $testRiasecScore = 69; // Default placeholder value
        
        // If user is logged in, calculate actual values
        if (Auth::check()) {
            $user = Auth::user();
            
            // Note: The distance calculation below is a placeholder
            // The actual distance will be calculated by the Leaflet map component
            // using the geocoded addresses and routing information
            
            // Calculate test match scores if test results are available
            if ($user->test_mikat) {
                $testBakatScore = round($this->calculateMikatScore($perusahaan->bagian, $user->test_mikat) * 100);
            }
            
            if ($user->tes_teknis) {
                $testRiasecScore = round($this->calculateSosecScore($perusahaan->bagian, $user->tes_teknis) * 100);
            }
        }
        
        return view('pages.perusahaan.detailperusahaan', compact('perusahaan', 'distance', 'testBakatScore', 'testRiasecScore'));
    }
}

