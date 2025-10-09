@extends('layouts.app')

@section('meta')
    <meta name="description" content="Explore products in the {{ $promotion->name }} promotion.">
    <meta name="keywords" content="DIGI Promotion, {{ $promotion->name }}, appliances, electronics">
    <meta property="og:title" content="{{ $promotion->name }} Promotion">
    <meta property="og:description" content="Discover promoted products and special offers.">
    <meta property="og:image" content="{{ $promotion->cover ? asset('img/' . $promotion->cover) : asset('img/products/products-cover.webp') }}">
@endsection

@section('title', $promotion->name)

@section('content')
    <!-- Hero Cover Section -->
    <div class="w-full bg-[#F2F0EC]">
        <div class=" mx-auto">
            <div class="relative overflow-hidden">
                @php
                    $coverUrl = $promotion->cover ? asset('img/' . $promotion->cover) : asset('img/products/products-cover.webp');
                @endphp
                <img src="{{ $coverUrl }}" alt="{{ $promotion->name }} Cover" class="w-full h-[60vh] md:h-[75vh] object-cover">
                <div class="absolute  inset-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent flex items-end">
                    <div class="text-white p-6 md:p-10">
                        <h1 class="text-3xl md:text-5xl font-bold mb-3">{{ $promotion->name }}</h1>
                        <p class="text-lg md:text-xl">Hand-picked products for this campaign</p>
                        @if(!empty($promotion->description))
                            <p class="mt-3 max-w-3xl text-sm md:text-base opacity-90">{{ $promotion->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full bg-[#F2F0EC]">
        <!-- Products Grid -->
        <div class="max-w-7xl mx-auto px-4 py-8">
            @if($promotion->products->isEmpty())
                <div class="bg-white rounded-lg p-8 text-center shadow">
                    <h3 class="text-xl font-semibold mb-2">No products yet</h3>
                    <p class="text-gray-600">Please check back later for new items in this promotion.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach ($promotion->products as $product)
                        <div class="relative">
                            <div class="absolute top-2 right-4 z-10 bg-gradient-to-r from-orange-500 to-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                <i class="bi bi-megaphone-fill mr-1"></i>
                                Promoted
                            </div>
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
