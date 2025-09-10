{{-- resources/views/pages/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About Us – DIGI Electronics')

@section('content')

    <!-- Hero -->
    <section class="relative bg-cover flex items-center bg-center h-[80vh] py-32"
             style="background-image:url('img/about-cover-2.jpg'); background-size: cover;">
        <div class="absolute inset-0 bg-black/70"></div>
        <div class="relative container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">About DIGI CTC Venture</h1>
            <p class="max-w-3xl mx-auto font-medium text-lg">Innovation &nbsp;|&nbsp; Quality &nbsp;|&nbsp; Service</p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl font-medium text-lg mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-bold mb-6">Our Story</h2>

            <p class="mb-2 text-gray-700">
                DIGI Electronics is part of the extended legacy of the CTC Group a privately‑owned conglomerate that
                has been driving progress in East Africa since 1956.
            </p>
            <p class="mb-2 text-gray-700">
                Like our parent, we are <span class="font-semibold">people‑centric</span> and
                <span class="font-semibold">future‑focused</span>, investing in partnerships, technology transfer,
                and human‑capital development to bring world‑class electronics and services to every household.
            </p>
            <p class="text-gray-700">
                What began as a family business has evolved into a trusted brand for televisions, refrigerators, and
                smart appliances, yet our entrepreneurial spirit remains as strong as day one.
            </p>
        </div>
    </section>

    <!-- Mission -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 md:px-8 flex flex-col md:flex-row items-center gap-8">

            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4">Our Mission</h2>

                <p class="text-gray-700 font-medium text-lg leading-relaxed">
                    “To build a sales organisation committed to providing quality products and services that deliver
                    customer satisfaction and help unleash economic potential in a sustainable and responsible
                    manner.”
                </p>
            </div>

            <div class="md:w-1/2">
                <img src="{{ asset('img/about-cover.png') }}" alt="Our Mission" class="rounded-lg shadow-lg">
            </div>

        </div>
    </section>

    <!-- Core Values -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-bold mb-10">Our Core Values</h2>

            @include('components.values')
        </div>
    </section>

    <!-- Experience -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 md:px-0">
            @include('components.experience')
        </div>
    </section>

    @include('sections.need-help')

    <!-- Call‑to‑Action -->
    <section class="py-20 bg-digi-orange text-white text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to experience the DIGI difference?</h2>
        <a href="{{ route('products.index') }}"
           class="inline-block px-8 py-4 bg-white text-digi-orange font-semibold rounded-full
                  hover:bg-gray-100 transition">
            Explore Our Products
        </a>
    </section>

@endsection
