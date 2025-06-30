@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="w-full mx-auto py-8">
        <!-- Categories Bar -->
        <div class="flex justify-center space-x-8 mb-12">
            @foreach ($categories as $cat)
                <a href="{{ route('categories.show', $cat->id) }}" class="flex flex-col items-center group">
                    <div class="flex p-8 items-center justify-center rounded-lg border-2 {{ $cat->id == $category->id ? 'border-orange-500' : 'border-gray-200' }} group-hover:border-orange-500 transition-colors duration-300 mb-2">
                        @if ($cat->icon)
                            <img src="{{ asset('img/' . $cat->icon) }}" alt="{{ $cat->name }} icon" class="w-20 h-20">
                        @endif
                    </div>
                    <span class="text-sm font-medium text-gray-600 group-hover:text-orange-500 transition-colors duration-300">{{ $cat->name }}</span>
                </a>
            @endforeach
        </div>

        <!-- Category Header -->
        <div class="text-center relative mb-12">
            @if ($category->cover_image)
                <img src="{{ asset('img/' . $category->cover_image) }}" alt="{{ $category->name }} cover image" class="w-full h-[50vh] object-cover mt-4">
            @endif
            {{-- <div class="absolute z-20 inset-0 overlay bg-gradient-to-r from-black/80 to-transparent"></div>
            <div class="absolute z-30 inset-0 flex flex-col items-center justify-center text-white">
                <h1 class="text-4xl font-bold text-white mb-2">{{ $category->name }}</h1>
                <p class="text-lg text-white">{{ $category->description }}</p>
            </div> --}}
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach ($products as $product)
                <div class="bg-off-white rounded-2xl p-5 flex flex-col justify-between hover:shadow-lg transition duration-300 w-full max-w-sm mx-auto">
                    <div>
                        <p class="text-xs text-gray-400 font-medium mb-1">{{ $product->serial }}</p>
                        <h2 class="text-2xl font-semibold text-black leading-snug">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-500 mt-1">{{ $product->product_short }}</p>

                        <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-48 object-contain my-4">
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
