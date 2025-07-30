@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="w-full bg-off-white py-3">
        @include('shopping.sections.product-categories')
    </div>
    <div class="w-full bg-[#F2F0EC]">
        <div class="max-w-7xl mx-auto px-4 py-8">

            <!-- Banner Section -->
            <div class="relative rounded-xl mb-6 overflow-hidden">
                <img src="{{ asset('img/products/products-cover-2.webp') }}" alt="Fridge Banner" class="w-full h-100 object-cover" style="background-image: url('{{ asset('img/products/products-cover.webp') }}'); background-size: cover; ">
                <div class="absolute inset-0 bg-gradient-to-r2 from-white to-transparent flex items-center">
                    <div class="text-black p-12">
                        <h2 class="text-4xl font-bold mb-4">Enjoy the Best in<br>Every Pixel</h2>
                        <p class="text-lg mb-6">With Our Frameless TV</p>
                        <a href="#" class="inline-block bg-orange-500 text-white px-8 py-3 rounded-full hover:bg-orange-600 transition-colors duration-300">View Product</a>
                    </div>
                </div>
            </div>

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
    @include('sections.need-help')
@endsection

