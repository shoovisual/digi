import './bootstrap';

// Function to get wishlist from local storage
function getWishlist() {
    const wishlist = localStorage.getItem('wishlist');
    return wishlist ? JSON.parse(wishlist) : {};
}

// Function to save wishlist to local storage
function saveWishlist(wishlist) {
    localStorage.setItem('wishlist', JSON.stringify(wishlist));
}

// Function to remove expired items from wishlist
function cleanWishlist() {
    let wishlist = getWishlist();
    const now = Date.now();
    const threeDays = 3 * 24 * 60 * 60 * 1000; // 3 days in milliseconds

    for (const productId in wishlist) {
        if (wishlist.hasOwnProperty(productId)) {
            if (now - wishlist[productId].addedAt > threeDays) {
                delete wishlist[productId];
            }
        }
    }
    saveWishlist(wishlist);
    updateWishlistIcons();
    updateWishlistCount();
    renderWishlistPreview();
}

// Function to add/remove product from wishlist
window.addToWishlist = function(productId, productName, productImage, productSlug) {
    let wishlist = getWishlist();
    const icon = document.getElementById(`wishlist-icon-${productId}`);

    if (wishlist[productId]) {
        // Product is already in wishlist, remove it
        delete wishlist[productId];
        if (icon) {
            icon.classList.remove('text-red-500', 'bi', 'bi-heart-fill');
            icon.classList.add('text-gray-500', 'bi', 'bi-heart');
        }
    } else {
        // Product is not in wishlist, add it
        wishlist[productId] = {
            id: productId,
            name: productName,
            image: productImage,
            slug: productSlug,
            addedAt: Date.now()
        };
        if (icon) {
            icon.classList.remove('text-gray-500', 'bi', 'bi-heart');
            icon.classList.add('text-red-500', 'bi', 'bi-heart-fill');
        }
    }
    saveWishlist(wishlist);
    updateWishlistCount();
    renderWishlistPreview();
};

// Function to update heart icons based on wishlist status
function updateWishlistIcons() {
    const wishlist = getWishlist();
    document.querySelectorAll('[id^="wishlist-icon-"]').forEach(icon => {
        const productId = icon.id.replace('wishlist-icon-', '');
        if (wishlist[productId]) {
            icon.classList.remove('text-gray-500', 'bi', 'bi-heart');
            icon.classList.add('text-red-500', 'bi', 'bi-heart-fill');
        } else {
            icon.classList.remove('text-red-500', 'bi', 'bi-heart-fill');
            icon.classList.add('text-gray-500', 'bi', 'bi-heart');
        }
    });
}

// Function to update wishlist count in navbar
function updateWishlistCount() {
    const wishlist = getWishlist();
    const count = Object.keys(wishlist).length;
    const wishlistCountElement = document.getElementById('wishlist-count');
    if (wishlistCountElement) {
        wishlistCountElement.textContent = count;
        if (count > 0) {
            wishlistCountElement.classList.remove('hidden');
            wishlistCountElement.classList.add('flex');
        } else {
            wishlistCountElement.classList.add('hidden');
            wishlistCountElement.classList.remove('flex');
        }
    }
}

// Function to render wishlist preview in navbar dropdown
function renderWishlistPreview() {
    const wishlist = getWishlist();
    const previewContainer = document.getElementById('wishlist-preview');
    if (previewContainer) {
        previewContainer.innerHTML = ''; // Clear existing content
        const productIds = Object.keys(wishlist);
        if (productIds.length === 0) {
            previewContainer.innerHTML = '<p class="text-gray-500 font-medium">Your wishlist is empty.</p>';
            return;
        }

        // Display up to 3 items in the preview
        productIds.slice(0, 3).forEach(productId => {
        const product   = wishlist[productId];
        const expiry    = product.addedAt + 72 * 60 * 60 * 1000;  // 72 h from saved time
        const spanId    = `cd_${product.id}`;                     // unique countdown span

        const itemHtml = `
            <div class="flex items-center space-x-3 group border-b border-gray-300 py-2">
                <a href="/products/${product.slug}" class="flex items-center space-x-3 flex-1">
                    <img src="/img/${product.image}" alt="${product.name}"
                        class="w-16 h-16 object-contain rounded-md">
                    <div>
                        <p class="text-md font-medium text-gray-800"
                            title="${product.name}">${product.name.slice(0, 20)}${product.name.length > 20 ? '...' : ''}</p>
                        <p class="text-sm font-medium text-gray-500">
                            <span id="${spanId}"></span> left
                        </p>
                    </div>
                </a>
                <button onclick="removeFromWishlistPreview('${product.id}')"
                        class="text-gray-400 cursor-pointer hover:bg-red-500 px-2 py-1 rounded-full
                            hover:text-white group-hover:opacity-100 transition-all duration-300">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        `;
        previewContainer.insertAdjacentHTML('beforeend', itemHtml);

        /* --- live HH:mm:ss countdown --- */
        const el = document.getElementById(spanId);
        const tick = () => {
            const diff = expiry - Date.now();
            if (diff <= 0) { el.textContent = '00:00:00'; clearInterval(timer); return; }

            const s  = Math.floor(diff / 1000);
            const hh = String(Math.floor(s / 3600)).padStart(2, '0');
            const mm = String(Math.floor((s % 3600) / 60)).padStart(2, '0');
            const ss = String(s % 60).padStart(2, '0');
            el.textContent = ` ${hh} : ${mm} : ${ss}`;
        };
        tick();                                    // initial render
        const timer = setInterval(tick, 1000);     // update every second
    });

    }
}

