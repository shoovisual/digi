<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class RecentlyViewedController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        
        // Get product IDs from request (will be sent via JavaScript)
        $productIds = $request->input('product_ids', []);

        // If no product IDs provided, return empty collections
        if (empty($productIds)) {
            return view('shopping.recently-viewed', [
                'categories' => $categories,
                'todayProducts' => collect(),
                'thisWeekProducts' => collect(),
                'thisMonthProducts' => collect()
            ]);
        }

        // Get products by IDs
        $products = Product::whereIn('id', $productIds)->get();

        // Group products by time periods (this will be handled by JavaScript on frontend)
        // For now, we'll just pass all products and let JavaScript handle the grouping
        return view('shopping.recently-viewed', [
            'categories' => $categories,
            'products' => $products,
            'todayProducts' => collect(),
            'thisWeekProducts' => collect(),
            'thisMonthProducts' => collect()
        ]);
    }

    public function getProducts(Request $request)
    {
        $productIds = $request->input('product_ids', []);

        if (empty($productIds)) {
            return response()->json([
                'products' => []
            ]);
        }

        $products = Product::whereIn('id', $productIds)
            ->select('id', 'name', 'slug', 'image', 'price', 'created_at')
            ->get();

        return response()->json([
            'products' => $products
        ]);
    }
}
