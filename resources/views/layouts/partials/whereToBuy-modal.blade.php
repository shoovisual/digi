<!-- Alpine.js Where to Buy Modal -->
<div x-data="whereToBuyModal()" x-show="isOpen" x-cloak
     class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4"
     @keydown.escape="close()" @click.self="close()">

    <div class="bg-white rounded-xl overflow-hidden w-full max-w-4xl shadow-xl">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-semibold text-gray-800">Where to Buy</h2>
            <button @click="close()" class="text-gray-400 hover:text-gray-600 text-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Product Info -->
        <div class="p-6 bg-gray-50">
            <div class="flex items-center space-x-4">
                {{-- <img :src="productImg" :alt="productName" class="w-40 object-cover rounded"> --}}
                <img src="{{ asset('img/products/washing-machine/wm-8.png') }}" class="w-40 object-cover rounded" alt="">
                <div>
                    <h3 class="text-xl font-semibold" x-text="productName"></h3>
                    <h3 class="text-xl font-semibold" >DIGI Washing Machine 8kg – Twin Tub, High-Efficiency Motor, Durable Body, Elegant White, 2Y Warranty (2025)</h3>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="border-b">
            <nav class="flex space-x-8 px-6">
                <button @click="tab = 'online'"
                        :class="tab === 'online' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-2 px-1 border-b-2 font-medium text-sm">
                    Online Store
                </button>
                <button @click="tab = 'instore'"
                        :class="tab === 'instore' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-2 px-1 border-b-2 font-medium text-sm">
                    In Store
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
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
                        ]
                    ]
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
            <div x-show="tab === 'instore'" class="flex flex-col lg:flex-row gap-6">
                <!-- Map -->
                <div class="lg:w-1/2">
                    <h3 class="text-lg font-semibold mb-4">Store Locations</h3>
                    <div :id="'map-' + productName.replace(/\s+/g, '-').toLowerCase()" class="h-64 w-full rounded border"></div>
                </div>

                <!-- Store List -->
                <div class="lg:w-1/2">
                    <h3 class="text-lg font-semibold mb-4">Nearby Stores</h3>
                    <div :id="'storeList-' + productName.replace(/\s+/g, '-').toLowerCase()" class="space-y-3">
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
        <div class="modal-footer p-6">
            <p class="text-gray-600">*In-store and other retailers' prices will vary.</p>
        </div>
    </div>
</div>

<script>
// Simple function to trigger the Alpine.js modal
function openBuyModal(name, image, slug) {
    // Dispatch event for Alpine.js component
    window.dispatchEvent(new CustomEvent('openBuyModalEvent', {
        detail: { name, image, slug }
    }));
}
</script>
