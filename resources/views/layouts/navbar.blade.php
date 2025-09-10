<header class="border-b border-[#EDEDED]" x-data="{ mobileMenuOpen: false }">

  <!-- Main nav -->
  <div x-data="{ stuck: false }"
    x-init="window.addEventListener('scroll', () => {
            stuck = window.scrollY > 80
        })" :class="stuck
            ? 'fixed top-0 inset-x-0 bg-[#F2F0EC]/90 border-b border-[#C7C7C7] backdrop-blur transition py-4' : 'py-6'"
            class="bg-[#F2F0EC] flex items-center border-b border-[#C7C7C7] justify-between px-4 md:px-6 transition-all duration-300 z-50" >
        <!-- Logo -->
        <div class="flex items-center space-x-2">
        <a href="/"><img src="{{ asset('img/digi-logo.svg') }}" alt="DIGI Logo" class="h-8 w-auto" /></a>
        </div>

        <!-- Desktop menu -->
        <nav class="transition-all duration-300 hidden lg:flex items-center text-black space-x-6 text-lg font-[400]" >

            <a href="/"
            @class([ 'rounded-sm hover:text-digi-orange px-6 py-2', 'hover:text-white text-white bg-digi-orange' => request()->is('/')
            ])>
                Home
            </a>

            <a href="{{ route('about-digi.index') }}"
            @class([ 'rounded-sm hover:text-digi-orange px-6 py-2', 'hover:text-white text-white bg-digi-orange' => request()->is('about-digi')
            ])>
                What is DIGI
            </a>

            <div x-data="{ megaMenuOpen: false, closeTimeout: null }" class="relative" @mouseenter="clearTimeout(closeTimeout); megaMenuOpen = true" @mouseleave="closeTimeout = setTimeout(() => megaMenuOpen = false, 100)">
                <a href="{{ route('products.index') }}"
                @class(['rounded-sm hover:text-digi-orange px-6 py-2', 'hover:text-white text-white bg-digi-orange' => request()->routeIs('products.*', 'categories.*')
                ])>
                    Our Products
                </a>

                <!-- Mega Menu -->
                <div x-show="megaMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200" class="fixed -top-0 left-0 w-screen h-screen bg-black/40 backdrop-blur-sm z-50" :class=" stuck ? 'fixed top-0 mt-[68px] transition': 'mt-[90px]'" ">
                    <div class="w-full border border-gray-400">
                        <div class="bg-[#F2F0EC] p-6 nav-focus" megaMenuOpen = true" @mouseleave="megaMenuOpen = false">
                            <div class="grid grid-cols-4 gap-4 max-w-7xl mx-auto text-sm">
                                <!-- TVs Column -->
                                <div class="flex flex-col gap-y-2 font-semibold">
                                    <a href="{{ route('recently-viewed.index') }}" class="mega-menu-link">Recently Viewed</a>
                                    <a href="{{ route('most-popular.index') }}" class="mega-menu-link">Most Popular</a>
                                    <a href="{{ route('new-arrivals.index') }}" class="mega-menu-link">New Arrivals</a>
                                    <a href="#" class="mega-menu-link">Big Deals</a>
                                </div>

                                <!-- Refrigerators Column -->
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-title">Kitchen Appliances</h3>
                                    <a href="{{ url('/categories/digi-gas-cookers') }}" class="mega-menu-link">DIGI Gas Cookers</a>
                                    <a href="{{ url('/categories/digi-refrigerators') }}" class="mega-menu-link">DIGI Fridges</a>
                                    <a href="{{ url('/categories/digi-freezers') }}" class="mega-menu-link">DIGI Freezers</a>
                                </div>

                                <!-- Freezers Column -->
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-title">General Appliances</h3>
                                    <a href="{{ url('/categories/digi-tvs') }}" class="mega-menu-link">DIGI TVs</a>
                                    <a href="{{ url('/categories/digi-acs') }}" class="mega-menu-link">DIGI Air Conditioners</a>
                                    <a href="{{ url('/categories/digi-washing-machine') }}" class="mega-menu-link">Washing Machines</a>
                                </div>

                            </div>
                            @php
                                $featuredProducts = [
                                    [
                                        'name' => 'DIGI Washing Machine',
                                        'url' => '/categories/digi-washing-machine',
                                        'image' => asset('img/digi-washing-machine-featured.jpg')
                                    ],
                                    [
                                        'name' => 'DIGI TV',
                                        'url' => '/categories/digi-tvs',
                                        'image' => asset('img/products/tvs/tv-featured.jpg')
                                    ],
                                    [
                                        'name' => 'DIGI Fridge',
                                        'url' => '/categories/digi-refrigerators',
                                        'image' => asset('img/digi-fridge-featured.jpg')
                                    ]
                                ]
                            @endphp
                            <div class="max-w-7xl mx-auto mt-4 grid grid-cols-4 pb-8 py-3 gap-4">
                                <!-- Featured Product Image -->
                                <div></div>
                                @foreach ($featuredProducts as $product)
                                    <a href="{{ $product['url'] }}" class="flex group relative flex-col">
                                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }} image" class="w-full h-40 rounded-2xl object-cover">
                                        <span class="absolute top-2 left-5 mt-2 text-lg w-1/2 z-20">{{ $product['name'] }}</span>
                                        <div class="overlay bg-gradient-to-r from-white/50 to-transparent rounded-2xl absolute z-10 inset-0"></div>
                                        <span class="z-20 absolute bottom-2 bg-white/50 backdrop-blur-sm rounded-full w-10 h-10 flex items-center justify-center border-1 group-hover:bg-digi-orange group-hover:text-white transition-all duration-300 border-digi-orange left-5"><i class="bi bi-arrow-right text-lg"></i></span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('about') }}"
            @class(['rounded-sm hover:text-digi-orange px-6 py-2', 'hover:text-white text-white bg-digi-orange' => request()->routeIs('about')
            ])>
                About CTC DIGI‑Venture
            </a>

            {{-- <a href="#order-now"
            @class([
                'hover:text-digi-orange',
                'text-digi-orange' => request()->is('order-now')
            ])>
                Order Now
            </a> --}}

            <a href="{{ route('contact') }}"
            @class(['rounded-sm hover:text-digi-orange px-6 py-2', 'hover:text-white text-white bg-digi-orange' => request()->is('contact')
            ])>
                Contact Us
            </a>
        </nav>


    <!-- Right Side: Search & Icons -->
    <div class="flex items-center space-x-3" x-data="{
      mobileSearchOpen: false,
      searchQuery: '',
      searchResults: [],
      showResults: false,
      isLoading: false,
      searchTimeout: null,

      async searchProducts() {
        if (this.searchQuery.length < 2) {
          this.searchResults = [];
          this.showResults = false;
          return;
        }

        this.isLoading = true;

        try {
          const response = await fetch(`/api/search?q=${encodeURIComponent(this.searchQuery)}`);
          const data = await response.json();
          this.searchResults = data.products || [];
          this.showResults = true;
        } catch (error) {
          console.error('Search error:', error);
          this.searchResults = [];
        } finally {
          this.isLoading = false;
        }
      },

      handleInput() {
        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(() => {
          this.searchProducts();
        }, 300);
      },

      selectProduct(product) {
        window.location.href = `/products/${product.slug}`;
        this.mobileSearchOpen = false;
      },

      hideResults() {
        setTimeout(() => {
          this.showResults = false;
        }, 200);
      },

      openMobileSearch() {
        this.mobileSearchOpen = true;
        this.$nextTick(() => {
          this.$refs.mobileSearchInput.focus();
        });
      },

      closeMobileSearch() {
        this.mobileSearchOpen = false;
        this.searchQuery = '';
        this.searchResults = [];
        this.showResults = false;
      }
    }">
      <!-- Desktop Search bar -->
      <div class="relative hidden sm:block" @click.away="showResults = false">
        <input
          type="text"
          placeholder="Search products..."
          class="pl-8 placeholder:font-medium pr-3 py-1.5 border rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 w-64"
          x-model="searchQuery"
          @input="handleInput()"
          @focus="searchQuery.length >= 2 && searchResults.length > 0 ? showResults = true : null"
          @blur="hideResults()"
        />
        <svg class="w-4 h-4 absolute left-2.5 top-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.5 3.5a7.5 7.5 0 0013.15 13.15z" />
        </svg>

        <!-- Search Results Dropdown -->
        <div
          x-show="showResults"
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 transform scale-95"
          x-transition:enter-end="opacity-100 transform scale-100"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100 transform scale-100"
          x-transition:leave-end="opacity-0 transform scale-95"
          class="absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg z-50 max-h-96 overflow-y-auto"
          style="display: none;"
        >
          <!-- Loading State -->
          <div x-show="isLoading" class="p-4 text-center text-gray-500">
            <div class="inline-block animate-spin rounded-full h-4 w-4 border-b-2 border-orange-500"></div>
            <span class="ml-2">Searching...</span>
          </div>

          <!-- No Results -->
          <div x-show="!isLoading && searchResults.length === 0 && searchQuery.length >= 2" class="p-4 text-center text-gray-500">
            No products found for "<span x-text="searchQuery"></span>"
          </div>

          <!-- Search Results -->
          <div x-show="!isLoading && searchResults.length > 0">
            <template x-for="product in searchResults" :key="product.id">
              <div
                class="flex items-center p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0"
                @click="selectProduct(product)"
              >
                <div class="flex-shrink-0 w-12 h-12 mr-3">
                  <img
                    :src="`/img/${product.image}`"
                    :alt="product.name"
                    class="w-full h-full object-contain rounded"
                    loading="lazy"
                  >
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-sm font-medium text-gray-900 truncate" x-text="product.name"></p>
                  <p class="text-xs text-gray-500 truncate" x-text="product.product_short"></p>
                  <p class="text-xs text-orange-600" x-text="product.serial"></p>
                </div>
                <div class="flex-shrink-0">
                  <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>

      <!-- Mobile Search Icon -->
      <button @click="openMobileSearch()" class="sm:hidden focus:outline-none">
        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
      </button>

      <!-- Wishlist Icon -->
      <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
        <a href="{{ route('wishlist.index') }}" class="relative block">
          <svg class="md:w-9 w-7 text-black block" fill="none" stroke="currentColor" stroke-width="1.5"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
          </svg>
          <span  id="wishlist-count" class="absolute border-2 border-[#f2f0ec] bg-red-500 text-white text-xs rounded-full w-5 h-5 items-center justify-center hidden" style="top: -8px; right: -8px; position: absolute;">0</span>
        </a>
        <!-- Wishlist Preview Dropdown -->
        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-md shadow-lg z-10 p-4" style="display: none;">
          <h3 class="font-semibold text-lg mb-2">My Wishlist</h3>
          <div id="wishlist-preview" class="space-y-3"></div>
          <a href="{{ route('wishlist.index') }}" class="block text-center mt-4 text-digi-orange hover:underline">View All Wishlist Items</a>
        </div>
      </div>
      <!-- Hamburger -->
      <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Mobile Search Popup -->
      <div x-show="mobileSearchOpen" x-cloak x-transition class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm flex items-start justify-center pt-10">
        <div class="bg-white w-full max-w-md mx-4 rounded-lg shadow-lg" @click.away="closeMobileSearch()">
          <!-- Search Header -->
          <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold">Search Products</h3>
            <button @click="closeMobileSearch()" class="focus:outline-none">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Search Input -->
          <div class="p-4">
            <div class="relative">
              <input
                type="text"
                placeholder="Search products..."
                class="w-full pl-10 pr-4 py-3 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                x-model="searchQuery"
                @input="handleInput()"
                @focus="searchQuery.length >= 2 && searchResults.length > 0 ? showResults = true : null"
                x-ref="mobileSearchInput"
              />
              <svg class="w-5 h-5 absolute left-3 top-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.5 3.5a7.5 7.5 0 0013.15 13.15z" />
              </svg>
            </div>
          </div>

          <!-- Search Results -->
          <div class="max-h-96 overflow-y-auto">
            <!-- Loading State -->
            <div x-show="isLoading" class="p-4 text-center text-gray-500">
              <div class="inline-block animate-spin rounded-full h-4 w-4 border-b-2 border-orange-500"></div>
              <span class="ml-2">Searching...</span>
            </div>

            <!-- No Results -->
            <div x-show="!isLoading && searchResults.length === 0 && searchQuery.length >= 2" class="p-4 text-center text-gray-500">
              No products found for "<span x-text="searchQuery"></span>"
            </div>

            <!-- Search Results -->
            <div x-show="!isLoading && searchResults.length > 0">
              <template x-for="product in searchResults" :key="product.id">
                <div
                  class="flex items-center p-4 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0"
                  @click="selectProduct(product)"
                >
                  <div class="flex-shrink-0 w-12 h-12 mr-3">
                    <img
                      :src="`/img/${product.image}`"
                      :alt="product.name"
                      class="w-full h-full object-contain rounded"
                      loading="lazy"
                    >
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate" x-text="product.name"></p>
                    <p class="text-xs text-gray-500 truncate" x-text="product.product_short"></p>
                    <p class="text-xs text-orange-600" x-text="product.serial"></p>
                  </div>
                  <div class="flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </div>
                </div>
              </template>
            </div>
          </div>
         </div>
       </div>

    </div>
  </div>

  <!-- Mobile Menu - LG Style -->
  <div x-show="mobileMenuOpen" x-cloak x-transition class="lg:hidden fixed inset-0 z-50 overflow-y-auto bg-white">
    <div class="absolute right-0 top-0 h-full w-full max-w-full lg-mobile-menu mobile-menu-container">
      <!-- Header with close button -->
      <div class="flex items-center justify-between p-6">
        <a href="/"><img src="{{ asset('img/digi-logo.svg') }}" alt="DIGI Logo" class="h-8 w-auto" /></a>
        <div class="flex items-center space-x-4">
          {{-- <!-- Search icon -->
          <button class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
          </button>
          <!-- User icon -->
          <button class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
          </button>
          <!-- Cart icon -->
          <button class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
          </button> --}}
          <!-- Close button -->
          <button @click="mobileMenuOpen = false" class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Menu Items -->
      <nav class="text-black mt-8 text-lg font-medium">
        <!-- Other menu items -->
            <a href="{{ route('about-digi.index') }}"
            class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
                <span>About DIGI</span>
            </a>
            <!-- Products Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-6 py-4 border-y border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
                    <span>Products</span>
                    <svg :class="{'rotate-90': open}" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

                <!-- Dropdown Items -->
                <div x-show="open" x-transition
                    class="lg:absolute font-[inter] lg:left-0 lg:w-56">
                    @foreach ($categories as $category)
                        <a href="{{ route('categories.show', $category->slug) }}"
                           class="block px-8 py-3 hover:bg-[#e0dbd0] border-b border-[#e0dbd0]">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Other menu items -->
            <a href="{{ route('about') }}"
            class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
                <span>CTC DIGI-Venture</span>
            </a>
            <!-- Other menu items -->
            <a href="{{ route('recently-viewed.index') }}"
            class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
                <span>Recently Viewed</span>
            </a>
            <!-- Other menu items -->
            <a href="{{ route('new-arrivals.index') }}"
            class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
                <span>New Arrivals</span>
            </a>
            <!-- Other menu items -->
            <a href="{{ route('most-popular.index') }}"
            class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
                <span>Most Popular</span>
            </a>
            <!-- Other menu items -->
            <a href="{{ route('contact') }}"
            class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
                <span>Contact Us</span>
            </a>
        </nav>

    </div>
  </div>
 </div>
</header>
