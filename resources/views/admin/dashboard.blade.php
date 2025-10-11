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
        <canvas id="monthlySalesChart" height="120"></canvas>
    </div>
</div>

<!-- Statistics -->
<div class="mt-6 bg-white border rounded-xl p-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <button class="px-3 py-1 text-xs rounded bg-black text-white" id="tabOverview">Overview</button>
            <button class="px-3 py-1 text-xs rounded bg-gray-100 text-gray-700" id="tabSales">Sales</button>
            <button class="px-3 py-1 text-xs rounded bg-gray-100 text-gray-700" id="tabRevenue">Revenue</button>
        </div>
        <div class="flex items-center gap-2 text-xs bg-gray-100 px-3 py-1 rounded">
            <i class="bi bi-calendar"></i>
            Oct 5, 2025 – Oct 11, 2025
        </div>
    </div>
    <div class="mt-4">
        <canvas id="statsAreaChart" height="160"></canvas>
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
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-500"></span> USA</div>
                <div class="text-xs text-gray-500">2,379 Customers</div>
            </div>
            <div class="w-full h-2 bg-gray-100 rounded"><div class="h-2 bg-blue-500 rounded" style="width:79%"></div></div>

            <div class="flex items-center justify-between mt-3">
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-indigo-500"></span> France</div>
                <div class="text-xs text-gray-500">597 Customers</div>
            </div>
            <div class="w-full h-2 bg-gray-100 rounded"><div class="h-2 bg-indigo-500 rounded" style="width:23%"></div></div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="lg:col-span-2 bg-white border rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="text-sm font-semibold">Recent Orders</div>
            <div class="flex items-center gap-2">
                <button class="px-3 py-1 text-xs bg-gray-100 rounded">Filter</button>
                <button class="px-3 py-1 text-xs bg-gray-100 rounded">Save all</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 text-left">Product</th>
                        <th class="px-3 py-2 text-left">Category</th>
                        <th class="px-3 py-2 text-left">Price</th>
                        <th class="px-3 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody" class="divide-y divide-gray-100"></tbody>
            </table>
        </div>
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

    // Statistics Area
    const statsEl = document.getElementById('statsAreaChart');
    let statsChart;
    if (statsEl) {
        const months = ['Jul','Aug','Sep','Oct','Nov','Dec'];
        const baseData = {
            overview: [160, 190, 210, 200, 225, 215],
            sales:    [100, 120, 140, 150, 160, 170],
            revenue:  [80,  110, 120, 130, 140, 160],
        };
        const gradient = salesEl?.getContext('2d');
        const ctx = statsEl.getContext('2d');
        const grad = ctx.createLinearGradient(0,0,0,200);
        grad.addColorStop(0, 'rgba(79,70,229,0.25)');
        grad.addColorStop(1, 'rgba(79,70,229,0.05)');

        function buildChart(key) {
            if (statsChart) statsChart.destroy();
            statsChart = new Chart(statsEl, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        data: baseData[key],
                        tension: 0.35,
                        borderColor: '#4F46E5',
                        backgroundColor: grad,
                        fill: true,
                        pointRadius: 0,
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: false, grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { precision: 0 } }
                    }
                }
            });
        }
        buildChart('overview');
        document.getElementById('tabOverview')?.addEventListener('click', () => buildChart('overview'));
        document.getElementById('tabSales')?.addEventListener('click', () => buildChart('sales'));
        document.getElementById('tabRevenue')?.addEventListener('click', () => buildChart('revenue'));
    }

    // Recent Orders (sample data)
    const orders = [
        { name: 'Macbook pro 13"', category: 'Laptop', price: '$2399.00', status: 'Delivered' },
        { name: 'Apple Watch Ultra', category: 'Watch', price: '$879.00', status: 'Pending' },
        { name: 'iPhone 15 Pro Max', category: 'SmartPhone', price: '$1899.00', status: 'Delivered' },
        { name: 'iPad Pro 3rd Gen', category: 'Electronics', price: '$1699.00', status: 'Canceled' },
        { name: 'Airpods Pro 2nd Gen', category: 'Accessories', price: '$240.00', status: 'Delivered' },
    ];
    const tbody = document.getElementById('ordersTableBody');
    if (tbody) {
        orders.forEach(o => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="px-3 py-2">${o.name}</td>
                <td class="px-3 py-2">${o.category}</td>
                <td class="px-3 py-2">${o.price}</td>
                <td class="px-3 py-2">
                    <span class="px-2 py-1 text-xs rounded-full ${o.status === 'Delivered' ? 'bg-green-100 text-green-700' : o.status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-700'}">${o.status}</span>
                </td>`;
            tbody.appendChild(tr);
        });
    }
});
</script>
@endsection
