<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductView;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate returning customers (customers who viewed products on different days)
        $returningCustomers = ProductView::selectRaw('ip_address, COUNT(DISTINCT DATE(created_at)) as visit_days')
            ->groupBy('ip_address')
            ->havingRaw('COUNT(DISTINCT DATE(created_at)) > 1')
            ->count();

        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'total_views' => (int) Product::sum('view_count'),
            'contact_sales' => (int) Product::sum('contact_sales_count'),
            'returning_customers' => $returningCustomers,
        ];

        // Build product view trend for the last 14 days
        $days = [];
        $trendLabels = [];
        $periodDays = 14;
        $start = now()->subDays($periodDays - 1)->startOfDay();

        for ($i = 0; $i < $periodDays; $i++) {
            $date = (clone $start)->addDays($i);
            $trendLabels[] = $date->format('M j');
            $days[$date->toDateString()] = 0;
        }

        $rows = ProductView::where('created_at', '>=', $start)
            ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
            ->groupBy('d')
            ->orderBy('d')
            ->get();

        foreach ($rows as $r) {
            $days[$r->d] = (int) $r->c;
        }
        $trendData = array_values($days);

        // Demographics by country (last 30 days)
        $geoStart = now()->subDays(29)->startOfDay();
        $geoRows = ProductView::where('created_at', '>=', $geoStart)
            ->whereNotNull('country_name')
            ->selectRaw('country_name, COUNT(*) as c')
            ->groupBy('country_name')
            ->orderByDesc('c')
            ->take(6)
            ->get();
        $geoTotal = (int) ProductView::where('created_at', '>=', $geoStart)->count();

        $geoStats = $geoRows->map(function ($row) use ($geoTotal) {
            $count = (int) $row->c;
            $pct = $geoTotal > 0 ? round(($count / $geoTotal) * 100) : 0;
            return [
                'country' => $row->country_name,
                'count' => $count,
                'percent' => $pct,
            ];
        });

        // Latest products
        $latestProducts = Product::with('categoryRelation')
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'trendLabels', 'trendData', 'latestProducts', 'geoStats'));
    }
}