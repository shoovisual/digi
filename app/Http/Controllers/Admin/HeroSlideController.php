<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('sort_order')->orderByDesc('id')->paginate(20);
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable','string','max:255'],
            'subtitle' => ['nullable','string','max:255'],
            'image' => ['nullable','string'],
            'mobile_image' => ['nullable','string'],
            'tablet_image' => ['nullable','string'],
            'image_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'mobile_image_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'tablet_image_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'primary_label' => ['nullable','string','max:255'],
            'primary_url' => ['nullable','string','max:255'],
            'secondary_label' => ['nullable','string','max:255'],
            'secondary_url' => ['nullable','string','max:255'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable','boolean'],
        ]);

        \Illuminate\Support\Facades\File::ensureDirectoryExists(public_path('img/hero/uploads'));

        $imagePath = $data['image'] ?? null;
        $mobileImagePath = $data['mobile_image'] ?? null;
        $tabletImagePath = $data['tablet_image'] ?? null;

        foreach ([
            'image_file' => 'image',
            'mobile_image_file' => 'mobile_image',
            'tablet_image_file' => 'tablet_image',
        ] as $fileKey => $fieldKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $filename = time().'_'.\Illuminate\Support\Str::random(8).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('img/hero/uploads'), $filename);
                ${$fieldKey.'Path'} = 'hero/uploads/'.$filename;
            }
        }

        $slide = HeroSlide::create([
            'title' => $data['title'] ?? null,
            'subtitle' => $data['subtitle'] ?? null,
            'image' => $imagePath,
            'mobile_image' => $mobileImagePath ?? $imagePath,
            'tablet_image' => $tabletImagePath ?? $imagePath,
            'primary_label' => $data['primary_label'] ?? null,
            'primary_url' => $data['primary_url'] ?? null,
            'secondary_label' => $data['secondary_label'] ?? null,
            'secondary_url' => $data['secondary_url'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => (bool)($data['is_active'] ?? true),
        ]);

        return redirect()->route('admin.hero-slides.index')->with('status', 'Hero slide created');
    }

    public function edit(HeroSlide $hero_slide)
    {
        return view('admin.hero-slides.edit', ['slide' => $hero_slide]);
    }

    public function update(Request $request, HeroSlide $hero_slide)
    {
        $data = $request->validate([
            'title' => ['nullable','string','max:255'],
            'subtitle' => ['nullable','string','max:255'],
            'image' => ['nullable','string'],
            'mobile_image' => ['nullable','string'],
            'tablet_image' => ['nullable','string'],
            'image_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'mobile_image_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'tablet_image_file' => ['nullable','image','mimes:jpg,jpeg,png,webp,avif','max:5120'],
            'primary_label' => ['nullable','string','max:255'],
            'primary_url' => ['nullable','string','max:255'],
            'secondary_label' => ['nullable','string','max:255'],
            'secondary_url' => ['nullable','string','max:255'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable','boolean'],
        ]);

        \Illuminate\Support\Facades\File::ensureDirectoryExists(public_path('img/hero/uploads'));

        $update = [
            'title' => $data['title'] ?? $hero_slide->title,
            'subtitle' => $data['subtitle'] ?? $hero_slide->subtitle,
            'image' => $data['image'] ?? $hero_slide->image,
            'mobile_image' => $data['mobile_image'] ?? $hero_slide->mobile_image,
            'tablet_image' => $data['tablet_image'] ?? $hero_slide->tablet_image,
            'primary_label' => $data['primary_label'] ?? $hero_slide->primary_label,
            'primary_url' => $data['primary_url'] ?? $hero_slide->primary_url,
            'secondary_label' => $data['secondary_label'] ?? $hero_slide->secondary_label,
            'secondary_url' => $data['secondary_url'] ?? $hero_slide->secondary_url,
            'sort_order' => $data['sort_order'] ?? $hero_slide->sort_order,
            'is_active' => (bool)($data['is_active'] ?? $hero_slide->is_active),
        ];

        foreach ([
            'image_file' => 'image',
            'mobile_image_file' => 'mobile_image',
            'tablet_image_file' => 'tablet_image',
        ] as $fileKey => $fieldKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $filename = time().'_'.\Illuminate\Support\Str::random(8).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('img/hero/uploads'), $filename);
                $update[$fieldKey] = 'hero/uploads/'.$filename;
            }
        }

        $hero_slide->update($update);
        return redirect()->route('admin.hero-slides.index')->with('status', 'Hero slide updated');
    }

    public function destroy(HeroSlide $hero_slide)
    {
        $hero_slide->delete();
        return redirect()->route('admin.hero-slides.index')->with('status', 'Hero slide deleted');
    }
}