// Function to remove product from wishlist preview
window.removeFromWishlistPreview = function(productId) {
    let wishlist = getWishlist();
    if (wishlist[productId]) {
        delete wishlist[productId];
        saveWishlist(wishlist);

        // Update all wishlist-related UI elements
        updateWishlistIcons();
        updateWishlistCount();
        renderWishlistPreview();
    }
};

// Run on page load
document.addEventListener('DOMContentLoaded', () => {
    cleanWishlist(); // Clean up expired items first
    updateWishlistIcons();
    updateWishlistCount();
    renderWishlistPreview();
});


document.addEventListener('DOMContentLoaded', () => {
    const wishlist = JSON.parse(localStorage.getItem('wishlist')) || {};
    const fullWishlistContainer = document.getElementById('full-wishlist');
    const emptyWishlistMessage = document.getElementById('empty-wishlist-message');

    // Clear existing content before re-rendering
    fullWishlistContainer.innerHTML = '';



    if (Object.keys(wishlist).length === 0) {
        fullWishlistContainer.classList.add('hidden');
        emptyWishlistMessage.classList.remove('hidden');
    } else {
        emptyWishlistMessage.classList.add('hidden');
        fullWishlistContainer.classList.remove('hidden');

        for (const productId in wishlist) {
            if (wishlist.hasOwnProperty(productId)) {
                const product = wishlist[productId];
                const timeLeft = Math.ceil((product.addedAt + (3 * 24 * 60 * 60 * 1000) - Date.now()) / (1000 * 60 * 60 * 24));

                const productCardHtml = `
                    <div class="bg-white rounded-lg font-medium overflow-hidden" id="wishlist-item-${product.id}">
                        <a href="/products/${product.slug}">
                            <img src="/img/${product.image}" alt="${product.name}" class="w-full h-62 object-contain">
                        </a>
                        <div class="p-4">
                            <a href="/products/${product.slug}">
                                <h2 class="text-lg font-semibold text-gray-800">${product.name}</h2>
                            </a>
                            <p class="text-sm text-gray-500 mt-1">${timeLeft} days left</p>
                            <div class="flex items-center font-medium gap-x-4 justify-between mt-4">
                                <a href="/products/${product.slug}" class="px-3 w-full text-center py-2 border border-gray-300 rounded-full text-sm text-black hover:bg-gray-100">
                                    View Product
                                </a>
                                <button onclick="removeFromWishlist('${product.id}')" class="text-white bg-red-500 px-2 py-1 rounded-full hover:bg-red-600 cursor-pointer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                fullWishlistContainer.insertAdjacentHTML('beforeend', productCardHtml);
            }
        }
    }

    // Function to remove product from wishlist (for the full wishlist page)
    window.removeFromWishlist = function(productId) {
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || {};
        if (wishlist[productId]) {
            delete wishlist[productId];
            localStorage.setItem('wishlist', JSON.stringify(wishlist));

            // Remove the item from DOM without reloading
            const itemToRemove = document.getElementById(`wishlist-item-${productId}`);
            if (itemToRemove) {
                itemToRemove.remove();
            }

            // Update the navbar wishlist count and preview
            if (typeof updateWishlistCount === 'function') {
                updateWishlistCount();
            }
            if (typeof renderWishlistPreview === 'function') {
                renderWishlistPreview();
            }

            // Show empty message if wishlist is now empty
            if (Object.keys(wishlist).length === 0) {
                document.getElementById('full-wishlist').classList.add('hidden');
                document.getElementById('empty-wishlist-message').classList.remove('hidden');
            }
        }
    };
});
