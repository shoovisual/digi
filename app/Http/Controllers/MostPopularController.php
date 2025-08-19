<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class MostPopularController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // Get the most popular products ordered by view_count
        $mostPopular = Product::with('categoryRelation')
            ->where('view_count', '>', 0)
            ->orderBy('view_count', 'desc')
            ->take(20)
            ->get();

        return view('shopping.most-popular', [
            'categories' => $categories,
            'mostPopular' => $mostPopular
        ]);
    }
}
