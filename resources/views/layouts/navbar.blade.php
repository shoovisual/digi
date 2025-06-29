<header class="border-b border-[#EDEDED]" x-data="{ mobileMenuOpen: false }">
  <!-- Top slim bar -->
  <div class="bg-off-white flex border-b border-[#C7C7C7] justify-between text-sm font-medium text-black px-4 md:px-6 py-2 border-t-4 ">
    <span>For Business</span>
    <div class="space-x-4 md:space-x-6 hidden sm:flex">
      <a href="#">Career</a>
      <a href="#">Supports</a>
    </div>
  </div>

  <!-- Main nav -->
  <div class="bg-off-white flex items-center justify-between px-4 md:px-6 py-3">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="{{ asset('img/digi-logo.svg') }}" alt="DIGI Logo" class="h-8 w-auto" />
    </div>

    <!-- Desktop menu -->
    <nav class="hidden lg:flex space-x-4 xl:space-x-6 text-[16px] font-semibold">
        <a href="/"
        @class([
            'hover:text-digi-orange',
            'text-digi-orange' => request()->is('/')
        ])>
            Home
        </a>

        <a href="#what-is-digi"
        @class([
            'hover:text-digi-orange',
            'text-digi-orange' => request()->is('what-is-digi')
        ])>
            What is DIGI
        </a>

        <a href="{{ route('products.index') }}"
        @class([
            'hover:text-digi-orange',
            'text-digi-orange' => request()->routeIs('products.*')
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

        <a href="#contact"
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
        <input type="text" placeholder="Search" class="pl-8 pr-3 py-1.5 border rounded-full text-sm focus:outline-none" />
        <svg class="w-4 h-4 absolute left-2.5 top-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.5 3.5a7.5 7.5 0 0013.15 13.15z" />
        </svg>
      </div>

      <!-- Heart icon -->
      <svg class="w-6 h-6 text-black hidden sm:block" fill="none" stroke="currentColor" stroke-width="1.5"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
      </svg>
      <!-- Hamburger -->
      <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <nav x-show="mobileMenuOpen" x-transition class="lg:hidden px-4 pb-4 space-y-2 text-sm font-medium">
    <a href="/" class="block hover:text-digi-orange">Home</a>
    <a href="#" class="block hover:text-digi-orange">What is DIGI</a>
    <a href="{{ route('products.index') }}" class="block hover:text-digi-orange">Our Products</a>
    <a href="#" class="block hover:text-digi-orange">About CTC DIGI-Venture</a>
    <a href="#" class="block hover:text-digi-orange">Order Now</a>
    <a href="#" class="block hover:text-digi-orange">Contact us</a>
  </nav>
</header>
