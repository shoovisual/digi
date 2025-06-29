@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="breadcrumb p-5 bg-white border-b border-gray-200">
    <!-- Breadcrumb -->
    <nav class="text-sm font-medium text-gray-500" aria-label="Breadcrumb">
        <ol class="flex space-x-2">
            <li><a href="/" class="hover:underline hover:text-orange-500">Home</a></li>
            <li>/</li>
            <li><a href="/products" class="hover:underline hover:text-orange-500">Products</a></li>
            <li>/</li>
            <li class="text-gray-400">{{ $product->name }}</li>
        </ol>
    </nav>
</div>
<div class="container mx-auto px-4 py-8">
    <!-- Product Details Section -->
    <div class="flex flex-col md:flex-row gap-8 mb-16">
        <!-- Product Image -->
        <div class="md:w-1/2">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-[500px] object-contain p-8">
            </div>
        </div>

        <!-- Product Info -->
        <div class="md:w-1/2 pr-8">



    <!-- Product Title -->
    <h1 class="text-3xl sm:text-4xl font-bold text-black leading-snug mb-2">
        {{ $product->name }}
    </h1>

    <!-- SKU & Chat -->
    <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
        <div x-data="{ copyText: '{{ $product->serial }}', copied: false }" class="flex items-center gap-2">
            <span class="font-medium">{{ $product->serial }}</span>
            <!-- Copy Icon -->
            <svg @click="navigator.clipboard.writeText(copyText); copied = true; setTimeout(() => copied = false, 2000)"
                class="w-4 h-4 text-gray-400 cursor-pointer hover:text-gray-600 transition"
                fill="none" stroke="currentColor" stroke-width="1.5"
                viewBox="0 0 24 24">
                <title x-show="!copied">Copy</title>
                <title x-show="copied">Copied!</title>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" />
            </svg>

            <!-- Optional Feedback -->
            <span x-show="copied" class="text-green-500 text-xs font-medium">Copied!</span>
        </div>

        <a href="#" class="text-blue-600 font-medium hover:underline flex items-center gap-1">
            Chat with an expert
            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M18 10c0 3.866-3.582 7-8 7a8.22 8.22 0 01-3.946-1.011L2 17l1.302-3.717A7.763 7.763 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7z"/>
            </svg>
        </a>
    </div>

    <!-- Star Rating -->
    <div class="flex items-center gap-2 mb-4">
        <div class="flex text-gray-400">
            @for ($i = 1; $i <= 5; $i++)
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 15l-5.878 3.09 1.122-6.545L.489 6.91l6.561-.955L10 0l2.95 5.955 6.561.955-4.755 4.635 1.122 6.545z" />
                </svg>
            @endfor
        </div>
        <span class="text-sm text-gray-500">0 Reviews</span>
    </div>

    <!-- Share Thoughts Button -->
    <button class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded mb-5 font-medium">
        SHARE YOUR THOUGHTS!
    </button>

    <!-- Key Features -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Key Features</h2>

        @php
            $features = json_decode($product->features ?? '[]', true);
            $features = is_array($features) ? $features : [];
        @endphp

        @if(count($features) > 0)
            <div x-data="{ expanded: false }">

                <ul class="list-disc font-medium pl-6 text-gray-700 text-sm space-y-1">
                    @foreach($features as $index => $feature)
                        <li x-show="expanded || {{ $index }} < 3" x-cloak>{{ $feature }}</li>
                    @endforeach
                </ul>

                @if(count($features) > 3)
                    <button @click="expanded = !expanded" type="button"
                        class="text-sm text-black mt-2 cursor-pointer inline-flex items-center hover:underline font-medium focus:outline-none">
                        <span x-show="!expanded">View More</span>
                        <span x-show="expanded">View Less</span>
                        <svg class="w-4 h-4 ml-1 transform transition-transform duration-200"
                            :class="{ '-rotate-90': expanded }" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                        </svg>
                    </button>
                @endif

            </div>
        @else
            <p class="text-gray-500 text-sm">No features available</p>
        @endif

    </div>

    <div class="buttons">
        <button class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-6 py-3 rounded-full font-medium transition-colors duration-300">
            contact Sales
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm px-6 py-3 rounded-full font-medium transition-colors duration-300">
            Where to Buy
        </button>
    </div>

</div>

    </div>

    <!-- Related Products Section -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($relatedProducts as $relatedProduct)
                <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ asset('img/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="w-full h-64 object-contain p-4">
                    <div class="p-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ $relatedProduct->name }}</h3>
                        <p class="text-sm text-gray-500 mb-4">{{ $relatedProduct->categoryRelation->name }}</p>
                        <a href="{{ route('products.show', $relatedProduct->id) }}" class="text-sm text-gray-600 hover:text-orange-500 transition-colors duration-300">View Product</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
