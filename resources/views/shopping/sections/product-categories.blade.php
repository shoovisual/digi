<!-- Categories Bar -->
<div class="lg:flex grid md:grid-cols-4 grid-cols-3 justify-center lg:space-x-8 gap-y-4 py-6">
    @foreach ($categories as $category)
        <a href="{{ route('categories.show', $category->slug) }}" class="flex group flex-col items-center group">
            <div class="flex p-8 items-center justify-center rounded-lg border-2 {{ request()->routeIs('products.index') && $category->name == 'All Products' ? 'border-orange-500' : 'border-gray-300' }} group-hover:border-orange-500 transition-colors duration-300 mb-2">
                @if ($category->icon)
                    <img src="{{ asset('img/' . $category->icon) }}" alt="{{ $category->name }} icon" class="lg:w-18 lg:h-18 w-12 h-12 group-hover:scale-110 transition-transform duration-300">
                @endif
            </div>
            <span class="text-md font-medium text-gray-600 group-hover:text-orange-500 hidden md:block transition-colors duration-300">{{ $category->name }}</span>
        </a>
    @endforeach
</div>
