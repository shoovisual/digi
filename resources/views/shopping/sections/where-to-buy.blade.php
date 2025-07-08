<div
    x-data="whereToBuyModal({
        googleKey : '{{ config('services.google.places_key') }}',
        mapboxKey : '{{ config('services.mapbox.key') }}'
    })"
    x-show="isOpen"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm"
>
    <!-- outer click closes -->
    <div @click.self="close" class="absolute inset-0"></div>

    <!-- modal -->
    <div class="relative bg-white rounded-lg shadow-xl w-[90vw] max-w-4xl
                overflow-hidden flex flex-col md:flex-row">
        <!-- close icon -->
        <button @click="close"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
            ✕
        </button>

        <!-- product pane -->
        <div class="md:w-5/12 p-6 flex flex-col items-center">
            <img :src="productImg" alt="" class="w-full object-contain mb-6">
            <h2 class="text-lg font-semibold text-center" x-text="productName"></h2>
            <p class="mt-2 text-sm text-gray-500 text-center">
                *In‑store prices may vary*
            </p>
        </div>

        <!-- map & list pane -->
        <div class="md:w-7/12 border-t md:border-t-0 md:border-l
                    border-gray-200 flex flex-col">
            <!-- location search bar -->
            <div class="p-4">
                <input x-model="query"
                       @keydown.enter.prevent="search()"
                       type="text"
                       placeholder="Enter suburb or city"
                       class="w-full border rounded px-3 py-2 text-sm focus:outline-none">
            </div>

            <!-- tabs -->
            <div class="px-4 mb-2 flex gap-4 text-sm">
                <button :class="tab==='online' ? 'font-semibold' : 'text-gray-500'"
                        @click="tab='online'">ONLINE</button>
                <button :class="tab==='instore' ? 'font-semibold' : 'text-gray-500'"
                        @click="tab='instore'">IN&nbsp;STORE</button>
            </div>

            <!-- map -->
            <div id="where-map" class="h-56 md:h-64 w-full"></div>

            <!-- store list -->
            <div class="flex-1 overflow-y-auto">
                <template x-if="places.length === 0">
                    <p class="p-4 text-sm text-gray-500">No stores found nearby.</p>
                </template>
                <template x-for="place in places" :key="place.place_id">
                    <div class="border-t p-4 flex items-start gap-3">
                        <div class="shrink-0 w-8">
                            <img :src="logoFor(place)" class="w-full">
                        </div>
                        <div class="text-sm">
                            <h3 class="font-semibold" x-text="place.name"></h3>
                            <p class="text-gray-600" x-text="place.phone"></p>
                            <p class="text-gray-600" x-text="place.vicinity"></p>
                            <template x-if="place.formatted_phone_number">
                                <a class="text-blue-600 hover:underline"
                                   :href="`tel:${place.formatted_phone_number}`"
                                   x-text="place.formatted_phone_number"></a>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
