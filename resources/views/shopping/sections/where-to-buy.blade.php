<div
    x-data="whereToBuyModal({
        googleKey : '{{ config('services.google.places_key') }}',
        mapboxKey : '{{ config('services.mapbox.key') }}'
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
            <div class="px-4 mb-2 flex gap-4 mt-6 text-sm">
                <button :class="tab==='online' ? 'font-semibold' : 'text-gray-500'"
                        @click="tab='online'">ONLINE</button>
                <button :class="tab==='instore' ? 'font-semibold' : 'text-gray-500'"
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
                    <div  class="flex flex-col lg:flex-row gap-6">
                        <!-- Map -->
                        <div class="lg:w-1/2">
                            <h3 class="text-lg font-semibold mb-4">Store Locations</h3>
                            <div :id="'map-' + productName.replace(/\s+/g, '-').toLowerCase()" class="h-64 w-full rounded border"></div>
                        </div>

                        <!-- Store List -->
                        <div class="lg:w-1/2">
                            <h3 class="text-lg font-semibold mb-4">Nearby Stores</h3>
                            <div :id="'storeList-' + productName.replace(/\s+/g, '-').toLowerCase()" class="space-y-3 max-h-64 overflow-y-auto">
                                <template x-for="store in places" :key="store.name">
                                    <div class="border rounded-lg p-4">
                                        <h4 class="font-semibold" x-text="store.name"></h4>
                                        <p class="text-sm text-gray-600" x-text="store.address"></p>
                                        <p class="text-sm text-gray-600">Phone: <span x-text="store.phone"></span></p>
                                        <p class="text-sm text-gray-600" x-show="store.email">Email: <span x-text="store.email"></span></p>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
