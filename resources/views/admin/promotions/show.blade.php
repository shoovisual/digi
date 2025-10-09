@extends('admin.layout')

@section('content')
<div class="bg-white border rounded-lg p-6">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
            <img src="{{ $promotion->cover ? asset('img/'.$promotion->cover) : asset('img/digi-logo.svg') }}" alt="{{ $promotion->name }}" class="w-16 h-16 object-cover rounded border" />
            <h2 class="text-xl font-semibold">Promotion: {{ $promotion->name }}</h2>
        </div>
        <a href="{{ route('admin.promotions.index') }}" class="text-blue-600">Back to list</a>
    </div>
    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <dt class="text-sm text-gray-500">Name</dt>
            <dd class="text-sm text-gray-900">{{ $promotion->name }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Status</dt>
            <dd class="text-sm text-gray-900">{{ $promotion->status_label }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Start Date</dt>
            <dd class="text-sm text-gray-900">{{ optional($promotion->start_date)->format('Y-m-d') ?? '—' }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">End Date</dt>
            <dd class="text-sm text-gray-900">{{ optional($promotion->end_date)->format('Y-m-d') ?? '—' }}</dd>
        </div>
    </dl>

    <h3 class="text-lg font-semibold mt-6 mb-2">Mini Dashboard</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gray-50 border rounded p-4">
            <div class="text-xs text-gray-500">Products</div>
            <div class="mt-1 text-xl font-semibold">{{ $stats['products_count'] ?? $promotion->products->count() }}</div>
        </div>
        <div class="bg-gray-50 border rounded p-4">
            <div class="text-xs text-gray-500">Total Views</div>
            <div class="mt-1 text-xl font-semibold">{{ $stats['total_views'] ?? 0 }}</div>
        </div>
        <div class="bg-gray-50 border rounded p-4">
            <div class="text-xs text-gray-500">Avg Views / Product</div>
            <div class="mt-1 text-xl font-semibold">{{ $stats['avg_views'] ?? 0 }}</div>
        </div>
        <div class="bg-gray-50 border rounded p-4">
            <div class="text-xs text-gray-500">Top Product</div>
            @if(isset($topProduct) && $topProduct)
                <div class="mt-1 text-sm font-medium text-gray-800">{{ $topProduct->name }}</div>
                <div class="text-xs text-gray-500">Views: {{ $topProduct->view_count }}</div>
            @else
                <div class="mt-1 text-sm text-gray-500">—</div>
            @endif
        </div>
    </div>

    <div class="mt-6 bg-gray-50 border rounded p-4">
        <h3 class="text-lg font-semibold mb-2">Views Trend (Last 14 days)</h3>
        <canvas id="promoViewsTrendChart" height="120"></canvas>
    </div>

    <h3 class="text-lg font-semibold mt-6 mb-2">Products</h3>
    @if($promotion->products->isEmpty())
        <p class="text-gray-600">No products linked to this promotion.</p>
    @else
        <ul class="list-disc pl-6 text-sm">
            @foreach($promotion->products as $product)
                <li>{{ $product->name }} @if($product->category) <span class="text-gray-500">({{ $product->category->name }})</span> @endif</li>
            @endforeach
        </ul>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        const promoCtx = document.getElementById('promoViewsTrendChart');
        if (promoCtx) {
            const labels = {!! json_encode($trendLabels ?? []) !!};
            const data = {!! json_encode($trendData ?? []) !!};
            new Chart(promoCtx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Views',
                        data,
                        tension: 0.3,
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.15)',
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
</div>
@endsection