@extends('admin.layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Total Products</div>
        <div class="mt-1 text-2xl font-semibold">{{ $stats['products'] }}</div>
    </div>
    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Total Categories</div>
        <div class="mt-1 text-2xl font-semibold">{{ $stats['categories'] }}</div>
    </div>
    <div class="bg-white border rounded-lg p-4">
        <div class="text-sm text-gray-500">Welcome</div>
        <div class="mt-1 text-sm">Manage products, categories, and settings using the sidebar.</div>
    </div>
</div>

<div class="mt-6">
    <div class="bg-white border rounded-lg p-4 lg:col-span-2">
        <h3 class="text-lg font-semibold mb-2">Product Views (Last 14 days)</h3>
        <canvas id="viewsTrendChart" height="120"></canvas>
    </div>
    <div class="bg-white border rounded-lg p-4 mt-6">
        <h3 class="text-lg font-semibold mb-2">Latest Added Products</h3>
        @if($latestProducts->isEmpty())
            <div class="text-sm text-gray-500">No products found.</div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-nowrap">Product Serial</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Added</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($latestProducts as $p)
                            <tr>
                                <td class="px-3 py-2">
                                    <img src="{{ $p->image ? asset('img/'.$p->image) : asset('img/digi-logo.svg') }}" class="w-12 h-12 object-contain rounded" alt="{{ $p->name }}">
                                </td>
                                <td class="px-3 py-2">
                                    <div class="font-medium text-gray-800">{{ $p->name }}</div>
                                </td>
                                <td class="px-3 py-2 text-sm text-gray-700">{{ $p->serial ?? '—' }}</td>
                                <td class="px-3 py-2 text-sm text-gray-700">{{ optional($p->category)->name ?? 'Uncategorized' }}</td>
                                <td class="px-3 py-2 text-sm text-gray-700 text-nowrap">{{ $p->created_at?->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('viewsTrendChart');
    if (ctx) {
        const labels = {!! json_encode($trendLabels ?? []) !!};
        const data = {!! json_encode($trendData ?? []) !!};
        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Views',
                    data,
                    tension: 0.3,
                    borderColor: '#ff6b35',
                    backgroundColor: 'rgba(255, 107, 53, 0.15)',
                    pointRadius: 3,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { grid: { color: 'rgba(0,0,0,0.05)' }, beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });
    }
</script>
@endsection
