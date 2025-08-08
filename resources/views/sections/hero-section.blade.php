@php
/* ---------------------------------------------------------------
 | Slider data
 |---------------------------------------------------------------*/
$slides = [
    [
        'image'     => '/img/product-cover-umejipata.png',
        'mobileImage' => '/img/product-cover-umejipata-mobile.png',
        'tabletImage' => '/img/product-cover-umejipata-ipad.png',
        'title'     => 'Vumbua Furaha na Uhuru na DIGI',
        'subtitle'  => 'Bidhaa mahususi kwa nyumba yako',
        'primary'   => ['label' => 'View Products',          'url' => '#'],
        'secondary' => ['label' => 'Contact us',        'url' => '#'],
    ],
    [
        'image'     => '/img/tv-slider-2.jpg',
        'title'     => 'Experience True Colors In Every Scene',
        'mobileImage' => '/img/product-cover-umejipata-mobile.png',
        'tabletImage' => '/img/product-cover-umejipata-ipad.png',
        'subtitle'  => 'Immerse yourself in vibrant and lifelike visuals',
        'primary'   => ['label' => 'Shop TVs',         'url' => '#'],
        'secondary' => ['label' => 'Learn More',       'url' => '#'],
    ],
    [
        'image'     => '/img/tv-slider-3.png',
        'title'     => 'Smart Features, Seamless Entertainment',
        'mobileImage' => '/img/product-cover-umejipata-mobile.png',
        'tabletImage' => '/img/product-cover-umejipata-ipad.png',
        'subtitle'  => 'Access your favourite apps and content with ease',
        'primary'   => ['label' => 'Explore Smart TVs','url' => '#'],
        'secondary' => ['label' => 'Discover More',    'url' => '#'],
    ],
];
@endphp


{{-- =========================  HERO SLIDER  ========================= --}}
<section class="relative overflow-hidden h-[90vh]"> {{-- ← change 80vh as you wish --}}
    <div class="hero-slider h-full">
        @foreach ($slides as $slide)
            <div class="relative h-full w-full">
                {{-- Background image --}}
                <div class="absolute hidden lg:block inset-0 bg-cover bg-center" style="background-image:url('{{ $slide['image'] }}');"></div>
                <div class="absolute lg:hidden md:block inset-0 bg-cover bg-center" style="background-image:url('{{ $slide['tabletImage'] }}');"></div>
                <div class="absolute md:hidden block inset-0 bg-cover bg-center" style="background-image:url('{{ $slide['mobileImage'] }}');"></div>

                {{-- Overlay --}}
                {{-- <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div> --}}

                {{-- Copy --}}
                <div class="relative z-10 flex flex-col items-start lg:justify-center h-full p-10 md:p-20 lg:p-32">
                    <p style="background-image: url(' {{ asset('img/umejipata-label-bg.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: center;" class="text-white w-fit py-2 px-4 text-lg">DIGI Rafiki wa kweli</p>
                    <h1 class="text-4xl md:text-4xl lg:text-5xl md:w-lg font-semibold leading-tight mb-4">
                        {!! nl2br(e($slide['title'])) !!}
                    </h1>
                    <p class="text-lg font-light md:text-xl mb-8">
                        {{ $slide['subtitle'] }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ $slide['primary']['url'] }}"
                           class="bg-digi-orange flex items-center text-white px-4 py-3 rounded-full text-lg font-medium
                                  hover:bg-digi-orange-dark transition-colors duration-300">
                            {{ $slide['primary']['label'] }} <span class="hidden ml-2 px-2 py-2 md:flex items-center rounded-full border bg-white"><img src="{{ asset('img/icon_quote.svg') }}" class="inline-block w-5" alt=""></span>
                        </a>
                        <a href="{{ $slide['secondary']['url'] }}" class="flex items-center relative overflow-hidden border border-white/80 text-gray-500 backdrop-blur-md
                                bg-white/5 pr-4 pl-5 py-3 rounded-full text-lg font-medium
                                shadow-lg shadow-white/5 hover:shadow-white/10
                                hover:bg-white/20 hover:text-digi-dark transition-all duration-500 group">

                            {{-- Glass reflection layer --}}
                            <span class="absolute inset-0 bg-gradient-to-t from-white/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></span>

                            {{-- Moving highlight streak --}}
                            <span class="absolute top-0 left-[-50%] w-[200%] h-full bg-gradient-to-r from-transparent via-white/40 to-transparent transform -skew-x-12 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 ease-in-out"></span>
                            <span class="relative z-10">{{ $slide['secondary']['label'] }}</span><span class="hidden ml-2 px-2 py-2 md:flex items-center rounded-full border border-white/90"><img src="{{ asset('img/arrow.svg') }}" class="inline-block w-5" alt=""></span>
                        </a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@push('styles')
    {{-- Slick core CSS (CDN or compiled) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    {{-- Force Slick wrappers to fill the section height --}}
    <style>
        .hero-slider .slick-list,
        .hero-slider .slick-track,
        .hero-slider .slick-slide { height: 100vh; }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            console.log('initialising slick…');
            $('.hero-slider').slick({
                autoplay: true,
                autoplaySpeed: 5000,
                speed: 1000,
                fade: true,
                arrows: true,
                dots: true,
                pauseOnHover: false,
                pauseOnDotsHover: true,
                adaptiveHeight: false      // keep at fixed vh height
            });
        });
    </script>
@endpush
