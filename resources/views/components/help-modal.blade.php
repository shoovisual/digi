{{-- Help Modal Component --}}
<div id="helpModal" class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center">
    <div class="bg-white rounded-xl overflow-hidden w-full max-w-2xl mx-4 shadow-xl max-h-[90vh] flex flex-col">
        <!-- Modal Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b border-b-gray-400">
            <h2 id="helpModalTitle" class="text-2xl font-bold text-gray-900">Help Center</h2>
            <button onclick="closeHelpModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div id="helpModalContent" class="p-6 overflow-y-auto flex-1">
            <!-- Content will be dynamically loaded here -->
        </div>
    </div>
</div>

<script>
function openHelpModal(category) {
    const modal = document.getElementById('helpModal');
    const title = document.getElementById('helpModalTitle');
    const content = document.getElementById('helpModalContent');

    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // Set content based on category
    switch(category) {
        case 'repair':
            title.textContent = 'Product Repairing';
            content.innerHTML = `
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="${window.location.origin}/img/icons/icon_request-a-repair_60x60.svg" alt="Repair Icon" class="w-12 h-12">
                        <h3 class="text-xl font-semibold">Request a Repair</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Need to repair your DIGI product? We're here to help you get it fixed quickly and efficiently.</p>

                    <form method="POST" action="{{ route('contact.send') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="reason" value="Product Repairing">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product Type*</label>
                                <select name="product_type" id="product_type" onchange="loadProductModels(this.value)" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                    <option value="">Select Product Type</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product Model*</label>
                                <select name="product_model" id="product_model" class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300" required>
                                    <option value="">Select Model</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Your phone number" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Issue Description</label>
                            <textarea name="message" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" rows="3" placeholder="Describe the issue you're experiencing" required></textarea>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <a href="javascript:void(0);" onclick="closeHelpModal()" class="border border-gray-500 text-gray-500 hover:text-white py-2 px-4 rounded-full hover:bg-gray-500 transition">
                                cancel
                            </a>
                            <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-full hover:bg-orange-600 transition">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            `;

            loadCategories();
            break;

        case 'support':
            title.textContent = 'Product Support';
            content.innerHTML = `
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="${window.location.origin}/img/icons/icon_product_48.svg" alt="Support Icon" class="w-12 h-12">
                        <h3 class="text-xl font-semibold">Product Support</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Find manuals, troubleshooting guides, and warranty information for your DIGI products.</p>

                    <form method="POST" action="{{ route('contact.send') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="reason" value="Product Support">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product Type</label>
                                <select name="product_type" id="support_product_type" onchange="loadSupportProductModels(this.value)" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                    <option value="">Select Product Type</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product Model*</label>
                                <select name="product_model" id="support_product_model" class="w-full border border-gray-300 rounded-md px-4 py-3 focus:ring focus:ring-teal-300" required>
                                    <option value="">Select Model</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Your phone number" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Support Type</label>
                            <select name="support_type" id="support_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                <option value="">Select Support Type</option>
                                <option value="technical_support">Technical Support</option>
                                <option value="manuals">Product Manuals</option>
                                <option value="troubleshooting">Troubleshooting Guides</option>
                                <option value="warranty">Warranty Information</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Support Request Details</label>
                            <textarea name="message" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Describe your support request or question" required></textarea>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <a href="javascript:void(0);" onclick="closeHelpModal()" class="border border-gray-500 text-gray-500 hover:text-white py-2 px-4 rounded-full hover:bg-gray-500 transition">
                                cancel
                            </a>
                            <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-full hover:bg-orange-600 transition">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            `;

            loadSupportCategories();
            break;

        case 'whatsapp':
            title.textContent = 'WhatsApp Support';
            content.innerHTML = `
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="${window.location.origin}/img/icons/icon_whatsapp_60x60.svg" alt="WhatsApp Icon" class="w-12 h-12">
                        <h3 class="text-xl font-semibold">Chat with Us on WhatsApp</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Get instant support from our team via WhatsApp. We're here to help with any questions or concerns.</p>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-green-700 font-medium">Support Available</span>
                        </div>
                        <p class="text-green-600 text-sm">Monday - Friday: 8:00 AM - 6:00 PM</p>
                        <p class="text-green-600 text-sm">Saturday: 9:00 AM - 4:00 PM</p>
                    </div>

                    <div class="text-center">
                        <a href="https://wa.me/255793333444?text=Hello%2C%20I%20need%20help%20with%20my%20DIGI%20product"
                           target="_blank"
                           class="inline-flex items-center space-x-2 bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.087"/>
                            </svg>
                            <span>Start WhatsApp Chat</span>
                        </a>
                    </div>

                    <div class="text-center text-sm text-gray-500 mt-4">
                        <p>Or call us directly at: <strong>+25579 3333 444</strong></p>
                    </div>
                </div>
            `;
            break;

        case 'order':
            title.textContent = 'Order Support';
            content.innerHTML = `
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="${window.location.origin}/img/icons/icon_order_48.svg" alt="Order Icon" class="w-12 h-12">
                        <h3 class="text-xl font-semibold">Order Support</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Track your order, request returns or exchanges, and get help with your purchases.</p>

                    <div class="space-y-4">

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-800 mb-2">Need More Help?</h4>
                            <p class="text-blue-600 text-sm mb-3">Our customer service team is ready to assist you with any order-related questions.</p>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition text-sm">
                                   <a href="https://wa.me/255793333444?text=Hello%2C%20I%20need%20order%20support" target="_blank">Contact Customer Service </a>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            break;
    }
}


function closeHelpModal() {
    const modal = document.getElementById('helpModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Load categories from the server
async function loadCategories() {
    try {
        const response = await fetch('/api/categories');
        const categories = await response.json();

        const productTypeSelect = document.getElementById('product_type');
        if (productTypeSelect) {
            // Clear existing options except the first one
            productTypeSelect.innerHTML = '<option value="">Select Product Type</option>';

            // Add categories (exclude 'All Products' if present)
            categories.forEach(category => {
                if (category.name !== 'All Products') {
                    const option = document.createElement('option');
                    option.value = category.name;
                    option.textContent = category.name;
                    productTypeSelect.appendChild(option);
                }
            });
        }
    } catch (error) {
        console.error('Error loading categories:', error);
    }
}

// Load product models based on selected category
async function loadProductModels(categoryName) {
    const productModelSelect = document.getElementById('product_model');

    if (!categoryName) {
        productModelSelect.innerHTML = '<option value="">Please select a product type first</option>';
        return;
    }

    // Show loading state
    productModelSelect.innerHTML = '<option value="">Loading products...</option>';

    try {
        // Find category ID by name
        const categoriesResponse = await fetch('/api/categories');
        const categories = await categoriesResponse.json();
        const category = categories.find(cat => cat.name === categoryName);
        
        if (!category) {
            productModelSelect.innerHTML = '<option value="">Category not found</option>';
            return;
        }
        
        const response = await fetch(`/api/products-by-category/${category.id}`);
        const products = await response.json();

        // Clear and populate product models
        productModelSelect.innerHTML = '<option value="">Select Product Model</option>';

        if (products.length === 0) {
            productModelSelect.innerHTML = '<option value="">No products available for this category</option>';
            return;
        }

        products.forEach(product => {
            const option = document.createElement('option');
            option.value = `${product.product_short} (${product.serial})`;
            option.textContent = `${product.product_short} (${product.serial})`;
            productModelSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error loading products:', error);
        productModelSelect.innerHTML = '<option value="">Error loading products</option>';
    }
}

// Load categories for support form
async function loadSupportCategories() {
    try {
        const response = await fetch('/api/categories');
        const categories = await response.json();

        const productTypeSelect = document.getElementById('support_product_type');
        if (productTypeSelect) {
            // Clear existing options except the first one
            productTypeSelect.innerHTML = '<option value="">Select Product Type</option>';

            // Add categories (exclude 'All Products' if present)
            categories.forEach(category => {
                if (category.name !== 'All Products') {
                    const option = document.createElement('option');
                    option.value = category.name;
                    option.textContent = category.name;
                    productTypeSelect.appendChild(option);
                }
            });
        }
    } catch (error) {
        console.error('Error loading support categories:', error);
    }
}

// Load product models for support form
async function loadSupportProductModels(categoryName) {
    const productModelSelect = document.getElementById('support_product_model');

    if (!categoryName) {
        productModelSelect.innerHTML = '<option value="">Please select a product type first</option>';
        return;
    }

    // Show loading state
    productModelSelect.innerHTML = '<option value="">Loading products...</option>';

    try {
        // Find category ID by name
        const categoriesResponse = await fetch('/api/categories');
        const categories = await categoriesResponse.json();
        const category = categories.find(cat => cat.name === categoryName);
        
        if (!category) {
            productModelSelect.innerHTML = '<option value="">Category not found</option>';
            return;
        }
        
        const response = await fetch(`/api/products-by-category/${category.id}`);
        const products = await response.json();

        // Clear and populate product models
        productModelSelect.innerHTML = '<option value="">Select Product Model</option>';

        if (products.length === 0) {
            productModelSelect.innerHTML = '<option value="">No products available for this category</option>';
            return;
        }

        products.forEach(product => {
            const option = document.createElement('option');
            option.value = `${product.product_short} (${product.serial})`;
            option.textContent = `${product.product_short} (${product.serial})`;
            productModelSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error loading support products:', error);
        productModelSelect.innerHTML = '<option value="">Error loading products</option>';
    }
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('helpModal');
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeHelpModal();
        }
    });
});
</script>
