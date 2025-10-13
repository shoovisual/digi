@php
/* ---------------------------------------------------------------
 | Hero Slider Data
 | Loads from DB if available; falls back to static slides
 |---------------------------------------------------------------*/

$dbSlides = \App\Models\HeroSlide::where('is_active', true)
    ->orderBy('sort_order')
    ->orderByDesc('id')
    ->get();

if ($dbSlides->count() > 0) {
    $heroSlides = $dbSlides->map(function ($s) {
        $image = $s->image ? '/img/' . ltrim($s->image, '/') : '/img/product-cover-umejipata.png';
        $mobile = $s->mobile_image ? '/img/' . ltrim($s->mobile_image, '/') : $image;
        $tablet = $s->tablet_image ? '/img/' . ltrim($s->tablet_image, '/') : $image;
        return [
            'id' => $s->id,
            'image' => $image,
            'mobileImage' => $mobile,
            'tabletImage' => $tablet,
            'title' => $s->title ?? 'Vumbua Furaha na Uhuru na DIGI',
            'subtitle' => $s->subtitle ?? 'Bidhaa mahususi kwa nyumba yako',
            'primary' => [
                'label' => $s->primary_label ?? 'View Products',
                'url' => $s->primary_url ?? '/products',
            ],
            'secondary' => [
                'label' => $s->secondary_label ?? 'Contact us',
                'url' => $s->secondary_url ?? '/contact',
            ],
        ];
    })->toArray();
} else {
    $heroSlides = [
        [
            'id' => 1,
            'image'       => '/img/product-cover-umejipata.png',
            'mobileImage' => '/img/product-cover-umejipata-mobile.png',
            'tabletImage' => '/img/product-cover-umejipata-ipad.png',
            'title'       => 'Vumbua Furaha na Uhuru na DIGI',
            'subtitle'    => 'Bidhaa mahususi kwa nyumba yako',
            'primary'     => ['label' => 'View Products', 'url' => '/products'],
            'secondary'   => ['label' => 'Contact us', 'url' => '/contact'],
        ],
        [
            'id' => 2,
            'image'       => '/img/digi-fridge-featured.jpg',
            'mobileImage' => '/img/digi-fridge-featured.jpg',
            'tabletImage' => '/img/digi-fridge-featured.jpg',
            'title'       => 'Refrigerators za Kisasa',
            'subtitle'    => 'Hifadhi chakula chako kwa muda mrefu',
            'primary'     => ['label' => 'Explore Fridges', 'url' => '/products?category=refrigerators'],
            'secondary'   => ['label' => 'Learn More', 'url' => '/about'],
        ],
        [
            'id' => 3,
            'image'       => '/img/digi-washing-machine-featured.jpg',
            'mobileImage' => '/img/digi-washing-machine-featured.jpg',
            'tabletImage' => '/img/digi-washing-machine-featured.jpg',
            'title'       => 'Mashine za Kufulia',
            'subtitle'    => 'Fulia nguo zako kwa urahisi na haraka',
            'primary'     => ['label' => 'View Washers', 'url' => '/products?category=washing-machines'],
            'secondary'   => ['label' => 'Get Quote', 'url' => '/contact'],
        ],
        [
            'id' => 4,
            'image'       => '/img/tv-cover.png',
            'mobileImage' => '/img/tv-cover.png',
            'tabletImage' => '/img/tv-cover.png',
            'title'       => 'Smart TVs za Hali ya Juu',
            'subtitle'    => 'Furahia burudani ya kisasa nyumbani',
            'primary'     => ['label' => 'Shop TVs', 'url' => '/products?category=televisions'],
            'secondary'   => ['label' => 'Compare', 'url' => '/products'],
        ],
    ];
}

// Inject active promotion as the first slide if available
$now = now();
$activePromo = \App\Models\Promotion::query()
    ->whereNotNull('start_date')
    ->where('start_date', '<=', $now)
    ->where(function ($q) use ($now) {
        $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
    })
    ->orderByDesc('start_date')
    ->orderByDesc('created_at')
    ->first();

if ($activePromo) {
    $cover = $activePromo->cover ? '/img/' . ltrim($activePromo->cover, '/') : '/img/products/products-cover.webp';
    $promoSlide = [
        'id' => 'promo-' . $activePromo->id,
        'image' => $cover,
        'mobileImage' => $cover,
        'tabletImage' => $cover,
        'title' => $activePromo->name,
        'subtitle' => 'Special offers available now',
        'primary' => [
            'label' => 'View Promo',
            'url' => route('promotions.public.show', ['promotion' => $activePromo->slug]),
        ],
        'secondary' => [
            'label' => 'Shop Products',
            'url' => '/products',
        ],
    ];
    array_unshift($heroSlides, $promoSlide);
}
@endphp


