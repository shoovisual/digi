@php
    /*
     |-------------------------------------------------------------------------
     | Slider data.
     |-------------------------------------------------------------------------
     */
    $slides = [
        [
            'image'  => '/img/tv-cover.png',
            'title'  => 'Enjoy the Best in Every Pixel',
            'subtitle' => 'With our affordable UHD Smart TV',
            'primary' => ['label' => 'Buy now',  'url' => '#'],
            'secondary' => ['label' => 'View More', 'url' => '#'],
        ],
        [
            'image'  => '/img/tv-slider-2.jpg',
            'title'  => 'Experience True Colors In Every Scene',
            'subtitle' => 'Immerse yourself in vibrant and lifelike visuals',
            'primary' => ['label' => 'Shop TVs',   'url' => '#'],
            'secondary' => ['label' => 'Learn More', 'url' => '#'],
        ],
        [
            'image'  => '/img/tv-slider-3.png',
            'title'  => 'Smart Features, Seamless Entertainment',
            'subtitle' => 'Access your favourite apps and content with ease',
            'primary' => ['label' => 'Explore Smart TVs', 'url' => '#'],
            'secondary' => ['label' => 'Discover More',   'url' => '#'],
        ],
    ];
@endphp


<section class="relative overflow-hidden h-screen">
    <div class="hero-slider h-full">
        {{-- one slide --}}
        <div class="relative h-full w-full">
            <div class="absolute inset-0 bg-cover bg-center"
                 style="background-image:url('/img/tv-cover.png'); background-size: cover;"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
            <div class="relative z-10 flex flex-col justify-center h-full p-10 md:p-20 lg:p-32">
                <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                    Enjoy the Best in<br>Every Pixel
                </h1>
                <p class="text-white text-lg font-semibold md:text-xl mb-8">
                    With our affordable UHD Smart TV
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="bg-digi-orange text-white px-6 py-3 rounded-full text-lg font-medium hover:bg-digi-orange-dark transition-colors duration-300">
                        Buy now
                    </a>
                    <a href="#" class="border-2 border-white text-white px-6 py-3 rounded-full text-lg font-medium hover:bg-white hover:text-digi-dark transition-colors duration-300">
                        View More
                    </a>
                </div>
            </div>
        </div>
        {{-- duplicate & edit for more slides --}}
        <div class="relative h-full w-full">
            <div class="absolute inset-0 bg-cover bg-center"
                 style="background-image:url('/img/tv-slider-2.jpg'); background-size: cover;"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
            <div class="relative z-10 flex flex-col justify-center h-full p-10 md:p-20 lg:p-32">
                <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                    Experience True Colors<br>In Every Scene
                </h1>
                <p class="text-white text-lg md:text-xl mb-8">
                    Immerse yourself in vibrant and lifelike visuals
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="bg-digi-orange text-white px-6 py-3 rounded-full text-lg font-medium hover:bg-digi-orange-dark transition-colors duration-300">
                        Shop TVs
                    </a>
                    <a href="#" class="border-2 border-white text-white px-6 py-3 rounded-full text-lg font-medium hover:bg-white hover:text-digi-dark transition-colors duration-300">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
        <div class="relative h-full w-full">
            <div class="absolute inset-0 bg-cover bg-center"
                 style="background-image:url('/img/tv-slider-3.png'); background-size: cover;"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
            <div class="relative z-10 flex flex-col justify-center h-full p-10 md:p-20 lg:p-32">
                <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                    Smart Features,<br>Seamless Entertainment
                </h1>
                <p class="text-white text-lg md:text-xl mb-8">
                    Access your favorite apps and content with ease
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="bg-digi-orange text-white px-6 py-3 rounded-full text-lg font-medium hover:bg-digi-orange-dark transition-colors duration-300">
                        Explore Smart TVs
                    </a>
                    <a href="#" class="border-2 border-white text-white px-6 py-3 rounded-full text-lg font-medium hover:bg-white hover:text-digi-dark transition-colors duration-300">
                        Discover More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
$(function () {
    // guard—console.log so you know it fired
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

    });
});
</script>
