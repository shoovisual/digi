<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class NewArrivalsController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // Get the 10 latest products ordered by created_at
        $newArrivals = Product::whereBetween('created_at', [
                    now()->subDays(30),
                    now()
                ])
                ->inRandomOrder()
                ->take(10)
                ->get();

        return view('shopping.new-arrivals', [
            'categories' => $categories,
            'newArrivals' => $newArrivals
        ]);
    }
}
