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
        $products = Product::take(5)->get();
        
        return view('home', compact('categories', 'products'));
    }
    public function feedback()
    {
        $categories = Category::all();
        return view('feedback', compact('categories'));
    }
    public function privacy()
    {
        $categories = Category::all();
        return view('legal.privacy-policy', compact('categories'));
    }
    public function terms()
    {
        $categories = Category::all();
        return view('legal.terms-conditions', compact('categories'));
    }
    public function returns()
    {
        $categories = Category::all();
        return view('legal.return-policy', compact('categories'));
    }
}
