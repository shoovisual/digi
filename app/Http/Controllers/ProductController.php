<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductView;

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
        $product = Product::where('slug', $product->slug)->with('categoryRelation')->firstOrFail();
        $categories = Category::all();
        $relatedProducts = Product::with('categoryRelation')
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->take(5)
            ->get();

        return view('shopping.product', compact('product', 'relatedProducts', 'categories'));
    }

    public function productsByCategory(Category $category)
    {
        if ($category->slug === 'products' || $category->slug === 'all-products') {
            $products = Product::with('categoryRelation')->get();
            $categories = Category::all();
            // Use the same template as the products index page for 'all-products'
            if ($category->slug === 'all-products') {
                return view('shopping.products', compact('products', 'categories'));
            }
        } else {
            $products = Product::with('categoryRelation')->where('category_id', $category->id)->get();
        }
        $categories = Category::all();
        return view('shopping.category', compact('products', 'category', 'categories'));
    }

    public function getCategories()
    {
        $categories = Category::select('id', 'name', 'slug')
            ->get();

        return response()->json($categories);
    }

    public function getProductsByCategory($categoryId)
    {
        $products = Product::where('category_id', $categoryId)
            ->select('id', 'name', 'product_short', 'serial')
            ->get();

        return response()->json($products);
    }

    public function incrementViewCount(Request $request)
    {
        $productId = $request->input('product_id');
        $ipAddress = $request->ip();

        if ($productId) {
            // Check if this IP has already viewed this product
            $existingView = ProductView::where('product_id', $productId)
                ->where('ip_address', $ipAddress)
                ->first();

            // Only increment if this is a new view from this IP
            if (!$existingView) {
                // Create a new view record
                ProductView::create([
                    'product_id' => $productId,
                    'ip_address' => $ipAddress
                ]);

                // Increment the product's view count
                Product::where('id', $productId)->increment('view_count');

                return response()->json(['success' => true, 'new_view' => true]);
            }

            return response()->json(['success' => true, 'new_view' => false]);
        }

        return response()->json(['success' => false], 400);
    }
}
