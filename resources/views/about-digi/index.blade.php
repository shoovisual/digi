{{-- resources/views/pages/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About Us – DIGI Electronics')

@section('content')

    <!-- Hero -->
    <section class="relative bg-cover flex items-center bg-center h-[80vh] py-32" style="background-image:url('img/about-digi-cover.jpg'); background-size: cover;">
        <div class="absolute inset-0 bg-black/70"></div>
        <div class="relative container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">About DIGI Electronics</h1>
            <p class="max-w-3xl mx-auto font-medium text-lg">Innovation &nbsp;|&nbsp; Quality &nbsp;|&nbsp; Service</p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto font-medium text-lg px-4 md:px-8">
            <h2 class="text-3xl font-bold mb-6">About DIGI</h2>

            <p class="mb-4 text-gray-700">
                DIGI is a home appliance brand committed to delivering high-quality, affordable, and reliable products that meet the needs of African households. We source products from trusted manufacturers worldwide, including China, Turkey, and other reputable regions. DIGI focuses on offering modern, durable, and functional appliances tailored to the unique needs of Africa.
            </p>
        </div>
    </section>

    <!-- Vision -->
    <section class="py-16 max-w-7xl mx-auto rounded-2xl px-4 md:px-16 relative flex flex-col md:flex-row items-center" style="background-image:url('img/about-digi-featured.webp'); background-size: cover; background-position: center;">
        <div class="overlay absolute z-10 inset-0  bg-black/50 rounded-2xl"></div>
        <div class="text-white mb-12 text-lg font-medium vision z-20 w-full md:w-1/2">
            <h2 class="text-6xl font-normal mb-4">Our Vision for Africa & approach</h2>
            <p class="leading-relaxed">
                DIGI’s vision is to become the leading home appliance brand in Africa. Our goal is to offer smart, affordable solutions that enhance the daily lives of African families. We aim to be relevant to a variety of lifestyles and environments across the continent, addressing the specific needs of African households.
            </p>
        </div>
    </section>

    <!-- Vision -->
    <section class="py-16 max-w-7xl mx-auto mt-6 rounded-2xl px-4 md:px-16 relative flex flex-col md:flex-row items-center" style="background-image:url('img/about-digi-featured.webp'); background-size: cover; background-position: center;">
        <div class="overlay absolute z-10 inset-0  bg-black/50 rounded-2xl"></div>
        <div class="text-white mb-12 text-lg font-medium vision z-20 w-full md:w-1/2">
            <h2 class="text-6xl font-normal mb-4">Summary & Commitment</h2>
            <p class="leading-relaxed">
                DIGI’s expansion across Africa will be driven by these brand guidelines, ensuring that every product, campaign, and partnership reflects the brand's core essence: empowering African homes with smart, reliable, and affordable appliances. By staying true to these values, we aim to build a brand that feels local wherever it goes.
            </p>
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
