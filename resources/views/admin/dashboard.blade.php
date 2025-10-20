@extends('admin.layout')

@section('content')
<!-- Top KPIs -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- KPI: Total Views -->
    <div class="bg-white border rounded-xl p-6 flex items-start justify-between">
        <div>
            <div class="text-xs text-gray-500">Total Views</div>
            <div class="mt-1 text-3xl font-semibold">{{ number_format($stats['total_views'] ?? 0) }}</div>
        </div>
        <div class="text-gray-400"><i class="bi bi-eye-fill text-2xl"></i></div>
    </div>
    <!-- KPI: Contact Sales Clicks -->
    <div class="bg-white border rounded-xl p-6 flex items-start justify-between">
        <div>
            <div class="text-xs text-gray-500">Contact Sales Clicks</div>
            <div class="mt-1 text-3xl font-semibold">{{ number_format($stats['contact_sales'] ?? 0) }}</div>
        </div>
        <div class="text-gray-400"><i class="bi bi-telephone-fill text-2xl"></i></div>
    </div>
    <!-- KPI: Products In Stock -->
    <div class="bg-white border rounded-xl p-6 flex items-start justify-between">
        <div>
            <div class="text-xs text-gray-500">Products In Stock</div>
            <div class="mt-1 text-3xl font-semibold">{{ number_format($stats['products'] ?? 0) }}</div>
        </div>
        <div class="text-gray-400"><i class="bi bi-box-seam text-2xl"></i></div>
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
        <div id="customerMap" class="h-48 bg-gray-50 rounded border relative overflow-hidden"></div>

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
    <div class="card border-0">
        @forelse(($latestProducts ?? []) as $p)
            <div class="flex items-start gap-x-4 text-xs border p-2 border-gray-200 mb-3">
                <p>{{ $loop->iteration }}</p>
                <p class="">{{ $p->name }}</p>
            </div>
        @empty
            <tr>
                <td colspan="3" class="px-3 py-4 text-gray-500">No products added yet.</td>
            </tr>
        @endforelse
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
            'United States': [37.0902, -95.7129],
            'Singapore': [1.3521, 103.8198],
            'South Africa': [-30.5595, 22.9375],
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
