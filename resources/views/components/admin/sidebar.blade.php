<aside class="w-64 border-r border-gray-200 fixed bg-off-white h-full z-50 text-sm" x-data="{ openPM: true }">
    <div class="flex items-center justify-center py-10 border-b border-gray-800 space-x-2">
        <a href="/"><img src="{{ asset('img/digi-logo.svg') }}" alt="DIGI Logo" class="h-10 w-auto" /></a>
    </div>
    <nav class="flex flex-col text-[16px] admin-nav text-gray-700 gap-2 px-3 mt-4">
        <a href="{{ route('admin.dashboard') }}" class="menu-link p-3 hover:bg-black hover:text-white transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-black text-white' : '' }}">
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.promotions.index') }}" class="menu-link p-3 hover:bg-black hover:text-white transition-all duration-300 {{ request()->routeIs('admin.promotions.*') ? 'bg-black text-white' : '' }}">
            <span>Promotions</span>
        </a>
        <a href="{{ route('admin.products.index') }}" class="menu-link p-3 hover:bg-black hover:text-white transition-all duration-300 {{ request()->routeIs('admin.products.*') ? 'bg-black text-white' : '' }}">
            <span>Products</span>
        </a>
        <a href="{{ route('admin.hero-slides.index') }}" class="menu-link p-3 hover:bg-black hover:text-white transition-all duration-300 {{ request()->routeIs('admin.hero-slides.*') ? 'bg-black text-white' : '' }}">
            <span>Hero Slider</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="menu-link p-3 hover:bg-black hover:text-white transition-all duration-300 {{ request()->routeIs('admin.categories.*') ? 'bg-black text-white' : '' }}">
            <span>Categories</span>
        </a>
        <a href="{{ route('admin.settings.index') }}" class="menu-link p-3 hover:bg-black hover:text-white transition-all duration-300 {{ request()->routeIs('admin.settings.*') ? 'bg-black text-white' : '' }}">
            <span>Settings</span>
        </a>
    </nav>
</aside>
