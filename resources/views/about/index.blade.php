{{-- resources/views/pages/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About Us – DIGI Electronics')

@section('content')

    <!-- Hero -->
    <section class="relative bg-cover flex items-center bg-center h-[80vh] py-32"
             style="background-image:url('img/about-cover-2.jpg'); background-size: cover;">
        <div class="absolute inset-0 bg-black/70"></div>
        <div class="relative container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">About DIGI Electronics</h1>
            <p class="max-w-3xl mx-auto text-lg">Innovation &nbsp;|&nbsp; Quality &nbsp;|&nbsp; Service</p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-bold mb-6">Our Story</h2>

            <p class="mb-4 text-gray-700">
                DIGI Electronics is part of the extended legacy of the CTC Group—a privately‑owned conglomerate that
                has been driving progress in Sudan since 1956.
            </p>
            <p class="mb-4 text-gray-700">
                Like our parent, we are <span class="font-semibold">people‑centric</span> and
                <span class="font-semibold">future‑focused</span>, investing in partnerships, technology transfer,
                and human‑capital development to bring world‑class electronics and services to every household.
            </p>
            <p class="text-gray-700">
                What began as a family business has evolved into a trusted brand for televisions, refrigerators, and
                smart appliances—yet our entrepreneurial spirit remains as strong as day one.
            </p>
        </div>
    </section>

    <!-- Mission -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-8 flex flex-col md:flex-row items-center gap-8">

            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4">Our Mission</h2>

                <p class="text-gray-700 leading-relaxed">
                    “To build a sales organisation committed to providing quality products and services that deliver
                    customer satisfaction and help unleash economic potential in a sustainable and responsible
                    manner.”
                </p>
            </div>

            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1522596532682-5ec98b1fd1f7?auto=format&fit=crop&w=900&q=80"
                     alt="Our Mission" class="rounded-lg shadow-lg">
            </div>

        </div>
    </section>

    <!-- Core Values -->
    <section class="py-16">
        <div class="container mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-bold mb-10 text-center">Our Core Values</h2>

            <div class="grid md:grid-cols-3 gap-8">

                @php
                    $values = [
                        ['title' => 'Moving Forward',
                         'text'  => 'Leading markets where we operate and continuously growing.'],
                        ['title' => 'Employee Focus',
                         'text'  => 'Attracting, developing and retaining top talent through empowerment.'],
                        ['title' => 'Integrity',
                         'text'  => 'Conducting business with ethics, respect and meeting commitments.'],
                        ['title' => 'Teamwork',
                         'text'  => 'We accomplish more working together across the organisation.'],
                        ['title' => 'Value Consciousness & Quality',
                         'text'  => 'Optimising resources while adhering to international quality standards.'],
                        ['title' => 'Customer Focus',
                         'text'  => 'Being obsessed with understanding and exceeding customer needs.'],
                    ];
                @endphp

                @foreach ($values as $v)
                    <div class="p-6 bg-gray-100 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold mb-2">{{ $v['title'] }}</h3>
                        <p class="text-gray-700 text-sm">{{ $v['text'] }}</p>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Timeline -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-bold mb-10 text-center">A Timeline of Progress</h2>

            <ol class="relative border-l-4 border-digi-orange">

                @php
                    $timeline = [
                        ['year' => '1956',
                         'event' => 'Central Trading Company founded – our story begins.'],
                        ['year' => '2003',
                         'event' => 'Ventured into consumer electronics, laying the groundwork for DIGI.'],
                        ['year' => '2018',
                         'event' => 'Launch of state‑of‑the‑art service complex elevating after‑sales support.'],
                        ['year' => '2025',
                         'event' => 'DIGI Electronics expands regionally with smart‑connected appliances.'],
                    ];
                @endphp

                @foreach ($timeline as $item)
                    <li class="mb-10 ml-4">
                        <div class="absolute w-3 h-3 bg-digi-orange rounded-full -left-1.5 border-2 border-white"></div>
                        <time class="mb-1 text-sm font-medium text-digi-orange">{{ $item['year'] }}</time>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $item['event'] }}</h3>
                    </li>
                @endforeach

            </ol>
        </div>
    </section>

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
