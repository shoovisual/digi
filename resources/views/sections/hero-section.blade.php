@php
/* ---------------------------------------------------------------
 | Slider data
 |---------------------------------------------------------------*/
$slides = [
    [
        'image'     => '/img/tv-cover.png',
        'title'     => 'Enjoy the Best in Every Pixel',
        'subtitle'  => 'With our affordable UHD Smart TV',
        'primary'   => ['label' => 'Buy now',          'url' => '#'],
        'secondary' => ['label' => 'View More',        'url' => '#'],
    ],
    [
        'image'     => '/img/tv-slider-2.jpg',
        'title'     => 'Experience True Colors In Every Scene',
        'subtitle'  => 'Immerse yourself in vibrant and lifelike visuals',
        'primary'   => ['label' => 'Shop TVs',         'url' => '#'],
        'secondary' => ['label' => 'Learn More',       'url' => '#'],
    ],
    [
        'image'     => '/img/tv-slider-3.png',
        'title'     => 'Smart Features, Seamless Entertainment',
        'subtitle'  => 'Access your favourite apps and content with ease',
        'primary'   => ['label' => 'Explore Smart TVs','url' => '#'],
        'secondary' => ['label' => 'Discover More',    'url' => '#'],
    ],
];
@endphp


{{-- =========================  HERO SLIDER  ========================= --}}
<section class="relative overflow-hidden h-[80vh]"> {{-- ← change 80vh as you wish --}}
    <div class="hero-slider h-full">
        @foreach ($slides as $slide)
            <div class="relative h-full w-full">
                {{-- Background image --}}
                <div class="absolute inset-0 bg-cover bg-center"
                     style="background-image:url('{{ $slide['image'] }}');"></div>

                {{-- Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>

                {{-- Copy --}}
                <div class="relative z-10 flex flex-col justify-center h-full p-10 md:p-20 lg:p-32">
                    <h1 class="text-white text-4xl md:text-5xl lg:text-6xl md:w-lg font-regular leading-tight mb-4">
                        {!! nl2br(e($slide['title'])) !!}
                    </h1>
                    <p class="text-white text-lg font-light md:text-xl mb-8">
                        {{ $slide['subtitle'] }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ $slide['primary']['url'] }}"
                           class="bg-digi-orange text-white px-6 py-3 rounded-full text-lg font-medium
                                  hover:bg-digi-orange-dark transition-colors duration-300">
                            {{ $slide['primary']['label'] }}
                        </a>
                        <a href="{{ $slide['secondary']['url'] }}"
                           class="border-2 border-white text-white px-6 py-3 rounded-full text-lg font-medium
                                  hover:bg-white hover:text-digi-dark transition-colors duration-300">
                            {{ $slide['secondary']['label'] }}
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
