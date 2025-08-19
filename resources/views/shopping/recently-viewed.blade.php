@extends('layouts.app')

@section('title', 'Recently Viewed Products')

@section('content')
<div class="bg-[#F2F0EC] w-full mx-auto px-4 py-8">
    <div class="md:max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Recently Viewed Products</h1>
            <p class="text-gray-600">Keep track of products you've recently viewed</p>
        </div>

        <!-- Loading State -->
        <div id="loading-state" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-orange-500"></div>
            <p class="mt-4 text-gray-600">Loading your recently viewed products...</p>
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="text-center py-12 hidden">
            <div class="mb-4">
                <i class="bi bi-clock-history text-6xl text-gray-300"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Recently Viewed Products</h3>
            <p class="text-gray-500 mb-6">Start browsing our products to see them here</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition-colors">
                Browse Products
            </a>
        </div>

        <!-- Products Container -->
        <div id="products-container" class="hidden mx-3 md:max-w-7xl md:mx-auto">
            <!-- Today Section -->
            <div id="today-section" class="mb-12 hidden">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="bi bi-calendar text-orange-500 mr-3"></i>
                    Today
                </h2>
                <div id="today-products" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Products will be populated by JavaScript -->
                </div>
            </div>

            <!-- This Week Section -->
            <div id="week-section" class="mb-12 hidden">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="bi bi-calendar-week text-orange-500 mr-3"></i>
                    This Week
                </h2>
                <div id="week-products" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Products will be populated by JavaScript -->
                </div>
            </div>

            <!-- This Month Section -->
            <div id="month-section" class="mb-12 hidden">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="bi bi-calendar-month text-orange-500 mr-3"></i>
                    This Month
                </h2>
                <div id="month-products" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Products will be populated by JavaScript -->
                </div>
            </div>

            <!-- Older Section -->
            <div id="older-section" class="mb-12 hidden">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="bi bi-calendar text-orange-500 mr-3"></i>
                    Older
                </h2>
                <div id="older-products" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Products will be populated by JavaScript -->
                </div>
            </div>
        </div>

        <!-- Clear History Button -->
        <div id="clear-history-container" class="text-center mt-8 hidden">
            <button id="clear-history-btn" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition-colors">
                <i class="bi bi-trash mr-2"></i>
                Clear Viewing History
            </button>
        </div>
    </div>
</div>

@include('sections.need-help')

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadRecentlyViewedProducts();
});

function loadRecentlyViewedProducts() {
    // Get recently viewed products from localStorage
    const recentlyViewed = JSON.parse(localStorage.getItem('recentlyViewed') || '[]');

    if (recentlyViewed.length === 0) {
        showEmptyState();
        return;
    }

    // Extract product IDs
    const productIds = recentlyViewed.map(item => item.id);

    // Fetch product details from API
    fetch(`/api/recently-viewed-products?product_ids[]=${productIds.join('&product_ids[]=')}`)
        .then(response => response.json())
        .then(data => {
            if (data.products && data.products.length > 0) {
                displayProducts(data.products, recentlyViewed);
            } else {
                showEmptyState();
            }
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            showEmptyState();
        });
}

function displayProducts(products, recentlyViewed) {
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    const weekAgo = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
    const monthAgo = new Date(today.getTime() - 30 * 24 * 60 * 60 * 1000);

    const groups = {
        today: [],
        week: [],
        month: [],
        older: []
    };

    // Group products by time periods
    recentlyViewed.forEach(viewedItem => {
        const product = products.find(p => p.id == viewedItem.id);
        if (!product) return;

        const viewedDate = new Date(viewedItem.viewedAt);
        const productWithViewDate = { ...product, viewedAt: viewedItem.viewedAt };

        if (viewedDate >= today) {
            groups.today.push(productWithViewDate);
        } else if (viewedDate >= weekAgo) {
            groups.week.push(productWithViewDate);
        } else if (viewedDate >= monthAgo) {
            groups.month.push(productWithViewDate);
        } else {
            groups.older.push(productWithViewDate);
        }
    });

    // Sort each group by most recent first
    Object.keys(groups).forEach(key => {
        groups[key].sort((a, b) => new Date(b.viewedAt) - new Date(a.viewedAt));
    });

    // Display groups
    displayProductGroup('today', groups.today);
    displayProductGroup('week', groups.week);
    displayProductGroup('month', groups.month);
    displayProductGroup('older', groups.older);

    // Show products container and clear history button
    document.getElementById('loading-state').classList.add('hidden');
    document.getElementById('products-container').classList.remove('hidden');
    document.getElementById('clear-history-container').classList.remove('hidden');
}

function displayProductGroup(period, products) {
    const sectionId = period === 'today' ? 'today-section' :
                     period === 'week' ? 'week-section' :
                     period === 'month' ? 'month-section' : 'older-section';

    const containerId = period === 'today' ? 'today-products' :
                       period === 'week' ? 'week-products' :
                       period === 'month' ? 'month-products' : 'older-products';

    if (products.length > 0) {
        document.getElementById(sectionId).classList.remove('hidden');
        const container = document.getElementById(containerId);
        container.innerHTML = products.map(product => createProductCard(product)).join('');
    }
}

function createProductCard(product) {
    const imageUrl = product.image ? `/img/${product.image}` : '/img/products/default.jpg';
    const productUrl = `/products/${product.slug}`;
    const price = product.price ? `$${parseFloat(product.price).toFixed(2)}` : 'Price not available';
    const dateViewed = new Date(product.viewedAt).toLocaleString();


    return `
        <div class="bg-white rounded-lg group hover:shadow-md overflow-hidden cursor-pointer transition-shadow duration-300">
            <div class="aspect-1">
                <img src="${imageUrl}" alt="${product.name}" class="w-full p-5 group-hover:p-3 transition-all duration-300 object-cover">
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">${product.name}</h3>
                <p class="text-orange-600 font-medium text-sm py-3">${dateViewed}</p>
                <div class="flex space-x-2">
                    <a href="${productUrl}" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-center py-2 px-4 rounded-full transition-colors text-md">
                        View Product
                    </a>
                    <button onclick="removeFromRecentlyViewed(${product.id})" class="bg-gray-200 hover:bg-gray-300 text-gray-700 cursor-pointer px-3 py-[11px] text-xl rounded-full transition-colors" title="Remove from history">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:rotate-180 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="red">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    `;
}

function removeFromRecentlyViewed(productId) {
    let recentlyViewed = JSON.parse(localStorage.getItem('recentlyViewed') || '[]');
    recentlyViewed = recentlyViewed.filter(item => item.id != productId);
    localStorage.setItem('recentlyViewed', JSON.stringify(recentlyViewed));

    // Reload the page to refresh the display
    location.reload();
}

function showEmptyState() {
    document.getElementById('loading-state').classList.add('hidden');
    document.getElementById('empty-state').classList.remove('hidden');
}

// Clear history functionality
document.addEventListener('DOMContentLoaded', function() {
    const clearHistoryBtn = document.getElementById('clear-history-btn');
    if (clearHistoryBtn) {
        clearHistoryBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to clear your viewing history? This action cannot be undone.')) {
                localStorage.removeItem('recentlyViewed');
                location.reload();
            }
        });
    }
});
</script>
@endsection
