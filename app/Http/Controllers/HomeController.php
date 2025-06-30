<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {



        $categories = Category::all();
        $products = Product::take(5)->get(); // Fetch 5 products
        return view('home', compact('products', 'categories'));
    }
}
