@extends('admin.layout')

@section('content')
<!-- Top KPIs -->
<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
    <!-- KPI: Total Views -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white border rounded-lg p-6 flex items-start justify-between">
        <div>
            <div class="text-xs text-blue-100">Total Views</div>
            <div class="mt-1 text-3xl font-semibold">{{ number_format($stats['total_views'] ?? 0) }}</div>
        </div>
        <div class="text-blue-200"><i class="bi bi-eye-fill text-2xl"></i></div>
    </div>
    <!-- KPI: Contact Sales Clicks -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white border rounded-lg p-6 flex items-start justify-between">
        <div>
            <div class="text-xs text-green-100">Contact Sales Clicks</div>
            <div class="mt-1 text-3xl font-semibold">{{ number_format($stats['contact_sales'] ?? 0) }}</div>
        </div>
        <div class="text-green-200"><i class="bi bi-telephone-fill text-2xl"></i></div>
    </div>
    <!-- KPI: Products In Stock -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white border rounded-lg p-6 flex items-start justify-between">
        <div>
            <div class="text-xs text-purple-100">Products In Stock</div>
            <div class="mt-1 text-3xl font-semibold">{{ number_format($stats['products'] ?? 0) }}</div>
        </div>
        <div class="text-purple-200"><i class="bi bi-box-seam text-2xl"></i></div>
    </div>
    <!-- KPI: Returning Customers -->
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white border rounded-lg p-6 flex items-start justify-between">
        <div>
            <div class="text-xs text-orange-100">Returning Customers</div>
            <div class="mt-1 text-3xl font-semibold">{{ number_format($stats['returning_customers'] ?? 0) }}</div>
        </div>
        <div class="text-orange-200"><i class="bi bi-arrow-repeat text-2xl"></i></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Monthly Sales -->
    <div class="mt-6 bg-white border rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm font-semibold">Monthly Sales</div>
            </div>
            <button class="text-gray-400"><i class="bi bi-three-dots"></i></button>
        </div>
        <div class="mt-4">
            <canvas id="monthlySalesChart" ></canvas>
        </div>
    </div>
    <div class="mt-6 bg-white border rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="text-sm font-semibold">Customers Demographic</div>
            <button class="text-gray-400"><i class="bi bi-three-dots"></i></button>
        </div>
        <div class="text-xs text-gray-500 mb-2">Number of customer based on country</div>

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
                integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
                crossorigin=""/>

        <!-- Interactive OpenStreetMap -->
        {{-- <div id="customerMap" class="h-48 bg-gray-50 rounded border relative overflow-hidden"></div> --}}

        <div class="mt-6 space-y-3 text-sm">
            @php
                $colors = ['bg-blue-500','bg-indigo-500','bg-teal-500','bg-rose-500','bg-amber-500','bg-purple-500'];
                $flagEmojis = [
                    'United States' => '🇺🇸',
                    'USA' => '🇺🇸',
                    'France' => '🇫🇷',
                    'Germany' => '🇩🇪',
                    'United Kingdom' => '🇬🇧',
                    'UK' => '🇬🇧',
                    'Canada' => '🇨🇦',
                    'Australia' => '🇦🇺',
                    'Japan' => '🇯🇵',
                    'China' => '🇨🇳',
                    'India' => '🇮🇳',
                    'Brazil' => '🇧🇷',
                    'Russia' => '🇷🇺',
                    'South Africa' => '🇿🇦',
                    'Mexico' => '🇲🇽',
                    'Italy' => '🇮🇹',
                    'Spain' => '🇪🇸',
                    'Netherlands' => '🇳🇱',
                    'Sweden' => '🇸🇪',
                    'Norway' => '🇳🇴',
                    'Tanzania' => '🇹🇿',
                    'Kenya' => '🇰🇪',
                    'Uganda' => '🇺🇬',
                    'Rwanda' => '🇷🇼',
                    'Burundi' => '🇧🇮',
                ];
            @endphp
            @if(isset($geoStats) && count($geoStats) > 0)
                @foreach($geoStats as $i => $g)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-lg">{{ $flagEmojis[$g['country']] ?? '🌍' }}</span>
                            <span class="font-medium">{{ $g['country'] ?? 'Unknown' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-500">{{ number_format($g['count']) }} Customers</span>
                            <span class="font-semibold">{{ $g['percent'] }}%</span>
                        </div>
                    </div>
                    <div class="w-full h-2 bg-gray-100 rounded">
                        <div class="h-2 {{ $colors[$i % count($colors)] }} rounded transition-all duration-500"
                                style="width:{{ max(0, min(100, $g['percent'])) }}%"></div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-2">
                        <i class="bi bi-globe text-3xl"></i>
                    </div>
                    <div class="text-xs text-gray-500">No location data yet. Views will populate this chart.</div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Demographics + Recent Orders -->
<div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Customers Demographic -->


    <!-- Recently Added Products -->
    <div class="bg-white border rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Recently Added Products</h3>
                <p class="text-sm text-gray-500">Latest products added to your inventory</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    {{ count($latestProducts ?? []) }} items
                </span>
                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="bi bi-three-dots text-lg"></i>
                </button>
            </div>
        </div>

        <div class="space-y-4">
            @forelse(($latestProducts ?? []) as $p)
                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                    <!-- Product Image Placeholder -->
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-semibold text-sm shadow-sm">
                            {{ strtoupper(substr($p->name, 0, 2)) }}
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-medium text-gray-900 truncate group-hover:text-blue-600 transition-colors">
                            {{ $p->name }}
                        </h4>
                        <div class="flex items-center gap-2 mt-1">
                            @if($p->categoryRelation)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    <i class="bi bi-tag-fill mr-1"></i>
                                    {{ $p->categoryRelation->name }}
                                </span>
                            @endif
                            <span class="text-xs text-gray-500">
                                Added {{ $p->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Product Stats -->
                    <div class="flex-shrink-0 text-right">
                        <div class="flex items-center gap-3 text-xs text-gray-500">
                            <div class="flex items-center gap-1">
                                <i class="bi bi-eye text-blue-500"></i>
                                <span>{{ number_format($p->view_count ?? 0) }}</span>
                            </div>
                            @if($p->price)
                                <div class="text-sm font-semibold text-gray-900">
                                    ${{ number_format($p->price, 2) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Button -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.products.show', $p->id) }}" 
                           class="opacity-0 group-hover:opacity-100 transition-opacity text-gray-400 hover:text-blue-600">
                            <i class="bi bi-arrow-right text-lg"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-box-seam text-2xl text-gray-400"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">No products yet</h4>
                    <p class="text-sm text-gray-500 mb-6">Get started by adding your first product to the inventory.</p>
                    <a href="{{ route('admin.products.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="bi bi-plus-circle mr-2"></i>
                        Add Product
                    </a>
                </div>
            @endforelse
        </div>

        @if(count($latestProducts ?? []) > 0)
            <div class="mt-6 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.products.index') }}" 
                   class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                    View all products
                    <i class="bi bi-arrow-right ml-1"></i>
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Initialize OpenStreetMap
    const mapElement = document.getElementById('customerMap');
    if (mapElement) {
        // Initialize the map centered on the world
        const map = L.map('customerMap').setView([20, 0], 2);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        // Country coordinates for markers
        const countryCoordinates = {
            'United States': [39.8283, -98.5795],
            'USA': [39.8283, -98.5795],
            'France': [46.2276, 2.2137],
            'Germany': [51.1657, 10.4515],
            'United Kingdom': [55.3781, -3.4360],
            'UK': [55.3781, -3.4360],
            'Canada': [56.1304, -106.3468],
            'Australia': [-25.2744, 133.7751],
            'Japan': [36.2048, 138.2529],
            'China': [35.8617, 104.1954],
            'India': [20.5937, 78.9629],
            'Brazil': [-14.2350, -51.9253],
            'Russia': [61.5240, 105.3188],
            'South Africa': [-30.5595, 22.9375],
            'Mexico': [23.6345, -102.5528],
            'Italy': [41.8719, 12.5674],
            'Spain': [40.4637, -3.7492],
            'Netherlands': [52.1326, 5.2913],
            'Sweden': [60.1282, 18.6435],
            'Norway': [60.4720, 8.4689],
            'Tanzania': [-6.3690, 34.8888],
            'Kenya': [-0.0236, 37.9062],
            'Uganda': [1.3733, 32.2903],
            'Rwanda': [-1.9403, 29.8739],
            'Burundi': [-3.3731, 29.9189],
        };

        // Add markers for countries with customer data
        @if(isset($geoStats) && count($geoStats) > 0)
            @foreach($geoStats as $i => $g)
                @php
                    $country = $g['country'] ?? 'Unknown';
                    $count = $g['count'] ?? 0;
                    $percent = $g['percent'] ?? 0;
                @endphp

                @if(isset($countryCoordinates[$country]))
                    const coords{{ $i }} = {{ json_encode($countryCoordinates[$country]) }};
                    const marker{{ $i }} = L.marker(coords{{ $i }}).addTo(map);
                    marker{{ $i }}.bindPopup(`
                        <div class="text-center">
                            <div class="font-semibold text-lg">{{ $country }}</div>
                            <div class="text-sm text-gray-600">{{ number_format($count) }} Customers</div>
                            <div class="text-sm font-medium text-blue-600">{{ $percent }}%</div>
                        </div>
                    `);
                @endif
            @endforeach
        @endif

        // Disable zoom control for cleaner look (optional)
        map.zoomControl.setPosition('bottomright');
    }

    // Monthly Sales Bar
    const salesEl = document.getElementById('monthlySalesChart');
    if (salesEl) {
        const labels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        const data = [80, 230, 160, 210, 140, 120, 220, 150, 110, 260, 200, 90];
        new Chart(salesEl, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Sales',
                    data,
                    backgroundColor: '#4F46E5',
                    borderRadius: 3,
                    barPercentage: 0.7,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { precision: 0 } }
                }
            }
        });
    }



    // Recently Added Products are rendered server-side above
});
</script>
@endsection
