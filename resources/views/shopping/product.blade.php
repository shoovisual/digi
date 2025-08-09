@extends('layouts.app')
@section('title', $product->name)

@section('meta')
    <meta name="description" content="{{ $product->name . '. ' . $product->description }}">
    <meta name="keywords" content="{{ $category->meta_keywords ?? 'Digi, Appliances, ' . $product->name }}">
    <meta property="og:description" content="{{ $product->name . '. ' . $product->description }}">
    <meta property="og:image" content="{{ asset('img/' . ($product->image ?? 'default-category.jpg')) }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta name="twitter:title" content="{{ $product->name }} | Digi Appliances">
    <meta name="twitter:description" content="{{ $product->name . $product->description }}">
    <meta name="twitter:image" content="{{ asset('img/' . ($category->cover_image ?? 'default-category.jpg')) }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Product Details Section -->
    <div class="flex flex-col md:flex-row gap-8 mb-16">
        @php
            $gallery = collect([$product->image])
                ->merge(json_decode($product->product_images, true) ?? [])
                ->filter(fn($img) => !empty($img) && file_exists(public_path('img/' . $img)))
                ->unique()
                ->values();
        @endphp

        <div class="w-full mx-auto md:w-1/2">
            <!-- Main Image -->
            <div class="bg-white rounded-lg overflow-hidden flex items-center justify-center mb-6">
                <img id="mainImage" src="{{ asset('img/' . $gallery[0]) }}"
                    alt="{{ $product->name }}"
                    class="w-full max-h-[500px] object-contain transition-all duration-300" />
            </div>

            <!-- Thumbnail Slider -->
            <div class="swiper mx-auto justify-center thumbnailSwiper">
                <div class="swiper-wrapper">
                    @foreach($gallery as $img)
                        <div class="swiper-slide cursor-pointer">
                            <img
                                onclick="document.getElementById('mainImage').src = '{{ asset('img/' . $img) }}'"
                                src="{{ asset('img/' . $img) }}"
                                class="aspect-square w-full object-cover rounded-md border hover:ring-2 hover:ring-ark-brown transition-all duration-200"
                                alt="{{ $product->name }} thumbnail" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>





        <!-- Product Info -->
        <div class="md:w-1/2 pr-8">
            <!-- Product Title -->
            <h1 id="product-name" class="text-3xl sm:text-4xl font-bold text-black leading-snug mb-2">
                {{ $product->name }}
            </h1>

            <!-- SKU & Chat -->
            <div class="flex items-center gap-3 text-lg text-gray-500 mb-2">
                <div x-data="{ copyText: '{{ $product->serial }}', copied: false }" class="flex items-center gap-2">
                    <span class="font-medium">{{ $product->serial }}</span>
                    <!-- Copy Icon -->
                    <svg @click="navigator.clipboard.writeText(copyText); copied = true; setTimeout(() => copied = false, 2000)"
                        class="w-6 h-6 text-gray-400 cursor-pointer hover:text-gray-600 transition"
                        fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <title x-show="!copied">Copy</title>
                        <title x-show="copied">Copied!</title>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" />
                    </svg>

                    <!-- Optional Feedback -->
                    <span x-show="copied" class="text-green-500 text-xs font-medium">Copied!</span>
                </div>

                <a href="https://wa.me/255748504676" id="wa-btn" target="_blank" class="text-digi-orange font-medium hover:underline flex items-center gap-1">
                    Chat with an expert
                    <img src="{{ asset('img/icons/ico-chat-red-72-72-2.gif') }}" alt="WhatsApp Icon" class="w-6 ml-1 h-6">
                    {{-- <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 10c0 3.866-3.582 7-8 7a8.22 8.22 0 01-3.946-1.011L2 17l1.302-3.717A7.763 7.763 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7z"/>
                    </svg> --}}
                </a>
            </div>

            <!-- Star Rating -->
            @include('shopping.sections.rating', ['rating' => $product->rating])

            <!-- Share Thoughts Button -->
            <button class="bg-digi-dark mt-3 hover:bg-red-700 text-white text-sm px-4 py-2 rounded mb-5 font-medium">
                SHARE YOUR THOUGHTS!
            </button>

            <!-- Key Features -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Key Features</h2>

                @php
                    $features = json_decode($product->features ?? '[]', true);
                    $features = is_array($features) ? $features : [];
                @endphp

                @if(count($features) > 0)
                    <div x-data="{ expanded: false }">

                        <ul class="list-disc font-medium pl-6 text-gray-700 text-sm space-y-1">
                            @foreach($features as $index => $feature)
                                <li x-show="expanded || {{ $index }} < 3" x-cloak>{{ $feature }}</li>
                            @endforeach
                        </ul>

                        @if(count($features) > 3)
                            <button @click="expanded = !expanded" type="button"
                                class="text-sm text-black mt-2 cursor-pointer inline-flex items-center hover:underline font-medium focus:outline-none">
                                <span x-show="!expanded">View More</span>
                                <span x-show="expanded">View Less</span>
                                <svg class="w-4 h-4 ml-1 transform transition-transform duration-200"
                                    :class="{ '-rotate-90': expanded }" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                                </svg>
                            </button>
                        @endif

                    </div>
                @else
                    <p class="text-gray-500 text-sm">No features available</p>
                @endif

            </div>

            <!-- Buttons -->
            <div class="buttons flex items-center justify-start font-medium gap-4">
                <div class="flex basic-btn space-x-2">
                    <a href="#" id="wa-btn-2" target="_blank" class="bg-orange-500 hover:bg-digi-orange cursor-pointer text-white text-[16px] px-6 py-3 rounded-full font-medium transition">
                        Contact Sales
                    </a>
                    <button onclick="openBuyModal()" class="bg-gray-200 cursor-pointer hover:bg-gray-300 text-gray-700 text-[16px] px-6 py-3 rounded-full font-medium transition">
                        Where to Buy
                    </button>
                </div>
                <button id="wishlist-icon-{{ $product->id }}" onclick="addToWishlist('{{ $product->id }}', '{{ $product->name }}', '{{ $product->image }}', '{{ $product->slug }}')"
                    class="text-gray-500 text-4xl cursor-pointer hover:text-orange-500"> <i class=""></i>
                </button>
                </div>

                <!-- Modal -->
                <div id="buyModal" class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center" >
                    <div class="bg-white rounded-xl overflow-hidden w-full max-w-5xl mx-4 flex flex-col md:flex-row shadow-xl">
                        <!-- Product Info -->
                        <div class="w-full md:w-1/2 p-6 border-b md:border-b-0 md:border-r space-y-4">
                        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                        <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}" class="rounded" />
                        <p class="text-md font-medium text-gray-600">*In-store and other retailers' prices will vary.</p>
                        </div>

                        <!-- Google Map + Store Info -->
                        <div class="w-full md:w-1/2 p-6">
                            <div id="map" class="h-64 w-full rounded mb-4"></div>
                            <div id="storeList" class="text-sm border-b border-gray-200 text-gray-800"></div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

    <!-- Related Products Section -->
    <div class="w-full bg-[#F2F0EC] border-b border-gray-400">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($relatedProducts as $relatedProduct)
                    <x-product-card :product="$relatedProduct" />
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('sections.need-help')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.thumbnailSwiper', {
            slidesPerView: 3,
            spaceBetween: 16,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                768: { slidesPerView: 3 },
                1024: { slidesPerView: 4 }
            }
        });
    });
