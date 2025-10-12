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

<!-- Monthly Sales -->
<div class="mt-6 bg-white border rounded-xl p-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="text-sm font-semibold">Monthly Sales</div>
        </div>
        <button class="text-gray-400"><i class="bi bi-three-dots"></i></button>
    </div>
    <div class="mt-4">
        <canvas id="monthlySalesChart" height="100"></canvas>
    </div>
</div>

<!-- Demographics + Recent Orders -->
<div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Customers Demographic -->
    <div class="lg:col-span-1 bg-white border rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="text-sm font-semibold">Customers Demographic</div>
            <button class="text-gray-400"><i class="bi bi-three-dots"></i></button>
        </div>
        <div class="h-48 bg-gray-100 rounded border flex items-center justify-center text-gray-400">World Map Placeholder</div>
        <div class="mt-6 space-y-3 text-sm">
            @php
                $colors = ['bg-blue-500','bg-indigo-500','bg-teal-500','bg-rose-500','bg-amber-500','bg-purple-500'];
            @endphp
            @if(isset($geoStats) && count($geoStats) > 0)
                @foreach($geoStats as $i => $g)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full {{ $colors[$i % count($colors)] }}"></span> {{ $g['country'] ?? 'Unknown' }}</div>
                        <div class="text-xs text-gray-500">{{ number_format($g['count']) }} Customers</div>
                    </div>
                    <div class="w-full h-2 bg-gray-100 rounded"><div class="h-2 {{ $colors[$i % count($colors)] }} rounded" style="width:{{ max(0, min(100, $g['percent'])) }}%"></div></div>
                @endforeach
            @else
                <div class="text-xs text-gray-500">No location data yet. Views will populate this chart.</div>
            @endif
        </div>
    </div>

    <!-- Recently Added Products -->
    <div class="lg:col-span-2">
        <x-datatable id="admin-recent-products"
            title="Recently Added Products"
            searchPlaceholder="Search products…"
            :addRoute="null"
            :export="false"
            :options="['ordering' => true]">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Added</th>
                </tr>
            </thead>
            <tbody>
                @forelse(($latestProducts ?? []) as $p)
                    <tr>
                        <td>{{ $p->name ?? ('Product #' . ($p->id ?? '')) }}</td>
                        <td>{{ $p->categoryRelation->name ?? '—' }}</td>
                        <td class="text-nowrap">{{ optional($p->created_at)->format('M d, Y') ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-3 py-4 text-gray-500">No products added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </x-datatable>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Removed gauge chart as per new KPI requirements

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
                    borderRadius: 6,
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
