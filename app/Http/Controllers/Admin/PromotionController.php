<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PromotionController extends Controller
{
    /**
     * Display a listing of the promotions.
     */
    public function index(Request $request): View
    {
        $promotions = Promotion::query()
            ->withCount('products')
            ->withSum('products as views_sum', 'view_count')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new promotion.
     */
    public function create(): View
    {
        $products = Product::query()
            ->with('category')
            ->orderByDesc('updated_at')
            ->get();
        return view('admin.promotions.create', compact('products'));
    }

    /**
     * Store a newly created promotion in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'products' => ['nullable', 'array'],
            'products.*' => ['integer', 'exists:products,id'],
            'cover_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'slug' => ['nullable','string','max:255'],
            'manual_slug' => ['nullable'],
        ]);

        // Prevent overlapping campaigns
        $start = \Carbon\Carbon::parse($data['start_date'])->startOfDay();
        $end = \Carbon\Carbon::parse($data['end_date'])->endOfDay();
        $overlapExists = Promotion::where(function ($q) use ($start, $end) {
                $q->where('start_date', '<=', $end)
                  ->where('end_date', '>=', $start);
            })->exists();
        if ($overlapExists) {
            return back()
                ->withErrors(['start_date' => 'Campaign dates overlap an existing campaign', 'end_date' => 'Choose a non-overlapping date range'])
                ->withInput();
        }

        \Illuminate\Support\Facades\File::ensureDirectoryExists(public_path('img/promotions/uploads'));
        $coverPath = null;
        if ($request->hasFile('cover_file')) {
            $file = $request->file('cover_file');
            $filename = time().'_'.\Illuminate\Support\Str::random(8).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('img/promotions/uploads'), $filename);
            $coverPath = 'promotions/uploads/'.$filename;
        }

        // Determine final slug (auto or manual)
        $manual = $request->boolean('manual_slug');
        $inputSlug = is_string($request->input('slug')) ? trim($request->input('slug')) : '';
        $baseSlug = $manual && $inputSlug !== ''
            ? \Illuminate\Support\Str::slug($inputSlug)
            : \Illuminate\Support\Str::slug($data['name']);
        $slug = $baseSlug !== '' ? $baseSlug : \Illuminate\Support\Str::random(8);
        $i = 1;
        while (Promotion::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$i;
            $i++;
        }

        $promotion = Promotion::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'slug' => $slug,
            'cover' => $coverPath,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'status' => 'active',
            'user_id' => Auth::id(),
        ]);

        $promotion->products()->sync($data['products'] ?? []);

        return redirect()->route('admin.promotions.index')
            ->with('status', 'Promotion created successfully');
    }

    /**
     * Show the promotion details.
     */
    public function show(Promotion $promotion): View
    {
        $promotion->load('products.category');

        $productIds = $promotion->products->pluck('id');

        $totalViews = \App\Models\Product::whereIn('id', $productIds)->sum('view_count');
        $productsCount = $promotion->products->count();
        $avgViews = $productsCount > 0 ? (int) floor($totalViews / $productsCount) : 0;
        $topProduct = \App\Models\Product::whereIn('id', $productIds)
            ->orderByDesc('view_count')
            ->first();

        $periodDays = 14;
        $trendLabels = [];
        $days = [];
        $start = now()->subDays($periodDays - 1)->startOfDay();
        for ($i = 0; $i < $periodDays; $i++) {
            $date = (clone $start)->addDays($i);
            $trendLabels[] = $date->format('M j');
            $days[$date->toDateString()] = 0;
        }

        if ($productIds->isNotEmpty()) {
            $rows = \App\Models\ProductView::where('created_at', '>=', $start)
                ->whereIn('product_id', $productIds)
                ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
                ->groupBy('d')
                ->orderBy('d')
                ->get();

            foreach ($rows as $r) {
                $days[$r->d] = (int) $r->c;
            }
        }
        $trendData = array_values($days);

        $stats = [
            'products_count' => $productsCount,
            'total_views' => (int) $totalViews,
            'avg_views' => (int) $avgViews,
        ];

        return view('admin.promotions.show', compact('promotion', 'stats', 'trendLabels', 'trendData', 'topProduct'));
    }

    /**
     * Show the form for editing a promotion.
     */
    public function edit(Promotion $promotion): View
    {
        $promotion->load('products');
        $products = Product::query()
            ->with('category')
            ->orderByDesc('updated_at')
            ->get();
        return view('admin.promotions.edit', compact('promotion', 'products'));
    }

    /**
     * Remove the specified promotion from storage.
     */
    public function destroy(Promotion $promotion): RedirectResponse
    {
        $promotion->delete();
        return redirect()->route('admin.promotions.index')
            ->with('status', 'Promotion deleted successfully');
    }

    /**
     * Update the specified promotion in storage.
     */
    public function update(Request $request, Promotion $promotion): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'products' => ['nullable', 'array'],
            'products.*' => ['integer', 'exists:products,id'],
            'cover_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'slug' => ['nullable','string','max:255','unique:promotions,slug,'.$promotion->id],
            'manual_slug' => ['nullable'],
        ]);

        // Prevent overlapping campaigns (exclude current promotion)
        $start = \Carbon\Carbon::parse($data['start_date'])->startOfDay();
        $end = \Carbon\Carbon::parse($data['end_date'])->endOfDay();
        $overlapExists = Promotion::where('id', '!=', $promotion->id)
            ->where(function ($q) use ($start, $end) {
                $q->where('start_date', '<=', $end)
                  ->where('end_date', '>=', $start);
            })->exists();
        if ($overlapExists) {
            return back()
                ->withErrors(['start_date' => 'Campaign dates overlap an existing campaign', 'end_date' => 'Choose a non-overlapping date range'])
                ->withInput();
        }

        \Illuminate\Support\Facades\File::ensureDirectoryExists(public_path('img/promotions/uploads'));
        $newCover = $promotion->cover;
        if ($request->hasFile('cover_file')) {
            $file = $request->file('cover_file');
            $filename = time().'_'.\Illuminate\Support\Str::random(8).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('img/promotions/uploads'), $filename);
            $newCover = 'promotions/uploads/'.$filename;
        }

        // Compute slug: keep existing unless manual override provided
        $manual = $request->boolean('manual_slug');
        $finalSlug = $promotion->slug;
        if ($manual) {
            $inputSlug = is_string($request->input('slug')) ? trim($request->input('slug')) : '';
            $base = $inputSlug !== '' ? \Illuminate\Support\Str::slug($inputSlug) : \Illuminate\Support\Str::slug($data['name']);
            $slug = $base !== '' ? $base : \Illuminate\Support\Str::random(8);
            $i = 1;
            while (Promotion::where('slug', $slug)->where('id','!=',$promotion->id)->exists()) {
                $slug = $base.'-'.$i;
                $i++;
            }
            $finalSlug = $slug;
        }

        $promotion->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'slug' => $finalSlug,
            'cover' => $newCover,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
        ]);

        $promotion->products()->sync($data['products'] ?? []);

        return redirect()->route('admin.promotions.index')
            ->with('status', 'Promotion updated successfully');
    }
}