</script>

<script>
  function openBuyModal() {
    document.getElementById("buyModal").classList.remove("hidden");
    document.getElementById("buyModal").classList.add("flex");

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

    // Set tile layer (OpenStreetMap, no API key needed)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // User location marker
    L.marker(userLatLng).addTo(map).bindPopup("You are here").openPopup();

    // Manually listed store locations
    const stores = [
      {
        name: 'Jaden Home Store',
        lat: -6.7740129,
        lng: 39.1966954,
        address: 'Haidery Plaza, Posta',
        phone: '0768285151',
        email: 'digi@store',
      },
      {
        name: 'DIGI Store',
        lat: -6.8147387,
        lng: 39.2879986,
        address: 'Haidery Plaza, Posta',
        phone: '070 000 0000',
        email: 'digi@store',
      },
    ];

    // Add store markers
    stores.forEach(store => {
      L.marker([store.lat, store.lng])
        .addTo(map)
        .bindPopup(`<strong>${store.name}</strong><br>${store.address}`);
    });

    window.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') document.getElementById("buyModal").classList.add("hidden");
  });
  document.getElementById("buyModal").addEventListener('click', function (e) {
    if (e.target.id === 'buyModal') this.classList.add("hidden");
  });

    // Store list under map
    document.getElementById("storeList").innerHTML = stores.map(store =>
      `<div class="mb-2"><strong>${store.name}</strong><br><span>${store.address}</span></div>`
    ).join('');
  }
</script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
    // 1. Grab the product name
    const productName = document.getElementById('product-name')?.textContent.trim() || 'Awesome product';

    // 2. Grab the page URL (you can also use a canonical URL if you prefer)
    const productLink = window.location.href;

    // 3. Compose the WhatsApp message
    const message = `Hello 👋, I'm interested in *${productName}*.\n${productLink}`;

    // 4. Encode the message for a URL
    const encodedMsg = encodeURIComponent(message);

    // 5. Build the full WhatsApp link
    const waNumber = '255748504676';
    const waUrl = `https://wa.me/${waNumber}?text=${encodedMsg}`;

    // 6. Inject into the button
    document.getElementById('wa-btn').setAttribute('href', waUrl);
    document.getElementById('wa-btn-2').setAttribute('href', waUrl);
    });
</script>
