<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\Promotion;

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

        // Find an active promotion for this product by date
        $now = now();
        $activePromotion = Promotion::query()
            ->whereHas('products', function ($q) use ($product) {
                $q->where('products.id', $product->id);
            })
            ->where('start_date', '<=', $now)
            ->where(function ($q) use ($now) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
            })
            ->orderBy('start_date', 'asc')
            ->first();

        return view('shopping.product', compact('product', 'relatedProducts', 'categories', 'activePromotion'));
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

    public function search(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return response()->json(['products' => []]);
        }
        
        $products = Product::with('categoryRelation')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('product_short', 'LIKE', '%' . $query . '%')
            ->orWhere('serial', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->orWhereHas('categoryRelation', function($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })
            ->select('id', 'name', 'slug', 'image', 'product_short', 'serial', 'category_id')
            ->limit(8)
            ->get();
            
        return response()->json(['products' => $products]);
    }
}
