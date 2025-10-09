@php
    $bannerImage = [
            [
                'title' => 'Wash Fast and Easy',
                'subtitle' => 'With our affordable washing machines',
                'image' => 'img/digi-washing-machine-featured.jpg',
                'url' => '/categories/digi-washing-machine',
            ],
            [
                'title' => 'Enjoy in Every Pixel',
                'subtitle' => 'With our affordable UHD Smart TV',
                'image' => 'img/products/tvs/tv-featured.jpg',
                'url' => '/categories/digi-tvs',
            ],
            [
                'title' => 'Keep it Fresher, Longer',
                'subtitle' => 'With our affordable Digi Fridges',
                'image' => 'img/digi-fridge-featured.jpg',
                'url' => '/categories/digi-refrigerators',
            ],
            [
                'title' => 'Stay Fresh, Stay Frozen!',
                'subtitle' => 'With our affordable Digi Freezer',
                'image' => 'img/products/freezers/freezer-featured.webp',
                'url' => '/categories/digi-freezers',
            ],
            [
                'title' => 'Cook Like a Chef',
                'subtitle' => 'Control Every Flame With Digi Gas Cookers',
                'image' => 'img/products/gas-cooker/gas-cooker-cover-2.webp',
                'url' => '/categories/digi-gas-cookers',
            ],
            [
                'title' => 'Stay Cool Always',
                'subtitle' => 'With our affordable Digi Air Conditioners',
                'image' => 'img/products/ac/ac-cover.webp',
                'url' => '/categories/digi-acs',
            ],
        ];
@endphp
<section class="py-10 bg-[#F2F0EC]">
    <div class="max-w-7xl mx-auto px-4">
        <div class="banner-slider justify-center">
            @foreach ($bannerImage as $image)
                <div class="rounded-2xl mx-3 slide overflow-hidden shadow-lg relative">
                    {{-- Image --}}
                    <img src="{{ $image['image'] }}" alt="{{ $image['title'] }}" class="w-full h-[450px] object-cover" />

                    {{-- Overlay --}}
                    <a href="{{ $image['url'] }}" class="absolute group inset-x-0 text-center bottom-0 bg-gradient-to-t h-[70%] from-black/100 to-black/0 text-white p-4">
                        <div class="absolute inset-x-0 bottom-5">
                            <h3 class="text-3xl font-medium mb-1">{{ $image['title'] }}</h3>
                            <p class="font-regular mb-3">{{ $image['subtitle'] }}</p>
                            <div class="flex gap-2 justify-center">
                                <div
                                class="text-[16px] px-4 flex items-center py-3 border border-orange-500 group-hover:bg-orange-600 rounded-full text-white font-medium transition">
                                    View Products
                                        <span>
                                           <img src="{{ asset('img/chevron-right.svg') }}" class=" group-hover:opacity-100 opacity-0 group-hover:translate-x-1 transition-all group-hover:w-5 w-0 ease-in-out duration-300" alt="">
                                        </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        {{-- Custom Slider Arrows --}}
        <div class="flex justify-center items-center mt-6 gap-8">
            <button class="prev-arrow w-8 h-8 flex items-center opacity-50 justify-center rounded-full border transition cursor-pointer">
                <i class="bi bi-chevron-left"></i>
            </button>
            <div class="text-sm font-medium flex items-center gap-x-4">
                <span class="current-slide">1</span> / <span class="total-slides">{{ count($bannerImage) }}</span>
            </div>
            <button class="next-arrow w-8 h-8 flex items-center justify-center rounded-full border transition cursor-pointer">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(function () {
        var $slider = $('.banner-slider');
        var $prev = $('.prev-arrow');
        var $next = $('.next-arrow');

        $slider.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: false,
            autoplay: false,
            autoplaySpeed: 5000,
            speed: 500,
            prevArrow: $prev,
            nextArrow: $next,
            dots: false,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 2 }},
                { breakpoint: 640, settings: { slidesToShow: 1 }}
            ]
        });

        function updateArrows(slick, currentSlide) {
            var totalSlides = slick.slideCount;
            var slidesToShow = slick.options.slidesToShow;

            // Disable prev if at start
            if (currentSlide === 0) {
                $prev.prop('disabled', true).addClass('opacity-50');
            } else {
                $prev.prop('disabled', false).removeClass('opacity-50');
            }

            // Disable next if at end
            if (currentSlide >= totalSlides - slidesToShow) {
                $next.prop('disabled', true).addClass('opacity-50');
            } else {
                $next.prop('disabled', false).removeClass('opacity-50');
            }
        }

        // On init
        $slider.on('init', function(event, slick) {
            updateArrows(slick, slick.currentSlide);
            $('.total-slides').text(slick.slideCount);
            $('.current-slide').text(slick.currentSlide + 1);
        });

        // After slide change
        $slider.on('afterChange', function(event, slick, currentSlide) {
            updateArrows(slick, currentSlide);
            $('.current-slide').text(currentSlide + 1);
        });

        // Re-initialize arrows on page load
        $slider.slick('setPosition');
    });
</script>


