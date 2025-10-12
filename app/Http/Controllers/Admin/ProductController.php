<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categoryRelation')->orderBy('updated_at', 'desc')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'slug' => ['nullable','string','max:255'],
            'serial' => ['required','string','max:255','unique:products,serial'],
            'category_id' => ['required','exists:categories,id'],
            'description' => ['nullable','string'],
            'image' => ['nullable','string'],
            'image_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'product_images_files.*' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'product_galleries_files.*' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'product_galleries_captions' => ['nullable','array'],
            'product_galleries_captions.*' => ['nullable','string'],
            'features' => ['nullable','array'],
            'features.*' => ['nullable','string'],
            'spec_keys' => ['nullable','array'],
            'spec_keys.*' => ['nullable','string'],
            'spec_values' => ['nullable','array'],
            'spec_values.*' => ['nullable','string'],
            'manual_slug' => ['nullable'],
        ]);

        // Handle uploads
        $mainImagePath = $data['image'] ?? null;
        $productImages = [];
        $galleriesMap = [];

        \Illuminate\Support\Facades\File::ensureDirectoryExists(public_path('img/products/uploads'));

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time().'_'.\Illuminate\Support\Str::random(8).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('img/products/uploads'), $filename);
            $mainImagePath = 'products/uploads/'.$filename;
        }

        if ($request->hasFile('product_images_files')) {
            foreach ($request->file('product_images_files') as $pf) {
                if (!$pf) continue;
                $fname = time().'_'.\Illuminate\Support\Str::random(8).'.'.$pf->getClientOriginalExtension();
                $pf->move(public_path('img/products/uploads'), $fname);
                $productImages[] = 'products/uploads/'.$fname;
            }
        }

        $captions = $request->input('product_galleries_captions', []);

        if ($request->hasFile('product_galleries_files')) {
            $index = 0;
            foreach ($request->file('product_galleries_files') as $gf) {
                if (!$gf) { $index++; continue; }
                $gname = time().'_'.\Illuminate\Support\Str::random(8).'.'.$gf->getClientOriginalExtension();
                $gf->move(public_path('img/products/uploads'), $gname);
                $captionRaw = $captions[$index] ?? '';
                $caption = is_string($captionRaw) ? trim($captionRaw) : '';
                if ($caption === '') { $caption = 'Image '.($index+1); }
                $galleriesMap[$caption] = 'products/uploads/'.$gname;
                $index++;
            }
        }

        // Build features array
        $features = collect($request->input('features', []))
            ->map(fn($f) => is_string($f) ? trim($f) : $f)
            ->filter(fn($f) => !empty($f))
            ->values()
            ->all();

        // Build specifications associative array from key/value arrays
        $specKeys = $request->input('spec_keys', []);
        $specValues = $request->input('spec_values', []);
        $specs = [];
        foreach ($specKeys as $i => $key) {
            $key = is_string($key) ? trim($key) : $key;
            $val = $specValues[$i] ?? null;
            $val = is_string($val) ? trim($val) : $val;
            if (!empty($key) && $val !== null && $val !== '') {
                $specs[$key] = $val;
            }
        }

        // Determine final slug (auto or manual)
        $finalSlug = null;
        $manual = $request->boolean('manual_slug');
        $inputSlug = is_string($request->input('slug')) ? trim($request->input('slug')) : '';
        if ($manual && $inputSlug !== '') {
            $base = \Illuminate\Support\Str::slug($inputSlug);
        } else {
            $base = \Illuminate\Support\Str::slug($data['name']);
        }
        $slug = $base !== '' ? $base : \Illuminate\Support\Str::random(8);
        $i = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }
        $finalSlug = $slug;

        $product = Product::create([
            'name' => $data['name'],
            'slug' => $finalSlug,
            'serial' => $data['serial'],
            'category_id' => $data['category_id'],
            'description' => $data['description'] ?? null,
            'image' => $mainImagePath,
            'product_images' => count($productImages) ? $productImages : null,
            'product_galleries' => count($galleriesMap) ? $galleriesMap : null,
            'features' => count($features) ? $features : null,
            'specifications' => count($specs) ? $specs : null,
        ]);
        return redirect()->route('admin.products.index')->with('status','Product created');
    }

    public function show(Product $product)
    {
        $product->load('categoryRelation');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'slug' => ['nullable','string','max:255','unique:products,slug,'.$product->id],
            'serial' => ['required','string','max:255','unique:products,serial,'.$product->id],
            'category_id' => ['required','exists:categories,id'],
            'description' => ['nullable','string'],
            'image' => ['nullable','string'],
            'image_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'product_images_files.*' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'product_galleries_files.*' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'product_galleries_captions' => ['nullable','array'],
            'product_galleries_captions.*' => ['nullable','string'],
            'features' => ['nullable','array'],
            'features.*' => ['nullable','string'],
            'spec_keys' => ['nullable','array'],
            'spec_keys.*' => ['nullable','string'],
            'spec_values' => ['nullable','array'],
            'spec_values.*' => ['nullable','string'],
            'manual_slug' => ['nullable'],
        ]);

        // Handle uploads (replace sets if new files provided)
        \Illuminate\Support\Facades\File::ensureDirectoryExists(public_path('img/products/uploads'));

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time().'_'.\Illuminate\Support\Str::random(8).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('img/products/uploads'), $filename);
            $data['image'] = 'products/uploads/'.$filename;
        }

        // Existing product images (append new uploads)
        $existingImages = is_array($product->product_images)
            ? $product->product_images
            : (json_decode($product->product_images ?? '[]', true) ?: []);

        $newImages = [];
        if ($request->hasFile('product_images_files')) {
            foreach ($request->file('product_images_files') as $pf) {
                if (!$pf) continue;
                $fname = time().'_'.\Illuminate\Support\Str::random(8).'.'.$pf->getClientOriginalExtension();
                $pf->move(public_path('img/products/uploads'), $fname);
                $newImages[] = 'products/uploads/'.$fname;
            }
        }
        $data['product_images'] = array_merge($existingImages, $newImages);

        // Existing galleries (append new uploads)
        $existingGalleries = is_array($product->product_galleries)
            ? $product->product_galleries
            : (json_decode($product->product_galleries ?? '{}', true) ?: []);

        // New gallery uploads (append to remaining)
        if ($request->hasFile('product_galleries_files')) {
            $captions = $request->input('product_galleries_captions', []);
            $newGalleries = [];
            $index = 0;
            foreach ($request->file('product_galleries_files') as $gf) {
                if (!$gf) { $index++; continue; }
                $gname = time().'_'.\Illuminate\Support\Str::random(8).'.'.$gf->getClientOriginalExtension();
                $gf->move(public_path('img/products/uploads'), $gname);
                $captionRaw = $captions[$index] ?? '';
                $caption = is_string($captionRaw) ? trim($captionRaw) : '';
                if ($caption === '') { $caption = 'Image '.($index+1); }
                $newGalleries[$caption] = 'products/uploads/'.$gname;
                $index++;
            }
            $data['product_galleries'] = array_merge($existingGalleries, $newGalleries);
        } else {
            // No new uploads, keep existing galleries
            $data['product_galleries'] = $existingGalleries;
        }

        // Build features array
        $features = collect($request->input('features', []))
            ->map(fn($f) => is_string($f) ? trim($f) : $f)
            ->filter(fn($f) => !empty($f))
            ->values()
            ->all();

        // Build specifications associative array from key/value arrays
        $specKeys = $request->input('spec_keys', []);
        $specValues = $request->input('spec_values', []);
        $specs = [];
        foreach ($specKeys as $i => $key) {
            $key = is_string($key) ? trim($key) : $key;
            $val = $specValues[$i] ?? null;
            $val = is_string($val) ? trim($val) : $val;
            if (!empty($key) && $val !== null && $val !== '') {
                $specs[$key] = $val;
            }
        }

        // Compute slug: keep existing unless manual override provided
        $manual = $request->boolean('manual_slug');
        $finalSlug = $product->slug;
        if ($manual) {
            $inputSlug = is_string($request->input('slug')) ? trim($request->input('slug')) : '';
            $base = $inputSlug !== '' ? \Illuminate\Support\Str::slug($inputSlug) : \Illuminate\Support\Str::slug($data['name']);
            $slug = $base !== '' ? $base : \Illuminate\Support\Str::random(8);
            $i = 1;
            while (Product::where('slug', $slug)->where('id','!=',$product->id)->exists()) {
                $slug = $base.'-'.$i;
                $i++;
            }
            $finalSlug = $slug;
        }

        $product->update([
            'name' => $data['name'],
            'slug' => $finalSlug,
            'serial' => $data['serial'],
            'category_id' => $data['category_id'],
            'description' => $data['description'] ?? null,
            'image' => $data['image'] ?? $product->image,
            'product_images' => $data['product_images'] ?? $product->product_images,
            'product_galleries' => $data['product_galleries'] ?? $product->product_galleries,
            'features' => $features ?: $product->features,
            'specifications' => $specs ?: $product->specifications,
        ]);
        return redirect()->route('admin.products.index')->with('status','Product updated');
    }

    // AJAX: delete a single product image path from the set and unlink file
    public function deleteImage(Request $request, Product $product)
    {
        $path = $request->input('path');
        if (!is_string($path) || $path === '') {
            return response()->json(['success' => false, 'message' => 'Path is required'], 422);
        }

        $images = is_array($product->product_images)
            ? $product->product_images
            : (json_decode($product->product_images ?? '[]', true) ?: []);

        $updated = array_values(array_filter($images, fn($p) => $p !== $path));

        $fullPath = public_path('img/' . $path);
        if (file_exists($fullPath)) { @unlink($fullPath); }

        $product->update(['product_images' => $updated]);

        return response()->json(['success' => true]);
    }

    // AJAX: delete a gallery item by matching its path and unlink file
    public function deleteGallery(Request $request, Product $product)
    {
        $path = $request->input('path');
        if (!is_string($path) || $path === '') {
            return response()->json(['success' => false, 'message' => 'Path is required'], 422);
        }

        $galleries = is_array($product->product_galleries)
            ? $product->product_galleries
            : (json_decode($product->product_galleries ?? '{}', true) ?: []);

        foreach ($galleries as $caption => $p) {
            if ($p === $path) { unset($galleries[$caption]); break; }
        }

        $fullPath = public_path('img/' . $path);
        if (file_exists($fullPath)) { @unlink($fullPath); }

        $product->update(['product_galleries' => $galleries]);

        return response()->json(['success' => true]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('status','Product deleted');
    }
}
