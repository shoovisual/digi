<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categoryRelation')->get();
        $categories = Category::all();
        return view('shopping.products', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $relatedProducts = Product::with('categoryRelation')
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->take(3)
            ->get();

        return view('shopping.product', compact('product', 'relatedProducts'));
    }

    public function productsByCategory(Category $category)
    {
        $products = Product::with('categoryRelation')->where('category_id', $category->id)->get();
        $categories = Category::all();
        return view('shopping.category', compact('products', 'category', 'categories'));
    }
}
