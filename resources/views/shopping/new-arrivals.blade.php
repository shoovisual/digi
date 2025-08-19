@extends('layouts.app')

@section('meta')
    <meta name="description" content="Discover our latest products and new arrivals. Stay updated with the newest additions to our collection.">
    <meta name="keywords" content="New Arrivals, Latest Products, DIGI Products, Home Appliances, Electronics, New Collection">
    <meta property="og:title" content="New Arrivals">
    <meta property="og:description" content="Discover our latest products and new arrivals. Stay updated with the newest additions to our collection.">
    <meta property="og:image" content="{{ asset('img/products/products-cover.webp') }}">
@endsection

@section('title', 'New Arrivals')

@section('content')
<div class="w-full bg-[#F2F0EC]">
    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">New Arrivals</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Discover our latest products and stay ahead with the newest additions to our collection</p>
        </div>

        <!-- New Arrivals Badge -->
        <div class="flex justify-center mb-8">
            <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-full font-semibold text-lg shadow-lg">
                <i class="bi bi-star-fill mr-2"></i>
                Latest 10 Products
            </div>
        </div>

        @if($newArrivals->count() > 0)
            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach ($newArrivals as $product)
                    <div class="relative">
                        <!-- New Arrival Badge -->
                        <div class="absolute top-2 right-4 z-10 bg-gradient-to-r from-orange-500 to-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            <i class="bi bi-lightning-fill mr-1"></i>
                            New Arrival
                        </div>
                        <!-- Product Card -->
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>

            <!-- Call to Action -->
            <div class="text-center bg-white rounded-2xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Want to See More?</h3>
                <p class="text-gray-600 mb-6">Explore our complete product collection to find exactly what you're looking for.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full transition-colors duration-300 font-semibold">
                    <i class="bi bi-grid-3x3-gap mr-2"></i>
                    View All Products
                </a>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mb-6">
                    <i class="bi bi-box-seam text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-700 mb-4">No New Arrivals Yet</h3>
                <p class="text-gray-500 mb-8">We're working on bringing you exciting new products. Check back soon!</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full transition-colors duration-300">
                    Browse Existing Products
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
