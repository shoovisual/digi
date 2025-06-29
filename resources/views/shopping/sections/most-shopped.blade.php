<section class="md:max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Most Shopped Products</h2>
    <div class="grid shopped-slider grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="bg-off-white border border-[#939393] mx-2 rounded-lg slide shadow-md overflow-hidden">
                <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-contain p-4">
                <div class="p-4 text-center">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $product->category }}</p>
                    <a href="#" class="mt-4 inline-block px-4 py-2 border border-gray-300 text-gray-700 rounded-full hover:bg-gray-100 transition duration-300">View Product</a>
                </div>
            </div>
        @endforeach
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
$(function () {
    // guard—console.log so you know it fired
    console.log('initialising slick…');

    $('.shopped-slider').slick({
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 1000,
        slidesToShow: 4,
        slideToScroll: 1,
        arrows: true,
        dots: true,
        pauseOnHover: false,
        pauseOnDotsHover: true,
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
        ],
    });
});
</script>
