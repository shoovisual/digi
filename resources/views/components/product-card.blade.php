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

        <h2 class="text-2xl font-regular text-black leading-snug" title="{{ $product->name }}">{{ Str::limit($product->name, 50) }}</h2>
        <p class="text-sm font-medium text-gray-500 mt-1">{{ $product->product_short }}</p>

        <!-- IMAGE CAROUSEL -->
        <div x-data="{ activeImage: 0 }" class="relative w-full group h-48 overflow-hidden transition cursor-pointer duration-300 my-4 rounded-lg bg-white">
            @if(count($images) > 0)
                <template x-for="(img, index) in {{ json_encode($images) }}" :key="index">
                    <img x-show="activeImage === index" :src="'/img/' + img" :alt="'{{ $product->name }} - Image ' + (index + 1)"
                        class="absolute top-0 left-0 w-full group-hover:scale-110 h-full object-contain transition duration-300 ease-in-out">
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
            <div class="flex gap-2 md:text-[16px] text-[14px]">
                @if(isset($product) && !empty($product->slug))
                    <a href="{{ route('products.show', $product->slug) }}" class="px-4 py-2 border border-gray-300 rounded-full text-black hover:bg-gray-100">
                        View Product
                    </a>
                @else
                    <span class="px-4 py-2 border border-gray-300 rounded-full text-gray-400 cursor-not-allowed">
                        View Product
                    </span>
                @endif
                <button
                    onclick="openBuyModal(
                        '{{ addslashes($product->name) }}',
                        '{{ asset('img/' . $product->image) }}',
                        '{{ $product->slug }}'
                    )"
                    class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full text-[16px]">
                    Where to Buy
                </button>
            </div>

            <button id="wishlist-icon-{{ $product->id }}" onclick="addToWishlist('{{ $product->id }}', '{{ $product->name }}', '{{ $product->image }}', '{{ $product->slug }}')"
                class="text-gray-500 text-3xl cursor-pointer hover:text-orange-500">
                <i class=""></i>
            </button>
        </div>
    </div>
</div>
