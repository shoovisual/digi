<div
    x-data="whereToBuyModal({
        {{-- googleKey : '{{ config('services.google.places_key') }}', --}}
        {{-- mapboxKey : '{{ config('services.mapbox.key') }}' --}}
    })"
    x-show="isOpen"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 overflow-y-auto"
>
    <!-- outer click closes -->
    <div @click.self="close" class="absolute inset-0"></div>

    <!-- modal -->
    <div class="relative bg-white rounded-lg shadow-xl w-full max-w-4xl
                overflow-hidden flex flex-col md:flex-row my-4 max-h-[90vh]">
        <!-- close icon -->
        <button @click="close" class="absolute top-3 right-6  text-gray-500 hover:text-gray-700">
            ✕
        </button>


        <!-- product pane -->
        <div class="md:w-5/12 p-6 flex flex-col items-center">
            <img :src="productImg" alt="" class="md:w-full w-50 object-contain mb-6">
            <h2 class="md:text-lg text-lg font-semibold text-center" x-text="productName"></h2>
            <p class="mt-2 text-sm text-gray-500 text-center">
                *In‑store prices may vary*
            </p>
        </div>

        <!-- map & list pane -->
        <div class="md:w-7/12 border-t md:border-t-0 md:border-l border-gray-200 flex flex-col overflow-hidden">


            <!-- tabs -->
            <div class="px-4 mb-2 flex gap-2 mt-6 text-sm">
                <button class="px-4 cursor-pointer py-2 rounded-md" :class="tab==='online' ? 'font-semibold bg-digi-orange text-white' : 'text-gray-500 bg-gray-300'"
                        @click="tab='online'">ONLINE</button>
                <button class="px-4 cursor-pointer py-2 rounded-md" :class="tab==='instore' ? 'font-semibold bg-digi-orange text-white' : 'text-gray-500 bg-gray-300'"
                        @click="tab='instore'">IN&nbsp;STORE</button>
            </div>

            <div class="p-6 overflow-y-auto flex-1">
                <!-- Online Store Tab -->
                <div x-show="tab === 'online'" class="space-y-4">
                    <h3 class="text-lg font-semibold mb-4">Online Retailers</h3>

                    @php
                        $onlineStores = [
                            [
                                'name' => 'Jiji Tanzania',
                                'logo' => '/img/partners/jiji-logo.jpg',
                                'url' => 'https://jiji.co.tz/ilala/home-appliances?query=' . urlencode(strtolower($productName ?? 'digi')),
                                'type' => 'online',
                            ],
                            [
                                'name' => 'Lampard Electronics',
                                'logo' => '/img/partners/lampard-electronics-logo.png',
                                'url' => 'https://www.instagram.com/lampard_electronicss/' . urlencode(strtolower($productName ?? 'digi')),
                                'type' => 'online',
                            ],
                        ]
                    @endphp
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($onlineStores as $store)
                            <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $store['logo'] }}" alt="{{ $store['name'] }}" class="w-15">
                                <div class="flex flex-col gapy-2">
                                    <h4 class="font-semibold">{{ $store['name'] }}</h4>
                                    <p class="text-sm text-gray-600">{{ $store['type'] }}</p>
                                    <a href="{{ $store['url'] }}" target="_blank" class="text-orange-600 hover:text-orange-700 text-sm font-medium">Visit Store</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- In Store Tab -->
                <div x-show="tab === 'instore'">
                    <div class="flex flex-col space-y-4">
                        <!-- Map -->
                        <div class="map-listing">
                            <h3 class="text-lg font-semibold mb-4">Store Locations</h3>
                            <div :id="'map-' + productName.replace(/\s+/g, '-').toLowerCase()" class="h-64 w-full rounded border"></div>
                        </div>

                        <!-- Store List -->
                        <div class="map-listing">
                            <h3 class="text-lg font-semibold mb-4">Nearby Stores</h3>
                            <div :id="'storeList-' + productName.replace(/\s+/g, '-').toLowerCase()" class="space-y-3 max-h-64 overflow-y-auto">
                                <!-- Store list will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                address: 'Rose Garden Road, Mikocheni',
                phone: '0768285151',
            },
            {
                name: 'DIGI Store',
                lat: -6.8147387,
                lng: 39.2879986,
                address: 'Maktaba Square, Posta',
                phone: '+25579 3333 444',
                email: 'info@digiappliances.com',
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


