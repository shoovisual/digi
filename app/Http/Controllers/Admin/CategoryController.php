<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:categories,name'],
            'slug' => ['nullable','string','max:255'],
            'icon' => ['nullable','string','max:255'],
            'description' => ['nullable','string'],
            'cover_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'manual_slug' => ['nullable'],
        ]);

        \Illuminate\Support\Facades\File::ensureDirectoryExists(public_path('img/categories/uploads'));

        $coverPath = null;
        if ($request->hasFile('cover_file')) {
            $file = $request->file('cover_file');
            $filename = time().'_'.\Illuminate\Support\Str::random(8).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('img/categories/uploads'), $filename);
            $coverPath = 'categories/uploads/'.$filename;
        }

        $manual = $request->boolean('manual_slug');
        $inputSlug = is_string($request->input('slug')) ? trim($request->input('slug')) : '';
        $base = $manual && $inputSlug !== ''
            ? \Illuminate\Support\Str::slug($inputSlug)
            : \Illuminate\Support\Str::slug($data['name']);
        $slug = $base !== '' ? $base : \Illuminate\Support\Str::random(8);
        $i = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        Category::create([
            'name' => $data['name'],
            'slug' => $slug,
            'icon' => $data['icon'] ?? null,
            'description' => $data['description'] ?? null,
            'cover_image' => $coverPath,
        ]);

        return redirect()->route('admin.categories.index')->with('status','Category created');
    }

    public function show(Category $category)
    {
        $products = Product::with('categoryRelation')
            ->where('category_id', $category->id)
            ->orderByDesc('created_at')
            ->get();
        return view('admin.categories.show', compact('category','products'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:categories,name,'.$category->id],
            'slug' => ['nullable','string','max:255','unique:categories,slug,'.$category->id],
            'icon' => ['nullable','string','max:255'],
            'description' => ['nullable','string'],
            'cover_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'manual_slug' => ['nullable'],
        ]);

        \Illuminate\Support\Facades\File::ensureDirectoryExists(public_path('img/categories/uploads'));
        $newCover = $category->cover_image;
        if ($request->hasFile('cover_file')) {
            $file = $request->file('cover_file');
            $filename = time().'_'.\Illuminate\Support\Str::random(8).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('img/categories/uploads'), $filename);
            $newCover = 'categories/uploads/'.$filename;
        }

        $manual = $request->boolean('manual_slug');
        $finalSlug = $category->slug;
        if ($manual) {
            $inputSlug = is_string($request->input('slug')) ? trim($request->input('slug')) : '';
            $base = $inputSlug !== '' ? \Illuminate\Support\Str::slug($inputSlug) : \Illuminate\Support\Str::slug($data['name']);
            $slug = $base !== '' ? $base : \Illuminate\Support\Str::random(8);
            $i = 1;
            while (Category::where('slug', $slug)->where('id','!=',$category->id)->exists()) {
                $slug = $base.'-'.$i;
                $i++;
            }
            $finalSlug = $slug;
        }

        $category->update([
            'name' => $data['name'],
            'slug' => $finalSlug,
            'icon' => $data['icon'] ?? $category->icon,
            'description' => $data['description'] ?? $category->description,
            'cover_image' => $newCover,
        ]);

        return redirect()->route('admin.categories.index')->with('status','Category updated');
    }

    public function destroy(Category $category)
    {
        $hasProducts = Product::where('category_id', $category->id)->exists();
        if ($hasProducts) {
            return redirect()->route('admin.categories.index')
                ->withErrors(['category' => 'Cannot delete category with existing products. Move or delete products first.']);
        }

        // Attempt to remove cover image file if exists
        if (!empty($category->cover_image)) {
            $fullPath = public_path('img/' . $category->cover_image);
            if (file_exists($fullPath)) { @unlink($fullPath); }
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('status','Category deleted');
    }
}