<header class="border-b border-[#EDEDED]" x-data="{ mobileMenuOpen: false }">
  <!-- Top slim bar -->
  <div class="bg-off-white flex border-b border-[#C7C7C7] justify-between text-sm font-medium text-black px-4 md:px-6 py-4">
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
            ? 'fixed top-0 inset-x-0 bg-off-white/90 shadow-md backdrop-blur transition' : ''"
            class="bg-off-white flex items-center justify-between px-4 md:px-6 py-6 transition-all duration-300 z-50" >
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

            <a href="{{ route('products.index') }}"
            @class([
                'hover:text-digi-orange',
                'text-digi-orange' => request()->routeIs('products.*', 'categories.*')
            ])>
                Our Products
            </a>

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
      <div class="flex items-center justify-between p-4 border-b border-[#e0dbd0]">
        <a href="/"><img src="{{ asset('img/digi-logo.svg') }}" alt="DIGI Logo" class="h-8 w-auto" /></a>
        <div class="flex items-center space-x-4">
          <!-- Search icon -->
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
          </button>
          <!-- Close button -->
          <button @click="mobileMenuOpen = false" class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
      
      <!-- Menu Items -->
      <nav class="text-black text-lg font-medium">
        <!-- Main navigation links -->
        <a href="{{ route('products.index') }}" class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
          <span>Shop</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </a>
        <a href="#" class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
          <span>TV/Audio/Video</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </a>
        <a href="#" class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
          <span>Home Appliances</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </a>
        <a href="#" class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
          <span>Air Solutions</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </a>
        <a href="#" class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
          <span>Computing</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </a>
        <a href="#" class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
          <span>Accessories</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </a>
        <a href="{{ route('contact') }}" class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
          <span>Support</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </a>
        <a href="{{ route('about-digi.index') }}" class="flex items-center justify-between px-6 py-4 border-b border-[#e0dbd0] hover:bg-[#e0dbd0] lg-mobile-menu-item">
          <span>DIGI AI</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </a>
        
        <!-- Secondary links -->
        <div class="mt-6 px-6 py-4 border-b border-[#e0dbd0]">
          <a href="{{ route('about') }}" class="block text-black font-medium py-2 lg-mobile-menu-item">INVESTOR</a>
          <a href="#" class="block text-black font-medium py-2 lg-mobile-menu-item">For Business</a>
        </div>
        
        <!-- User actions -->
        <div class="mt-6 px-6 py-4">
          <a href="#" class="flex items-center text-black font-medium py-2 lg-mobile-menu-item">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            Sign in
          </a>
          <a href="#" class="flex items-center text-black font-medium py-2 lg-mobile-menu-item">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            Register a product
          </a>
        </div>
      </nav>
    </div>
  </div>
</header>
