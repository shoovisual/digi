<section class="py-10 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="banner-slider">
            @foreach ($bannerImage as $image)
                <div class="rounded-xl mx-3 slide overflow-hidden shadow-lg relative">
                    {{-- Product Image --}}
                    <img src="{{ $image['image'] }}"
                         alt="{{ $image['title'] }}"
                         class="w-full h-80 object-cover" />

                    {{-- Overlay --}}
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/100 to-black/0 text-white p-4">
                        <h3 class="text-lg font-bold mb-1">{{ $image['title'] }}</h3>
                        <p class="text-sm mb-3">{{ $image['subtitle'] }}</p>
                        <div class="flex gap-2">
                            <a href="#"
                               class="text-sm px-4 py-2 bg-orange-500 hover:bg-orange-600 rounded-full text-white font-medium transition">
                                Buy now
                            </a>
                            <a href="#"
                               class="text-sm px-4 py-2 border border-white/30 hover:bg-white/10 rounded-full text-white font-medium transition">
                                View More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(function () {
        $('.banner-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
            dots: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    });
</script>
