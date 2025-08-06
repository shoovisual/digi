@extends('layouts.app')
@section('meta')
    <meta name="description" content="{{ $category->meta_description ?? 'Explore our range of ' . $category->name . ' products.' }}">
    <meta name="keywords" content="{{ $category->meta_keywords ?? 'Digi, Appliances, ' . $category->name }}">
    <meta property="og:description" content="{{ $category->meta_description ?? 'Explore our range of ' . $category->name . ' products.' }}">
    <meta property="og:image" content="{{ asset('img/' . ($category->cover_image ?? 'default-category.jpg')) }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta name="twitter:title" content="{{ $category->name }} | Digi Appliances">
    <meta name="twitter:description" content="{{ $category->meta_description ?? 'Explore our range of ' . $category->name . ' products.' }}">
    <meta name="twitter:image" content="{{ asset('img/' . ($category->cover_image ?? 'default-category.jpg')) }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection

@section('title', $category->name)

@section('content')
    <div class="w-full mx-auto">
        <!-- Categories Bar -->
        <div class="lg:flex grid md:grid-cols-5 grid-cols-2 justify-center lg:space-x-8 gap-y-4 py-5">
            @foreach ($categories as $cat)
                <a href="{{ route('categories.show', $cat->slug) }}" class="flex flex-col items-center group">
                    <div class="flex p-8 items-center justify-center rounded-lg border-2 {{ $cat->id == $category->id ? 'border-orange-500' : 'border-gray-200' }} group-hover:border-orange-500 transition-colors duration-300 mb-2">
                        @if ($cat->icon)
                            <img src="{{ asset('img/' . $cat->icon) }}" alt="{{ $cat->name }} icon" class="w-20 h-20">
                        @endif
                    </div>
                    <span class="text-sm font-medium text-gray-600 group-hover:text-orange-500 transition-colors duration-300">{{ $cat->name }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <div class="w-full bg-[#F2F0EC]">
        <div class="text-center relative max-w-7xl mx-auto py-5">
            @if ($category->cover_image)
                <img src="{{ asset('img/' . $category->cover_image) }}" alt="{{ $category->name }} cover image" class="w-full rounded-2xl h-[50vh] object-cover">
            @endif
        </div>
    </div>

    <div class="w-full bg-[#F2F0EC] mx-auto py-8">
        <div class="max-w-7xl mx-auto px-4 flex">
            <div class="products-container flex justify-center mx-auto">
                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 py-8">
            <!-- Category Header -->
            <div class="text-center relative">
                @if ($category->cover_image_2)
                    <img src="{{ asset('img/' . $category->cover_image_2) }}" alt="{{ $category->name }} cover image" class="w-full rounded-2xl h-[50vh] object-cover">
                @endif
            </div>
        </div>
    </div>
@include('sections.need-help')
@endsection
