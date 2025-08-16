<header class="border-b border-[#EDEDED]" x-data="{ mobileMenuOpen: false }">
  <!-- Top slim bar -->
  <div class="bg-[#F2F0EC] flex border-b border-[#C7C7C7] justify-between text-sm font-medium text-black px-4 md:px-6 py-4">
    <div class="flex">
        <a href="#" class="font-semibold">For Consumer</a>
        <span class="mx-4">|</span>
        <a href="/">For Business</a>
    </div>
    <div class="space-x-4 md:space-x-6 hidden sm:flex">
      <a href="#">Career</a>
      <a href="#">Supports</a>
    </div>
  </div>

  <!-- Main nav -->
  <div x-data="{ stuck: false }"
    x-init="
        window.addEventListener('scroll', () => {
            stuck = window.scrollY > 80
        })" :class="stuck
            ? 'fixed top-0 inset-x-0 bg-[#F2F0EC]/90 border-b border-[#C7C7C7]  backdrop-blur transition' : ''"
            class="bg-[#F2F0EC] flex items-center justify-between px-4 md:px-6 py-6 transition-all duration-300 z-50" >
        <!-- Logo -->
        <div class="flex items-center space-x-2">
        <a href="/"><img src="{{ asset('img/digi-logo.svg') }}" alt="DIGI Logo" class="h-8 w-auto" /></a>
        </div>

        <!-- Desktop menu -->
        <nav class="hidden lg:flex text-black space-x-6 text-lg font-[400]">
            <a href="/"
            @class([
                'hover:text-digi-orange',
                'text-digi-orange' => request()->is('/')
            ])>
                Home
            </a>

            <a href="{{ route('about-digi.index') }}"
            @class([
                'hover:text-digi-orange',
                'text-digi-orange' => request()->is('about-digi')
            ])>
                What is DIGI
            </a>

            <div x-data="{ megaMenuOpen: false, closeTimeout: null }" class="relative" @mouseenter="clearTimeout(closeTimeout); megaMenuOpen = true" @mouseleave="closeTimeout = setTimeout(() => megaMenuOpen = false, 100)">
                <a href="{{ route('products.index') }}"
                @class([
                    'hover:text-digi-orange flex items-center',
                    'text-digi-orange' => request()->routeIs('products.*', 'categories.*')
                ])>
                    Our Products
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>

                <!-- Mega Menu -->
                <div x-show="megaMenuOpen" x-transition:enter="transition ease-out duration-200" class="border border-gray-400 bg-black/30 backdrop-blur-xs h-screen w-screen absolute top-14 -left-120 z-50">
                    <div class="bg-[#F2F0EC] p-4">
                        <div class="grid grid-cols-4 gap-4 max-w-7xl mx-auto text-sm">
                            <!-- TVs Column -->
                            <div class="flex flex-col gap-y-2 font-semibold">
                                <a href="#" class="mega-menu-link">Recently Viewed</a>
                                <a href="#" class="mega-menu-link">Most Popular</a>
                                <a href="#" class="mega-menu-link">New Arrivals</a>
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
                                    'url' => '#',
                                    'image' => asset('img/digi-washing-machine-featured.jpg')
                                ],
                                [
                                    'name' => 'DIGI TV',
                                    'url' => '#',
                                    'image' => asset('img/products/tvs/tv-featured.jpg')
                                ],
                                [
                                    'name' => 'DIGI Fridge',
                                    'url' => '#',
                                    'image' => asset('img/digi-fridge-featured.jpg')
                                ]
                            ]
                        @endphp
                        <div class="max-w-7xl mx-auto mt-4 grid grid-cols-4 py-3 gap-4">
                            <!-- Featured Product Image -->
                            <div></div>
                            @foreach ($featuredProducts as $product)
                                <a href="{{ $product['url'] }}" class="flex group relative flex-col">
                                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }} image" class="w-full h-40 rounded-2xl object-cover">
                                    <span class="absolute top-2 left-5 mt-2 text-lg w-1/2 z-20">{{ $product['name'] }}</span>
                                    <div class="overlay bg-gradient-to-r from-white/50 to-transparent rounded-2xl absolute z-10 inset-0"></div>
                                    <span class="z-20 absolute bottom-2 bg-white/50 backdrop-blur-sm rounded-full px-3 border-1 group-hover:bg-digi-orange group-hover:text-white transition-all duration-300 border-digi-orange py-2 left-5"><i class="bi bi-arrow-right text-lg"></i></span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('about') }}"
            @class([
                'hover:text-digi-orange',
                'text-digi-orange' => request()->routeIs('about')
            ])>
                About CTC DIGI‑Venture
            </a>

            <a href="#order-now"
            @class([
                'hover:text-digi-orange',
                'text-digi-orange' => request()->is('order-now')
            ])>
                Order Now
            </a>

            <a href="{{ route('contact') }}"
            @class([
                'hover:text-digi-orange',
                'text-digi-orange' => request()->is('contact')
            ])>
                Contact Us
            </a>
        </nav>


    <!-- Right Side: Search & Icons -->
    <div class="flex items-center space-x-3">
      <!-- Search bar -->
      <div class="relative hidden sm:block">
        <input type="text" placeholder="Search" class="pl-8 placeholder:font-medium pr-3 py-1.5 border rounded-full text-sm focus:outline-none" />
        <svg class="w-4 h-4 absolute left-2.5 top-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.5 3.5a7.5 7.5 0 0013.15 13.15z" />
        </svg>
      </div>

      <!-- Wishlist Icon -->
      <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
        <a href="{{ route('wishlist.index') }}" class="relative">
          <svg class="w-9 h-9 text-black hidden sm:block" fill="none" stroke="currentColor" stroke-width="1.5"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
          </svg>
          <span id="wishlist-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 items-center justify-center hidden">0</span>
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
    </div>
  </div>

  <!-- Mobile Menu - LG Style -->
  <div x-show="mobileMenuOpen" x-transition class="lg:hidden fixed inset-0 z-50 overflow-y-auto bg-white">
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
            <a href="{{ route('contact') }}"
            class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
                <span>Contact Us</span>
            </a>
        </nav>

    </div>
  </div>
</header>
