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
<!-- LG-Style Product Page -->
<div class="bg-white">
    <!-- Sticky Navigation Bar -->
    <div id="product-nav" class="bg-[#f2f0ec] border-b border-gray-200 transition-all duration-300">
        <div class="md:max-w-7xl overflow-x-scroll lg:overflow-auto mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Product Navigation Tabs -->
                <div class="flex justify-between items-center space-x-8">
                    <a href="#features" class="nav-tab font-medium text-red-600 border-b-2 border-red-600 pb-2" data-section="features">Features</a>
                    <a href="#gallery" class="nav-tab font-medium text-black border-b-2 border-red-600 hover:text-red-600 pb-2" data-section="gallery">Gallery</a>
                    <a href="#specs" class="nav-tab font-medium text-black border-b-2 border-red-600 hover:text-red-600 pb-2" data-section="specs">Specs</a>
                    <a href="#reviews" class="nav-tab font-medium text-black border-b-2 border-red-600 hover:text-red-600 pb-2" data-section="reviews">Reviews</a>
                    <a href="#where-to-buy" class="nav-tab font-medium text-black border-b-2 border-red-600 hover:text-red-600 pb-2" data-section="where-to-buy">Where to Buy</a>
                    <a href="#support" class="nav-tab font-medium text-black border-b-2 border-red-600 hover:text-red-600 pb-2" data-section="support">Support</a>
                </div>

                <button onclick="openBuyModal('{{ addslashes($product->name) }}', '{{ asset('img/' . $product->image) }}', '{{ $product->slug }}')"
                        class="bg-red-600 hover:bg-red-700 text-white px-5 hidden md:block py-3 rounded-full text-md font-medium transition-colors">
                    Where to Buy
                </button>
            </div>
        </div>
    </div>

    <!-- Main Product Section -->
    <section id="features" class="py-12 border-b">
        <div class="max-w-7xl mx-auto px-4 py-8">
            @php
                $imagesArr = [];
                if (is_array($product->product_images)) {
                    $imagesArr = $product->product_images;
                } else {
                    $decoded = json_decode($product->product_images ?? '[]', true);
                    $imagesArr = is_array($decoded) ? $decoded : [];
                }

                // Filter out non-existent images
                $filteredImagesArr = array_filter($imagesArr, function($img) {
                    return !empty($img) && file_exists(public_path('img/' . $img));
                });

                $gallery = collect([$product->image])
                    ->merge($filteredImagesArr)
                    ->filter(fn($img) => !empty($img) && file_exists(public_path('img/' . $img)))
                    ->unique()
                    ->values();
            @endphp

            <!-- Product Title and Pricing Header -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-4">
                    <div class="flex-1">
                        <h1 id="product-name" class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                        <div class="flex items-center space-x-4 text-md text-gray-600">
                            <div x-data="{ copyText: '{{ $product->serial }}', copied: false }" class="flex items-center gap-2">
                                <span class="text-md text-gray-400 font-medium">{{ $product->serial }}</span>
                                <svg @click="navigator.clipboard.writeText(copyText); copied = true; setTimeout(() => copied = false, 2000)"
                                    class="w-6 h-6 text-gray-400 cursor-pointer hover:text-gray-600 transition"
                                    fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <title x-show="!copied">Copy</title>
                                    <title x-show="copied">Copied!</title>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                </svg>
                                <span x-show="copied" class="text-green-500 text-xs font-medium">Copied!</span>
                            </div>
                            <span class="flex items-center">
                                <img src="{{ asset('img/icons/ico-chat-red-72-72-2.gif') }}" width="20" class="mr-1" alt="">
                                <a href="https://wa.me/255793333444" target="_blank" class="text-red-600 hover:underline">Chat with an expert</a>
                            </span>
                        </div>
                        @if(isset($activePromotion) && $activePromotion)
                            <div class="mt-2 inline-flex items-center bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                <i class="bi bi-tag-fill mr-2"></i>
                                On Offer: {{ $activePromotion->name }}
                            </div>
                        @endif
                    </div>

                    <!-- Price Section -->
                    <div class="mt-4 lg:mt-0 text-right">
                        @if($product->price)
                            <div class="text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</div>
                            <div class="text-sm text-gray-500">MRP (Incl. of taxes)</div>
                            <div class="text-sm text-green-600 font-medium">Save ₹6609</div>
                        @endif
                    </div>
                </div>

                <!-- Rating and Reviews -->
                <div class="flex items-center space-x-4">
                    @include('shopping.sections.rating', ['rating' => $product->rating])
                    <span class="text-sm text-gray-600">20 Reviews</span>
                    <span class="text-sm text-gray-400">5 out of 5 (100%) customers recommend this product</span>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left Column - Product Images -->
                <div class="order-2 lg:order-1">
                    <!-- Main Image -->
                    <div class="bg-gray-50 rounded-lg overflow-hidden flex items-center justify-center mb-6 aspect-square">
                        <img id="mainImage" src="{{ asset('img/' . $gallery[0]) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-contain transition-all duration-300" />
                    </div>

                    <!-- Thumbnail Gallery -->
                    <div class="flex space-x-3 overflow-x-auto pb-2">
                        @foreach($gallery as $index => $img)
                            <div class="flex-shrink-0">
                                <img
                                    onclick="document.getElementById('mainImage').src = '{{ asset('img/' . $img) }}'"
                                    src="{{ asset('img/' . $img) }}"
                                    class="w-16 h-16 object-cover rounded-lg border-3 border-transparent hover:border-red-600 bg-gray-100 cursor-pointer transition-all duration-200 {{ $index === 0 ? 'border-red-600' : '' }}"
                                    alt="{{ $product->name }} thumbnail" />
                            </div>
                        @endforeach
                    </div>


                </div>





                <!-- Right Column - Product Details -->
                <div class="order-1 lg:order-2">
                    <!-- Key Features Section -->
                    <div class="mb-8" x-data="{ showAllFeatures: false }">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Key Features</h2>

                        @php
                            if (is_array($product->features)) {
                                $features = $product->features;
                            } else {
                                $decodedFeatures = json_decode($product->features ?? '[]', true);
                                $features = is_array($decodedFeatures) ? $decodedFeatures : [];
                            }
                            $initialFeatures = array_slice($features, 0, 3);
                            $remainingFeatures = array_slice($features, 3);
                        @endphp

                        @if(count($features) > 0)
                            <div class="space-y-3">
                                <!-- Initial Features (always visible) -->
                                @foreach($initialFeatures as $feature)
                                    <div class="flex items-start space-x-3">
                                        <div class="w-2 h-2 bg-red-600 rounded-full mt-2 flex-shrink-0"></div>
                                        <span class="text-gray-700 text-sm">{{ $feature }}</span>
                                    </div>
                                @endforeach

                                <!-- Additional Features (show/hide) -->
                                @if(count($remainingFeatures) > 0)
                                    <div x-show="showAllFeatures" x-transition class="space-y-3">
                                        @foreach($remainingFeatures as $feature)
                                            <div class="flex items-start space-x-3">
                                                <div class="w-2 h-2 bg-red-600 rounded-full mt-2 flex-shrink-0"></div>
                                                <span class="text-gray-700 text-sm">{{ $feature }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- View More/Less Button -->
                            @if(count($remainingFeatures) > 0)
                                <button @click="showAllFeatures = !showAllFeatures" class="mt-4 text-sm text-red-600 hover:underline font-medium">
                                    <span x-text="showAllFeatures ? 'Show Less' : 'View More ({{ count($remainingFeatures) }} more)'"></span>
                                    <svg class="w-4 h-4 inline ml-1 transition-transform" :class="showAllFeatures ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            @endif
                        @else
                            <p class="text-gray-500 text-sm">No features available</p>
                        @endif
                    </div>

                    <!-- Specifications Preview -->
                    <div class="mb-8 p-6 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Specifications</h3>

                        @php
                            if (is_array($product->specifications)) {
                                $specifications = $product->specifications;
                            } else {
                                $decodedSpecs = json_decode($product->specifications ?? '{}', true);
                                $specifications = is_array($decodedSpecs) ? $decodedSpecs : [];
                            }
                        @endphp

                        @if(count($specifications) > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                @php $count = 0; @endphp
                                @foreach($specifications as $key => $value)
                                    @if($count < 4)
                                        <div>
                                            <span class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                            <div class="font-medium">{{ $value }}</div>
                                        </div>
                                        @php $count++; @endphp
                                    @endif
                                @endforeach
                            </div>
                            @if(count($specifications) > 4)
                                <button class="mt-4 text-sm text-red-600 hover:underline font-medium"><a href="#specs"> View All Specs ({{ count($specifications) }} total)</a></button>
                            @endif
                        @else
                            <!-- Default specifications if none provided -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600">Brand</span>
                                    <div class="font-medium">DIGI</div>
                                </div>
                                <div>
                                    <span class="text-gray-600">Model</span>
                                    <div class="font-medium">{{ $product->sku ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <button class="mt-4 text-sm text-red-600 hover:underline font-medium"><a href="#specs"> View All Specs</a></button>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <!-- Primary Actions -->
                        <div class="flex space-x-3">
                            <a href="#" id="wa-btn-2" target="_blank"
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white text-center py-3 px-6 rounded-full font-medium transition-colors">
                                Contact Sales
                            </a>
                            <button id="wishlist-icon-{{ $product->id }}" onclick="addToWishlist('{{ $product->id }}', '{{ $product->name }}', '{{ $product->image }}', '{{ $product->slug }}')"
                                class="text-gray-500 text-3xl cursor-pointer hover:text-orange-500">
                                <i class=""></i>
                            </button>
                        </div>

                        <div class="flex gap-2">
                            <!-- Secondary Action -->
                        <button onclick="openBuyModal('{{ addslashes($product->name) }}', '{{ asset('img/' . $product->image) }}', '{{ $product->slug }}')"
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-3 px-6 rounded-full font-medium transition-colors">
                            Where to Buy
                        </button>

                        <!-- Share Button -->
                        <button onclick="shareProduct()" class="w-full border border-gray-300 hover:border-red-600 text-gray-700 hover:text-red-600 py-3 px-6 rounded-full font-medium transition-colors">
                            <i class="bi bi-share mr-3"></i>Share Product
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Sections -->
    <div class="w-full bg-black mx-auto px-4">


        <!-- Gallery Section -->
        <section id="gallery" class="py-12 border-b">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white mb-4">Product Gallery</h2>
                {{-- <p class="text-gray-600">Explore {{ $product->name }} from every angle</p> --}}
            </div>

            <div class="w-full md:max-w-7xl mx-auto flex flex-col gap-6 overflow-x-auto pb-4">
                @php
                    if (is_array($product->product_galleries)) {
                        $galleries = $product->product_galleries;
                    } else {
                        $decodedGalleries = json_decode($product->product_galleries ?? '{}', true);
                        $galleries = is_array($decodedGalleries) ? $decodedGalleries : [];
                    }
                @endphp

                @if(count($galleries) > 0)
                    @foreach($galleries as $caption => $img)
                        @if(!empty($img) && file_exists(public_path('img/' . $img)))
                            <div class="overflow-hidden cursor-pointer">
                                @if(!empty($caption))
                                    <div class="p-6 text-center w-full  md:max-w-7xl mx-auto">
                                        <h1 class=" text-3xl font-medium text-white">{{ $caption }}</h1>
                                    </div>
                                @endif
                                <img src="{{ asset('img/' . $img) }}" alt="{{ $caption }}" class="w-screen h-[30rem] object-cover rounded-2xl" />
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-gray-500 text-center w-full">No gallery images available.</p>
                @endif
            </div>
        </section>
    </div>

    <div class="w-full mx-auto px-4">
        <!-- Specifications Section -->
        <section id="specs" class="py-12 w-full  md:max-w-7xl mx-auto border-b">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Technical Specifications</h2>
                <p class="text-gray-600 lg:w-4xl">Detailed technical information about {{ $product->name }}</p>
            </div>

            @php
                if (is_array($product->specifications)) {
                    $specifications = $product->specifications;
                } else {
                    $decodedSpecs = json_decode($product->specifications ?? '{}', true);
                    $specifications = is_array($decodedSpecs) ? $decodedSpecs : [];
                }
            @endphp

            @if(count($specifications) > 0)
                <div class="bg-gray-50 rounded-lg p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($specifications as $key => $value)
                            <div class="flex justify-between items-center py-3 border-b border-gray-200 last:border-b-0">
                                <span class="font-medium text-gray-700">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                <span class="text-gray-900 font-semibold">{{ is_bool($value) ? ($value ? 'Yes' : 'No') : $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="font-medium text-gray-700">Brand</span>
                            <span class="text-gray-900 font-semibold">DIGI</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="font-medium text-gray-700">Model</span>
                            <span class="text-gray-900 font-semibold">{{ $product->sku ?? $product->serial ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="font-medium text-gray-700">Warranty</span>
                            <span class="text-gray-900 font-semibold">2 Years</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="font-medium text-gray-700">Category</span>
                            <span class="text-gray-900 font-semibold">{{ $category->name ?? 'Home Appliance' }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        <!-- Reviews Section -->
        {{-- <section id="reviews" class="py-12 border-b">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Customer Reviews</h2>
                <p class="text-gray-600">See what our customers say about {{ $product->name }}</p>
            </div>

            <!-- Review Summary -->
            <div class="bg-gray-50 rounded-lg p-8 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-gray-900 mb-2">4.8</div>
                        <div class="flex justify-center mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill text-yellow-400 text-lg"></i>
                            @endfor
                        </div>
                        <p class="text-gray-600">Based on 127 reviews</p>
                    </div>

                    <div class="md:col-span-2">
                        <div class="space-y-2">
                            @for($i = 5; $i >= 1; $i--)
                                <div class="flex items-center space-x-3">
                                    <span class="text-sm font-medium text-gray-700 w-8">{{ $i }} star</span>
                                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $i == 5 ? '75%' : ($i == 4 ? '20%' : '5%') }}"></div>
                                    </div>
                                    <span class="text-sm text-gray-600 w-8">{{ $i == 5 ? '95' : ($i == 4 ? '25' : '7') }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <!-- Individual Reviews -->
            <div class="space-y-6">
                <!-- Sample Review 1 -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h4 class="font-semibold text-gray-900">John D.</h4>
                            <div class="flex items-center mt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star-fill text-yellow-400 text-sm"></i>
                                @endfor
                                <span class="ml-2 text-sm text-gray-600">Verified Purchase</span>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">2 weeks ago</span>
                    </div>
                    <p class="text-gray-700">"Excellent product! The quality is outstanding and it works exactly as described. Highly recommend this to anyone looking for a reliable appliance."</p>
                </div>

                <!-- Sample Review 2 -->
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h4 class="font-semibold text-gray-900">Sarah M.</h4>
                            <div class="flex items-center mt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star-fill text-yellow-400 text-sm"></i>
                                @endfor
                                <span class="ml-2 text-sm text-gray-600">Verified Purchase</span>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">1 month ago</span>
                    </div>
                    <p class="text-gray-700">"Great value for money. The design is sleek and modern, fits perfectly in my home. Customer service was also very helpful during the purchase process."</p>
                </div>

                <!-- Write Review Button -->
                <div class="text-center pt-6">
                    <button class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-full font-medium transition-colors">
                        Write a Review
                    </button>
                </div>
            </div>
        </section> --}}

        <!-- Where to Buy Section -->
        <section id="where-to-buy" class="py-12 w-full  md:max-w-7xl mx-auto border-b">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Where to Buy</h2>
                <p class="text-gray-600">Find {{ $product->name }} at these authorized retailers</p>
            </div>

            <!-- Banner Section -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-3xl p-3 overflow-hidden mb-8">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-center p-8">
                    <div class="text-white col-span-3">
                        <h3 class="text-5xl font-medium mb-6">Find a Dealer Near You</h3>
                        <button onclick="openBuyModal('{{ addslashes($product->name) }}', '{{ asset('img/' . $product->image) }}', '{{ $product->slug }}')" class="bg-white/20 cursor-pointer h-18 w-18 flex items-center group border-2 border-white justify-center rounded-full">
                            <img src="{{ asset('img/arrow.svg') }}" width="25" class="group-hover:translate-x-[5px] transition-transform duration-300" alt="">
                        </button>
                    </div>
                    <div class="flex justify-end col-span-2">
                        <img src="{{ asset('img/icons/banner-light-icons.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Related Products Section -->
    <div class="bg-gray-50 border-t">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">You might also like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
    document.addEventListener('DOMContentLoaded', () => {
    // Track product view
    trackProductView({
        id: @json($product->id),
        name: @json($product->name),
        slug: @json($product->slug),
        image: @json($product->image),
        price: @json($product->price)
    });

    // 1. Grab the product name
    const productName = document.getElementById('product-name')?.textContent.trim() || 'Awesome product';

    // 2. Grab the page URL (you can also use a canonical URL if you prefer)
    const productLink = window.location.href;

    // Promotion context from server (if any)
    const promoName = @json(optional($activePromotion)->name);

    // 3. Compose the WhatsApp message, include promo name when applicable
    const offerText = promoName ? ` It’s under promotion: *${promoName}*.` : '';
    const message = `Hello 👋, I'm interested in *${productName}*.${offerText}\n${productLink}`;

    // 4. Encode the message for a URL
    const encodedMsg = encodeURIComponent(message);

    // 5. Build the full WhatsApp link
    const waNumber = '255793333444';
    const waUrl = `https://wa.me/${waNumber}?text=${encodedMsg}`;

    // 6. Inject into the button (check if elements exist first)
    const waBtn = document.getElementById('wa-btn');
    const waBtn2 = document.getElementById('wa-btn-2');

    if (waBtn) waBtn.setAttribute('href', waUrl);
    if (waBtn2) waBtn2.setAttribute('href', waUrl);

    // Sticky Navigation and Smooth Scrolling
    const navbar = document.getElementById('product-nav');
    const navLinks = document.querySelectorAll('[data-section]');
    const mainNavbar = document.querySelector('header'); // Main navigation header

    // Get the initial position of the product navbar
    let navbarInitialOffset = navbar.offsetTop;

    // Sticky navigation
    function handleScroll() {
        const scrollY = window.pageYOffset;
        const mainNavHeight = mainNavbar ? mainNavbar.offsetHeight : 136; // Height of main navigation (includes top bar)

        // Check if main navbar is sticky (scrolled past 80px)
        const isMainNavSticky = scrollY > 80;
        const stickyMainNavHeight = isMainNavSticky ? 68 : mainNavHeight; // Main nav height when sticky vs normal

        // Make product navbar sticky when we scroll past its initial position
        if (scrollY >= navbarInitialOffset) {
            navbar.classList.add('fixed', 'left-0', 'right-0', 'z-40');
            navbar.classList.remove('relative');
            navbar.style.top = stickyMainNavHeight + 'px'; // Position below main nav
            navbar.style.backgroundColor = '#f2f0ec'; // Ensure solid white background
            navbar.style.borderBottom = '1px solid #e5e7eb'; // Add border

            // Add padding to prevent content jump
            navbar.parentElement.style.paddingTop = navbar.offsetHeight + 'px';
        } else {
            navbar.classList.remove('fixed', 'left-0', 'right-0', 'z-40', 'shadow-lg');
            navbar.classList.add('relative');
            navbar.style.top = 'auto';
            navbar.style.backgroundColor = ''; // Reset background
            navbar.style.borderBottom = ''; // Reset border

            // Remove padding
            navbar.parentElement.style.paddingTop = '0';
        }

        // Update active section
        updateActiveSection();
    }

    // Update active section based on scroll position
    function updateActiveSection() {
        const sections = document.querySelectorAll('section[id]');
        let currentSection = '';

        const scrollY = window.pageYOffset;
        const isMainNavSticky = scrollY > 80;
        const mainNavHeight = isMainNavSticky ? 68 : (mainNavbar ? mainNavbar.offsetHeight : 136);
        const productNavHeight = navbar.offsetHeight;
        const totalNavHeight = mainNavHeight + productNavHeight + 50; // Extra buffer

        sections.forEach(section => {
            const sectionTop = section.offsetTop - totalNavHeight;
            const sectionHeight = section.offsetHeight;

            if (window.pageYOffset >= sectionTop && window.pageYOffset < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });

        // Update active nav link
        navLinks.forEach(link => {
            const targetSection = link.getAttribute('data-section');
            if (targetSection === currentSection) {
                link.classList.add('text-red-600', 'border-red-600');
                link.classList.remove('text-gray-600', 'border-transparent');
            } else {
                link.classList.remove('text-red-600', 'border-red-600');
                link.classList.add('text-gray-600', 'border-transparent');
            }
        });
    }

    // Smooth scrolling for navigation links
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetSection = this.getAttribute('data-section');
            const targetElement = document.getElementById(targetSection);

            if (targetElement) {
                const scrollY = window.pageYOffset;
                const isMainNavSticky = scrollY > 80;
                const mainNavHeight = isMainNavSticky ? 68 : (mainNavbar ? mainNavbar.offsetHeight : 136);
                const productNavHeight = navbar.offsetHeight;
                const totalOffset = mainNavHeight + productNavHeight + 20; // Extra padding

                const offsetTop = targetElement.offsetTop - totalOffset;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Attach scroll event listener
    window.addEventListener('scroll', handleScroll);

    // Handle window resize to recalculate navbar position
    window.addEventListener('resize', function() {
        navbarInitialOffset = navbar.offsetTop;
        handleScroll();
    });

    // Initial call to set correct state
    handleScroll();
    });

    // Image modal functionality
    function openImageModal(imageSrc, imageAlt) {
        // Create modal overlay
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4';
        modal.onclick = function() { document.body.removeChild(modal); };

        // Create image container
        const imageContainer = document.createElement('div');
        imageContainer.className = 'relative max-w-4xl max-h-full';
        imageContainer.onclick = function(e) { e.stopPropagation(); };

        // Create image
        const image = document.createElement('img');
        image.src = imageSrc;
        image.alt = imageAlt;
        image.className = 'w-full h-full object-contain';

        // Create close button
        const closeButton = document.createElement('button');
        closeButton.innerHTML = '&times;';
        closeButton.className = 'absolute top-4 right-4 text-white text-4xl hover:text-gray-300';
        closeButton.onclick = function() { document.body.removeChild(modal); };

        imageContainer.appendChild(image);
        imageContainer.appendChild(closeButton);
        modal.appendChild(imageContainer);
        document.body.appendChild(modal);
    }

    // Function to track product views
    function trackProductView(product) {
        // Get existing recently viewed products
        let recentlyViewed = JSON.parse(localStorage.getItem('recentlyViewed') || '[]');

        // Remove the product if it already exists (to avoid duplicates)
        recentlyViewed = recentlyViewed.filter(item => item.id !== product.id);

        // Add the product to the beginning of the array with current timestamp
        recentlyViewed.unshift({
            id: product.id,
            name: product.name,
            slug: product.slug,
            image: product.image,
            price: product.price,
            viewedAt: new Date().toISOString()
        });

        // Keep only the last 50 viewed products
        recentlyViewed = recentlyViewed.slice(0, 50);

        // Save back to localStorage
        localStorage.setItem('recentlyViewed', JSON.stringify(recentlyViewed));

        // Increment view count in database
        fetch('/api/increment-view-count', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: product.id
            })
        }).catch(error => {
            console.error('Error incrementing view count:', error);
        });
    }

    // Function to share product
    function shareProduct() {
        const productName = @json($product->name);
        const productUrl = window.location.href;
        const productImage = @json(asset('img/' . $product->image));

        // Check if native share is available and user prefers it
        if (navigator.share && /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            navigator.share({
                title: productName,
                text: `Check out this amazing product: ${productName}`,
                url: productUrl
            }).catch(error => {
                console.log('Error sharing:', error);
                showShareModal(productName, productUrl, productImage);
            });
        } else {
            // Show custom share modal
            showShareModal(productName, productUrl, productImage);
        }
    }

    // Show share modal with social platforms
    function showShareModal(productName, productUrl, productImage) {
        const shareText = `Check out this amazing product: ${productName}`;
        const encodedUrl = encodeURIComponent(productUrl);
        const encodedText = encodeURIComponent(shareText);
        const encodedTitle = encodeURIComponent(productName);

        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4';
        modal.onclick = function(e) {
            if (e.target === modal) {
                document.body.removeChild(modal);
            }
        };

        const modalContent = document.createElement('div');
        modalContent.className = 'bg-white rounded-lg p-6 max-w-md w-full';
        modalContent.onclick = function(e) { e.stopPropagation(); };

        modalContent.innerHTML = `
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Share Product</h3>
                <button onclick="document.body.removeChild(this.closest('.fixed'))" class="text-gray-400 hover:text-gray-600">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <!-- WhatsApp -->
                <a href="https://wa.me/?text=${encodedText}%20${encodedUrl}" target="_blank"
                   class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mb-2">
                        <i class="bi bi-whatsapp text-white text-lg"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">WhatsApp</span>
                </a>

                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}" target="_blank"
                   class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mb-2">
                        <i class="bi bi-facebook text-white text-lg"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Facebook</span>
                </a>

                <!-- Twitter/X -->
                <a href="https://twitter.com/intent/tweet?text=${encodedText}&url=${encodedUrl}" target="_blank"
                   class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-black rounded-full flex items-center justify-center mb-2">
                        <i class="bi bi-twitter text-white text-lg"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Twitter</span>
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}" target="_blank"
                   class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center mb-2">
                        <i class="bi bi-linkedin text-white text-lg"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">LinkedIn</span>
                </a>

                <!-- Telegram -->
                <a href="https://t.me/share/url?url=${encodedUrl}&text=${encodedText}" target="_blank"
                   class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mb-2">
                        <i class="bi bi-telegram text-white text-lg"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Telegram</span>
                </a>

                <!-- Copy Link -->
                <button onclick="copyToClipboard('${productUrl}')"
                        class="flex flex-col items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center mb-2">
                        <i class="bi bi-link-45deg text-white text-lg"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Copy Link</span>
                </button>
            </div>

            <div class="text-center">
                <button onclick="document.body.removeChild(this.closest('.fixed'))"
                        class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full font-medium transition-colors">
                    Done Sharing
                </button>
            </div>
        `;

        modal.appendChild(modalContent);
        document.body.appendChild(modal);
    }

    // Copy to clipboard function
    function copyToClipboard(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                // Show success message
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg z-50';
                toast.textContent = 'Link copied to clipboard!';
                document.body.appendChild(toast);

                setTimeout(() => {
                    if (document.body.contains(toast)) {
                        document.body.removeChild(toast);
                    }
                }, 3000);

                // Close modal
                const modal = document.querySelector('.fixed.inset-0.bg-black');
                if (modal) {
                    document.body.removeChild(modal);
                }
            }).catch(() => {
                prompt('Copy this link:', text);
            });
        } else {
            prompt('Copy this link:', text);
        }
    }
</script>

{{-- @include('layouts.partials.whereToBuy-modal') --}}
