@extends('layouts.app')

@section('title', 'Most Popular Products')
@section('meta_description', 'Discover the most popular products based on customer views and engagement.')
@section('meta_keywords', 'popular products, trending, most viewed, customer favorites')

@section('content')
<div class="bg-[#F2F0EC] w-full mx-auto px-4 py-8">
    <div class="md:max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Most Popular Products</h1>
            <p class="text-gray-600">Discover what our customers love most</p>
            <div class="inline-block bg-red-500 text-white px-4 py-2 rounded-full text-sm font-medium mt-4">
                <i class="bi bi-fire mr-2"></i>
                Trending Now
            </div>
        </div>

        @if($mostPopular->count() > 0)
            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach($mostPopular as $index => $product)
                    <div class="bg-white rounded-lg group hover:shadow-md overflow-hidden cursor-pointer transition-shadow duration-300 relative">
                        <!-- Popularity Rank Badge -->
                        @if($index < 3)
                            <div class="absolute top-3 left-3 z-10">
                                @if($index === 0)
                                    <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                        <i class="bi bi-trophy-fill mr-1"></i>#1
                                    </span>
                                @elseif($index === 1)
                                    <span class="bg-gray-400 text-white px-2 py-1 rounded-full text-xs font-bold">
                                        <i class="bi bi-award-fill mr-1"></i>#2
                                    </span>
                                @else
                                    <span class="bg-orange-600 text-white px-2 py-1 rounded-full text-xs font-bold">
                                        <i class="bi bi-award-fill mr-1"></i>#3
                                    </span>
                                @endif
                            </div>
                        @endif

                        <!-- Hot Badge -->
                        @if($product->view_count > 100)
                            <div class="absolute top-3 right-3 z-10">
                                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold animate-pulse">
                                    <i class="bi bi-fire mr-1"></i>HOT
                                </span>
                            </div>
                        @endif

                        <a href="{{ route('products.show', $product->slug) }}" class="block">
                            <div class="aspect-1">
                                <img src="{{ $product->image ? asset('img/' . $product->image) : asset('img/products/default.jpg') }}"
                                     alt="{{ $product->name }}"
                                     class="w-full p-5 group-hover:p-3 transition-all duration-300 object-cover">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>

                                <!-- View Count Display -->
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-orange-600 font-medium text-sm flex items-center">
                                        <i class="bi bi-eye-fill mr-1"></i>
                                        {{ number_format($product->view_count) }} views
                                    </span>
                                    @if($product->price)
                                        <span class="text-gray-900 font-bold">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>

                                <!-- Category -->
                                @if($product->categoryRelation)
                                    <span class="inline-block bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs mb-3">
                                        {{ $product->categoryRelation->name }}
                                    </span>
                                @endif

                                <div class="flex space-x-2">
                                    <span class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-center py-2 px-4 rounded-full transition-colors text-sm">
                                        View Product
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- View Count Statistics -->
            {{-- <div class="bg-white rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Popularity Statistics</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-orange-600">{{ number_format($mostPopular->sum('view_count')) }}</div>
                        <div class="text-gray-600 text-sm">Total Views</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-orange-600">{{ $mostPopular->count() }}</div>
                        <div class="text-gray-600 text-sm">Popular Products</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-orange-600">{{ number_format($mostPopular->avg('view_count'), 0) }}</div>
                        <div class="text-gray-600 text-sm">Average Views</div>
                    </div>
                </div>
            </div> --}}
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="mb-4">
                    <i class="bi bi-graph-up text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Popular Products Yet</h3>
                <p class="text-gray-500 mb-6">Products will appear here as customers start viewing them</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition-colors">
                    Browse All Products
                </a>
            </div>
        @endif
    </div>
</div>

@include('sections.need-help')
@endsection
