<!-- Categories Bar -->
<div class="flex justify-center space-x-8 mb-12">
    @foreach ($categories as $category)
        <a href="{{ $category->name == 'All Products' ? route('products.index') : route('categories.show', $category->id) }}" class="flex group flex-col items-center group">
            <div class="flex p-8 items-center justify-center rounded-lg border-2 {{ request()->routeIs('products.index') && $category->name == 'All Products' ? 'border-orange-500' : 'border-gray-200' }} group-hover:border-orange-500 transition-colors duration-300 mb-2">
                @if ($category->icon)
                    <img src="{{ asset('img/' . $category->icon) }}" alt="{{ $category->name }} icon" class="w-18 h-18 group-hover:scale-110 transition-transform duration-300">
                @endif
            </div>
            <span class="text-sm font-medium text-gray-600 group-hover:text-orange-500 transition-colors duration-300">{{ $category->name }}</span>
        </a>
    @endforeach
</div>
