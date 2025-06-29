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
                <p class="text-white text-lg md:text-xl mb-8">
                    With our affordable UHD Smart TV
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="bg-digi-orange text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-digi-orange-dark transition-colors duration-300">
                        Buy now
                    </a>
                    <a href="#" class="border-2 border-white text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-white hover:text-digi-dark transition-colors duration-300">
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
                    <a href="#" class="bg-digi-orange text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-digi-orange-dark transition-colors duration-300">
                        Shop TVs
                    </a>
                    <a href="#" class="border-2 border-white text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-white hover:text-digi-dark transition-colors duration-300">
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
                    <a href="#" class="bg-digi-orange text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-digi-orange-dark transition-colors duration-300">
                        Explore Smart TVs
                    </a>
                    <a href="#" class="border-2 border-white text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-white hover:text-digi-dark transition-colors duration-300">
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
        prevArrow:
            `<button type="button"
                     class="slick-prev absolute left-4 top-1/2 -translate-y-1/2 z-20 flex h-12 w-12 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-all duration-300 hover:scale-110">
                 <svg class="h-6 w-6" fill="none" stroke="currentColor"
                      stroke-width="2" viewBox="0 0 24 24">
                     <polyline points="15 18 9 12 15 6"></polyline>
                 </svg>
             </button>`,
        nextArrow:
            `<button type="button"
                     class="slick-next absolute right-4 top-1/2 -translate-y-1/2 z-20 flex h-12 w-12 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-all duration-300 hover:scale-110">
                 <svg class="h-6 w-6" fill="none" stroke="currentColor"
                      stroke-width="2" viewBox="0 0 24 24">
                     <polyline points="9 18 15 12 9 6"></polyline>
                 </svg>
             </button>`
    });
});
</script>
