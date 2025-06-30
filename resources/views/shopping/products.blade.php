@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">

        @include('shopping.sections.product-categories')

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach ($products as $product)
                <div class="bg-off-white rounded-2xl p-5 flex flex-col justify-between cursor-pointer group transition duration-300 w-full max-w-sm mx-auto">
                    <div class="font-medium">
                        <div x-data="{ copyText: '{{ $product->serial }}', copied: false }" class="flex items-center gap-2">
                            <span class="text-md text-gray-400 font-medium">{{ $product->serial }}</span>
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
                        <h2 class="text-2xl font-semibold text-black leading-snug">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-500 mt-1">{{ $product->product_short }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="text-sm text-blue-600 hover:underline">
                            <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full group-hover:scale-105 h-48 object-contain my-4 transition-transform duration-300">
                        </a>
                    </div>

                    <!-- Rating and Actions -->
                    <div class="flex flex-col space-y-3">
                        <div class="flex items-center gap-2">
                            <!-- Stars -->
                            <div class="flex text-orange-400 text-sm">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= 4) <!-- Replace 4 with dynamic rating if available -->
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                            <path d="M12 .587l3.668 7.568L24 9.75l-6 5.823L19.335 24 12 19.897 4.665 24 6 15.573 0 9.75l8.332-1.595z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 .587l3.668 7.568L24 9.75l-6 5.823L19.335 24 12 19.897 4.665 24 6 15.573 0 9.75l8.332-1.595z"/>
                                        </svg>
                                    @endif
                                @endfor
                            </div>

                            <!-- Ratings Count -->
                            <span class="text-sm text-blue-600 hover:underline cursor-pointer">43 Ratings</span>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-start font-medium gap-4 mt-1">
                            <a href="{{ route('products.show', $product->id) }}" class="px-4 py-2 border border-gray-300 rounded-full text-sm text-black hover:bg-gray-100">
                                View Product
                            </a>
                            <a href="#" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full text-sm">
                                Where to Buy
                            </a>
                            <button class="text-gray-500 text-2xl hover:text-orange-500">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>

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
@endsection
