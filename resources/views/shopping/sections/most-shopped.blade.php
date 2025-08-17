@php
    $images = json_decode($product->product_images ?? '[]', true);
@endphp
<section class="w-full bg-[#F2F0EC]">
    <div class="md:max-w-7xl mx-auto px-4 py-8">
        <div class="section-header flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Most Shopped Products</h2>
            <div class="flex justify-center items-center gap-4 text-2xl">
                <button class="product-prev-arrow px-3 py-2 flex items-center opacity-50 justify-center rounded-full border transition cursor-pointer">
                    <i class="bi bi-chevron-left"></i>
                </button>
                {{-- <span class="current-slide">1</span> / <span class="total-slides">4</span> --}}
                <button class="product-next-arrow px-3 py-2 flex items-center justify-center rounded-full border transition cursor-pointer">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="shopped-slider">
            @foreach ($products as $product)
                <div class="bg-white mx-2 rounded-2xl p-5 flex flex-col justify-between hover:shadow-lg transition duration-300">
                    <div>
                        <div x-data="{ copyText: '{{ $product->serial }}', copied: false }" class="flex items-center gap-2">
                            <span class="text-md text-gray-400 font-medium">{{ $product->serial }}</span>
                            <svg @click="navigator.clipboard.writeText(copyText); copied = true; setTimeout(() => copied = false, 2000)"
                                class="w-4 h-4 text-gray-400 cursor-pointer hover:text-gray-600 transition"
                                fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <title x-show="!copied">Copy</title>
                                <title x-show="copied">Copied!</title>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" />
                            </svg>
                            <span x-show="copied" class="text-green-500 text-xs font-medium">Copied!</span>
                        </div>

                        <h2 class="text-2xl font-medium text-black leading-snug">
                            {{ Str::limit($product->name, 30) }}
                        </h2>
                        <p class="text-sm font-medium text-gray-500 mt-1">{{ $product->product_short }}</p>

                        <!-- IMAGE CAROUSEL -->
                        <div x-data="{ activeImage: 0 }" class="relative w-full group h-48 overflow-hidden transition cursor-pointer duration-300 my-4 rounded-lg bg-white">
                            @if(count($images) > 0)
                                <template x-for="(img, index) in {{ json_encode($images) }}" :key="index">
                                    <img x-show="activeImage === index" :src="'/img/' + img" :alt="'{{ $product->name }} - Image ' + (index + 1)"
                                        class="absolute top-0 left-0 w-full h-full object-contain transition duration-300 ease-in-out">
                                </template>

                                <!-- Carousel Controls -->
                                <div class="absolute hidden inset-0 group-hover:flex items-center justify-between transition duration-300 ease-in-out px-2">
                                    <button @click="activeImage = activeImage > 0 ? activeImage - 1 : {{ count($images) }} - 1"
                                        class="bg-white border border-gray-400 cursor-pointer px-1.5 text-xs bg-opacity-50 hover:bg-opacity-80 rounded-full p-1">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button @click="activeImage = activeImage < {{ count($images) }} - 1 ? activeImage + 1 : 0"
                                        class="bg-white border border-gray-400 cursor-pointer px-1.5 text-xs bg-opacity-50 hover:bg-opacity-80 rounded-full p-1">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                            @else
                                <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-contain">
                            @endif
                        </div>
                    </div>

                    <!-- RATING + ACTIONS -->
                    <div class="flex flex-col space-y-3">
                        @include('shopping.sections.rating')

                        <div class="flex items-center justify-between text-sm font-medium">
                                <a href="{{ route('products.show', $product->slug) }}" class="px-4 py-3 border border-gray-300 rounded-full text-black hover:bg-gray-100">
                                    View Product
                                </a>

                            <button
                                onclick="openBuyModal(
                                    '{{ addslashes($product->name) }}',
                                    '{{ asset('img/' . $product->image) }}',
                                    '{{ $product->slug }}'
                                )"
                                class="px-4 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-full">
                                Where to Buy
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
    $(function () {
        var $slider = $('.shopped-slider');
        var $prev = $('.product-prev-arrow');
        var $next = $('.product-next-arrow');

        $slider.slick({
            slidesToShow: 4,
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

{{-- @include('layouts.partials.whereToBuy-modal') --}}
