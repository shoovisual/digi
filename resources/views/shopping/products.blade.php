@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="w-full bg-off-white py-3">
        @include('shopping.sections.product-categories')
    </div>
    <div class="w-full bg-[#F2F0EC]">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <!-- Banner Section -->
            <div class="relative rounded-xl overflow-hidden">
                <img src="{{ asset('img/tv-slider.jpg') }}" alt="TV Banner" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black to-transparent flex items-center">
                    <div class="text-white p-12">
                        <h2 class="text-4xl font-bold mb-4">Enjoy the Best in<br>Every Pixel</h2>
                        <p class="text-lg mb-6">With Our Frameless TV</p>
                        <a href="#" class="inline-block bg-orange-500 text-white px-8 py-3 rounded-full hover:bg-orange-600 transition-colors duration-300">View Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="buyModal" class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center">
        <div class="bg-white rounded-xl overflow-hidden w-full max-w-5xl mx-4 flex flex-col md:flex-row shadow-xl">
            <!-- Product Info -->
            <div class="w-full md:w-1/2 p-6 border-b md:border-b-0 md:border-r space-y-4">
            <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
            <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}" class="rounded" />
            <p class="text-md font-medium text-gray-600">*In-store and other retailers' prices will vary.</p>
            </div>

            <!-- Google Map + Store Info -->
            <div class="w-full md:w-1/2 p-6">
                <div id="map" class="h-64 w-full rounded mb-4"></div>
                <div id="storeList" class="text-sm border-b border-gray-200 text-gray-800"></div>
            </div>
        </div>
    </div>
    @include('sections.need-help')
@endsection

