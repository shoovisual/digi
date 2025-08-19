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
    <section class="py-16 max-w-7xl lg:mx-auto mx-4 rounded-2xl px-4 md:px-16 relative flex flex-col md:flex-row items-center" style="background-image:url('img/about-digi-featured.webp'); background-size: cover; background-position: center;">
        <div class="overlay absolute z-10 inset-0  bg-black/50 rounded-2xl"></div>
        <div class="text-white mb-12 text-lg font-medium vision z-20 w-full md:w-1/2">
            <h2 class="text-6xl font-normal mb-4">Our Vision for Africa & approach</h2>
            <p class="leading-relaxed">
                DIGI’s vision is to become the leading home appliance brand in Africa. Our goal is to offer smart, affordable solutions that enhance the daily lives of African families. We aim to be relevant to a variety of lifestyles and environments across the continent, addressing the specific needs of African households.
            </p>
        </div>
    </section>

    <!-- Vision -->
    <section class="py-16 max-w-7xl lg:mx-auto mt-6 rounded-2xl px-4 mx-3 md:px-16 relative flex flex-col md:flex-row items-center" style="background-image:url('img/about-slide-cover.png'); background-size: cover; background-position: center;">
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
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-bold mb-10">Our Core Values</h2>

            @include('components.values')
        </div>
    </section>

    <section class="py-16">
        <div class="md:max-w-7xl mx-auto px-2 md:px-8">
            <h2 class="text-3xl font-bold mb-10">Our Products</h2>
            @include('shopping.sections.product-categories')
        </div>
    </section>
    <!-- Timeline -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <h2 class="text-3xl font-bold mb-10">A Timeline of Progress</h2>

            <div class="relative grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

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
                    <div class="md:mb-5 mb-0 border border-digi-orange rounded-lg p-4">
                        <time class="mb-3 text-3xl font-medium text-digi-orange">{{ $item['year'] }}</time>
                        <h3 class="text-md font-medium text-gray-900">{{ $item['event'] }}</h3>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    @include('sections.need-help')

    @include('sections.about-cta')


@endsection