{{-- =========================  HERO SLIDER  ========================= --}}
<section class="relative overflow-hidden h-[85vh] md:h-[80vh]" id="hero-slider">
    <div class="relative h-full w-full">
        {{-- Slider Container --}}
        <div class="hero-slider relative h-full w-full">
            @foreach($heroSlides as $index => $slide)
            <div class="slide" data-slide="{{ $index }}">
                {{-- Background image --}}
                <div class="absolute hidden lg:block inset-0 bg-cover bg-bottom transition-all duration-1000" style="background-image:url('{{ $slide['image'] }}');"></div>
                <div class="absolute lg:hidden md:block inset-0 bg-cover bg-bottom transition-all duration-1000" style="background-image:url('{{ $slide['tabletImage'] }}');"></div>
                <div class="absolute md:hidden block inset-0 bg-cover bg-bottom transition-all duration-1000" style="background-image:url('{{ $slide['mobileImage'] }}');"></div>

                {{-- Overlay --}}
                {{-- <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div> --}}

                {{-- Content --}}
                <div class="relative z-10 flex flex-col items-start lg:justify-center h-full p-8 md:p-20 lg:p-32">
                    <p style="background-image: url(' {{ asset('img/umejipata-label-bg.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: center;" class="text-white w-fit py-2 px-4 text-lg">DIGI Rafiki wa kweli</p>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl md:w-lg font-semibold leading-tight mb-4">
                        {!! nl2br(e($slide['title'])) !!}
                    </h1>
                    <p class="text-lg font-light md:text-xl mb-4 md:mb-8">
                        {{ $slide['subtitle'] }}
                    </p>
                    <div class="flex space-x-2 md:space-x-4">
                        <a href="{{ $slide['primary']['url'] }}"
                           class="bg-digi-orange flex items-center text-white px-4 py-3 rounded-full text-lg font-medium
                                  hover:bg-digi-orange-dark transition-colors duration-300">
                            {{ $slide['primary']['label'] }} <span class="hidden ml-2 p-1 md:p-2 md:flex items-center rounded-full border bg-white"><img src="{{ asset('img/icon_quote.svg') }}" class="inline-block w-5" alt=""></span>
                        </a>
                        <a href="{{ $slide['secondary']['url'] }}" class="flex items-center relative overflow-hidden border border-digi-orange/70 text-gray-500 backdrop-blur-md
                                bg-white/5 pr-4 pl-5 py-3 rounded-full text-lg font-medium
                                shadow-lg shadow-white/5 hover:shadow-white/10
                                hover:bg-white/20 hover:text-digi-dark transition-all duration-500 group">

                            {{-- Glass reflection layer --}}
                            <span class="absolute inset-0 bg-gradient-to-t from-white/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></span>

                            {{-- Moving highlight streak --}}
                            <span class="absolute top-0 left-[-50%] w-[200%] h-full bg-gradient-to-r from-transparent via-white/40 to-transparent transform -skew-x-12 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 ease-in-out"></span>
                            <span class="relative z-10">{{ $slide['secondary']['label'] }}</span><span class="hidden ml-2 p-1 md:p-2 md:flex items-center rounded-full border bg-digi-orange"><img src="{{ asset('img/arrow.svg') }}" class="inline-block w-5" alt=""></span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Navigation Arrows --}}
        <button class="prev-arrow slider-nav prev absolute left-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/20 backdrop-blur-md hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button class="next-arrow slider-nav next absolute right-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/20 backdrop-blur-md hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        {{-- Dots Navigation --}}
        <div class="slider-dots absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex space-x-3">
            @foreach($heroSlides as $index => $slide)
            <button class="dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></button>
            @endforeach
        </div>
    </div>
</section>

<style>
/* Hero Slider Styles */
.hero-slider {
    position: relative;
    height: 100vh;
}

.hero-slider .slide {
    position: relative;
    height: 100vh;
    width: 100%;
}

/* Navigation Arrows */
.slider-nav {
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.slider-nav:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.slider-nav:active {
    transform: scale(0.95);
}

/* Dots Navigation */
.slider-dots .dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    border: 2px solid rgba(255, 255, 255, 0.6);
    transition: all 0.3s ease;
    cursor: pointer;
}

.slider-dots .dot:hover {
    background: rgba(255, 255, 255, 0.6);
    transform: scale(1.2);
}

.slider-dots .dot.active {
    background: #ff6b35;
    border-color: #ff6b35;
    transform: scale(1.3);
    box-shadow: 0 0 10px rgba(255, 107, 53, 0.5);
}

/* Content Animation */
.slide .relative {
    animation: slideInContent 0.8s ease-out;
}

@keyframes slideInContent {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .slider-nav {
        padding: 8px;
    }

    .slider-nav svg {
        width: 20px;
        height: 20px;
    }

    .slider-dots {
        display: none;
    }

    .slider-dots .dot {
        width: 10px;
        height: 10px;
    }
}

/* Smooth transitions for background images */
.slide [style*="background-image"] {
    transition: all 1s ease-in-out;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
$(function () {
    var $slider = $('.hero-slider');
    var $prev = $('.prev-arrow');
    var $next = $('.next-arrow');
    var $dots = $('.slider-dots .dot');

    $slider.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 6000,
        pauseOnHover: true,
        speed: 300,
        arrows: false,
        rtl: false,
        dots: false,
        fade: true,
        cssEase: 'ease-in-out'
    });

    // Manual arrow bindings to ensure correct direction
    $prev.on('click', function (e) {
        e.preventDefault();
        $slider.slick('slickPrev');
    });

    $next.on('click', function (e) {
        e.preventDefault();
        $slider.slick('slickNext');
    });

    function updateArrows(slick, currentSlide) {
        // Keep arrows always enabled for infinite scrolling
        $prev.prop('disabled', false).removeClass('opacity-50');
        $next.prop('disabled', false).removeClass('opacity-50');
    }

    function updateDots(currentSlide) {
        $dots.removeClass('active');
        $dots.eq(currentSlide).addClass('active');
    }

    // On init
    $slider.on('init', function(event, slick) {
        updateArrows(slick, slick.currentSlide);
        updateDots(slick.currentSlide);
    });

    // After slide change
    $slider.on('afterChange', function(event, slick, currentSlide) {
        updateArrows(slick, currentSlide);
        updateDots(currentSlide);
    });

    // Custom dots navigation
    $dots.on('click', function() {
        var slideIndex = $(this).data('slide');
        $slider.slick('slickGoTo', slideIndex);
    });

    // Re-initialize arrows on page load
    $slider.slick('setPosition');

    // Add smooth scroll behavior for anchor links in slides
    $('.slide a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        var target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 800);
        }
    });
});
</script>
