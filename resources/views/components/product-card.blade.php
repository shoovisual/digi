@php
    $images = json_decode($product->product_images ?? '[]', true);
@endphp

<div class="bg-white slide rounded-2xl p-5 flex flex-col justify-between hover:shadow-lg transition duration-300 w-full max-w-sm mx-auto">
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

        <h2 class="text-2xl font-regular text-black leading-snug" title="{{ $product->name }}">{{ Str::limit($product->name, 65) }}</h2>
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
    <div class="flex flex-col space-y-2">
        @include('shopping.sections.rating')

        <div class="flex items-center justify-start font-medium gap-1 mt-1">
            {{-- @if(isset($product) && !empty($product->slug))
                 <a href="{{ route('products.show', $product->slug) }}" class="px-4 py-2 border border-gray-300 rounded-full text-[16px] text-black hover:bg-gray-100">
                     View Product
                 </a>
             @else
                 <span class="px-4 py-2 border border-gray-300 rounded-full text-[16px] text-gray-400 cursor-not-allowed">
                     View Product
                 </span>
             @endif --}}
             <a href="{{ route('products.show', $product) }}" class="px-4 py-2 border border-gray-300 rounded-full text-[16px] text-black hover:bg-gray-100"></a>
            <button
                onclick="openBuyModal(
                    '{{ addslashes($product->name) }}',
                    '{{ asset('img/' . $product->image) }}',
                    '{{ $product->slug }}'
                )"
                class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full text-[16px]">
                Where to Buy
            </button>

            <button id="wishlist-icon-{{ $product->id }}" onclick="addToWishlist('{{ $product->id }}', '{{ $product->name }}', '{{ $product->image }}', '{{ $product->slug }}')"
                class="text-gray-500 text-3xl cursor-pointer hover:text-orange-500">
                <i class=""></i>
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="buyModal-{{ $product->slug }}" class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center" >
    <div class="bg-white rounded-xl overflow-hidden w-full max-w-5xl mx-4 flex flex-col md:flex-row shadow-xl">
        <!-- Product Info -->
        <div class="w-full md:w-1/2 p-6 border-b md:border-b-0 md:border-r space-y-4">
            <h2 id="modalProductName-{{ $product->slug }}" class="text-xl font-semibold">Product Name</h2>
            <img id="modalProductImage-{{ $product->slug }}" src="" alt="" class="rounded" />
            <p class="text-md font-medium text-gray-600">*In-store and other retailers' prices will vary.</p>
        </div>

        <!-- Google Map + Store Info -->
        <div class="w-full md:w-1/2 p-6">
            <div id="map-{{ $product->slug }}" class="h-64 w-full rounded mb-4"></div>
            <div id="storeList-{{ $product->slug }}" class="text-sm border-b border-gray-200 text-gray-800"></div>
        </div>
    </div>
</div>
<script>
  function openBuyModal(name, image, slug) {
    const modal = document.getElementById(`buyModal-${slug}`);

    // Show modal
    modal.classList.remove("hidden");
    modal.classList.add("flex");

    // Set product details
    document.getElementById(`modalProductName-${slug}`).textContent = name;
    document.getElementById(`modalProductImage-${slug}`).src = image;
    document.getElementById(`modalProductImage-${slug}`).alt = name;

    // Load map
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        showMapWithStores(position, slug);
      }, function () {
        alert("Location blocked or not available.");
      });
    } else {
      alert("Geolocation not supported by your browser.");
    }
  }

  function showMapWithStores(position, slug) {
    const userLat = position.coords.latitude;
    const userLng = position.coords.longitude;

    const userLatLng = [userLat, userLng];

    const map = L.map(`map-${slug}`).setView(userLatLng, 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker(userLatLng).addTo(map).bindPopup("You are here").openPopup();

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

    stores.forEach(store => {
      L.marker([store.lat, store.lng])
        .addTo(map)
        .bindPopup(`<strong>${store.name}</strong><br>${store.address}`);
    });

    // ESC or click outside to close
    window.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') document.getElementById(`buyModal-${slug}`).classList.add("hidden");
    });

    document.getElementById(`buyModal-${slug}`).addEventListener('click', function (e) {
      if (e.target.id === `buyModal-${slug}`) this.classList.add("hidden");
    });

    document.getElementById(`storeList-${slug}`).innerHTML = stores.map(store =>
      `<div class="mb-2"><strong>${store.name}</strong><br><span>${store.address}</span></div>`
    ).join('');
  }
</script>

