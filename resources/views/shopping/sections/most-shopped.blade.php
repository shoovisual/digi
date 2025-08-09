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


<!-- Modal -->
<div id="buyModal" class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center" >
    <div class="bg-white rounded-xl overflow-hidden w-full max-w-5xl mx-4 flex flex-col md:flex-row shadow-xl">
        <!-- Product Info -->
        <div class="w-full md:w-1/2 p-6 border-b md:border-b-0 md:border-r space-y-4">
            <h2 id="modalProductName" class="text-xl font-semibold">Product Name</h2>
            <img id="modalProductImage" src="" alt="" class="rounded" />
            <p class="text-md font-medium text-gray-600">*In-store and other retailers' prices will vary.</p>
        </div>

        <!-- Google Map + Store Info -->
        <div class="w-full md:w-1/2 p-6">
            <div id="map" class="h-64 w-full rounded mb-4"></div>
            <div id="storeList" class="text-sm border-b border-gray-200 text-gray-800"></div>
        </div>
    </div>
</div>
<script>
  function openBuyModal(name, image, slug) {
    const modal = document.getElementById("buyModal");

    // Show modal
    modal.classList.remove("hidden");
    modal.classList.add("flex");

    // Set product details
    document.getElementById("modalProductName").textContent = name;
    document.getElementById("modalProductImage").src = image;
    document.getElementById("modalProductImage").alt = name;

    // Load map
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showMapWithStores, function () {
        alert("Location blocked or not available.");
      });
    } else {
      alert("Geolocation not supported by your browser.");
    }
  }

  function showMapWithStores(position) {
    const userLat = position.coords.latitude;
    const userLng = position.coords.longitude;

    const userLatLng = [userLat, userLng];

    const map = L.map('map').setView(userLatLng, 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker(userLatLng).addTo(map).bindPopup("You are here").openPopup();

    const stores = [
      {
        name: 'Jaden Home Store',
        lat: -6.7740129,
        lng: 39.1966954,
        address: 'Rose Garden Rd., Mikocheni',
        phone: '0768285151',
      },
      {
        name: 'DIGI Store',
        lat: -6.8147387,
        lng: 39.2879986,
        address: 'Maktaba Square, Posta',
        phone: '0793 333 444',
        email: 'info@digiappliances.com',
      },
      {
        name: 'Mashariki Electronics',
        lat: -6.786251,
        lng: 39.2153335,
        address: 'Kariakoo, Dar es Salaam',
        phone: '0793 333 444',
        email: 'info@digiappliances.com',
      },
    ];

    stores.forEach(store => {
      L.marker([store.lat, store.lng])
        .addTo(map)
        .bindPopup(`<strong>${store.name}</strong><br>${store.address || ''}<br>Phone: ${store.phone || 'N/A'}<br>Email: ${store.email || 'N/A'}`);
    });

    // ESC or click outside to close
    window.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') document.getElementById("buyModal").classList.add("hidden");
    });

    document.getElementById("buyModal").addEventListener('click', function (e) {
      if (e.target.id === 'buyModal') this.classList.add("hidden");
    });

    document.getElementById("storeList").innerHTML = stores.map(store =>
      `<div class="mb-2"><strong>${store.name}</strong><br><span>${store.address}</span></div>`
    ).join('');
  }
</script>
