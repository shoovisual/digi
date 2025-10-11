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
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'total_views' => (int) Product::sum('view_count'),
            'contact_sales' => (int) Product::sum('contact_sales_count'),
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

        // Latest products
        $latestProducts = Product::with('categoryRelation')
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'trendLabels', 'trendData', 'latestProducts'));
    }
}