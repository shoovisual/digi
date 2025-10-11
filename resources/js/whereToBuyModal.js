// Alpine.js component for the Where to Buy modal

// Define the whereToBuyModal component for Alpine.js
window.whereToBuyModal = function(config) {
        return {
            isOpen: false,
            productImg: '',
            productName: '',
            query: '',
            tab: 'online',
            places: [],
            googleKey: config?.googleKey || '',
            mapboxKey: config?.mapboxKey || '',
            map: null,

            // Initialize component
            init() {
                // Listen for the custom event from the vanilla JS function
                window.addEventListener('openBuyModalEvent', (event) => {
                    const { name, image, slug } = event.detail;
                    this.openModal(name, image, slug);
                });
            },

            // Open the modal with product details
            openModal(name, image, slug) {
                this.isOpen = true;
                this.productName = name;
                this.productImg = image;

                // Initialize map after modal is visible
                this.$nextTick(() => {
                    this.initMap(slug);
                });
            },

            // Close the modal
            close() {
                this.isOpen = false;
            },

            // Initialize the map
            initMap(slug) {
                const mapElement = document.getElementById(`map-${slug}`);
                if (!mapElement) {
                    // Try with productName-based ID as fallback
                    const fallbackId = `map-${this.productName.replace(/\s+/g, '-').toLowerCase()}`;
                    const fallbackElement = document.getElementById(fallbackId);
                    if (fallbackElement) {
                        this.renderMap(fallbackElement, null, slug);
                        return;
                    }
                    return;
                }

                // Use Leaflet if available
                if (typeof L !== 'undefined') {
                    // Get user location if available
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition((position) => {
                            const userLat = position.coords.latitude;
                            const userLng = position.coords.longitude;
                            this.renderMap(mapElement, [userLat, userLng], slug);
                        }, () => {
                            // Default to Dar es Salaam if location not available
                            this.renderMap(mapElement, [-6.7924, 39.2083], slug);
                        });
                    } else {
                        // Default to Dar es Salaam if geolocation not supported
                        this.renderMap(mapElement, [-6.7924, 39.2083], slug);
                    }
                }
            },

            // Render the map with stores
            renderMap(mapElement, center, slug) {
                // Use default center if not provided
                if (!center) {
                    center = [-6.7924, 39.2083]; // Dar es Salaam default
                }

                const map = L.map(mapElement.id).setView(center, 12);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                // Add user marker if center is user location
                if (center[0] !== -6.7924 || center[1] !== 39.2083) {
                    L.marker(center).addTo(map).bindPopup("You are here").openPopup();
                }

                // Add store markers
                this.places = [
                    {
                        name: 'Jaden Home Store',
                        lat: -6.7740129,
                        lng: 39.1966954,
                        address: 'Rose Garden Road, Mikocheni',
                        phone: '0768285151',
                    },
                    {
                        name: 'DIGI Store',
                        lat: -6.8147387,
                        lng: 39.2879986,
                        address: 'Maktaba Square, Posta',
                        phone: '+25579 3333 444',
                        email: 'info@digiappliances.com',
                    },
                ];

                // Add markers for each store
                this.places.forEach(store => {
                    L.marker([store.lat, store.lng])
                        .addTo(map)
                        .bindPopup(`<strong>${store.name}</strong><br>${store.address || ''}<br>Phone: ${store.phone || 'N/A'}<br>Email: ${store.email || 'N/A'}`);
                });

                // Update store list - try multiple possible IDs
                const storeListIds = [
                    `storeList-${slug}`,
                    `storeList-${this.productName.replace(/\s+/g, '-').toLowerCase()}`
                ];

                let storeListElement = null;
                for (const id of storeListIds) {
                    storeListElement = document.getElementById(id);
                    if (storeListElement) break;
                }

                if (storeListElement) {
                    storeListElement.innerHTML = this.places.map(store =>
                        `<div class="border rounded-lg p-4 mb-2"><strong>${store.name}</strong><br><span class="text-sm text-gray-600">${store.address}</span><br><span class="text-sm text-gray-600">Phone: ${store.phone}</span></div>`
                    ).join('');
                }
            },

            // Search for stores
            search() {
                // This would normally use the Google Places API with the provided key
                console.log('Searching for:', this.query);
                // For now, we'll just use our default places
            },

            // Get logo for store
            logoFor(place) {
                // Default to DIGI logo
                return '/img/digi-logo.svg';
            }
        };
    };

    // Bridge between vanilla JS and Alpine.js
    // Override the existing openBuyModal function to dispatch an event for Alpine.js
    document.addEventListener('DOMContentLoaded', function() {
        // Store reference to any existing openBuyModal function
        const originalOpenBuyModal = window.openBuyModal;

        // Create new openBuyModal function that works with Alpine.js
        window.openBuyModal = function(name, image, slug) {
            // Dispatch a custom event that Alpine.js can listen for
            window.dispatchEvent(new CustomEvent('openBuyModalEvent', {
                detail: { name, image, slug }
            }));

            // Increment contact sales count (order intent)
            try {
                const tokenEl = document.querySelector('meta[name="csrf-token"]');
                const token = tokenEl ? tokenEl.getAttribute('content') : '';
                fetch('/api/increment-contact-sales', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        ...(token ? { 'X-CSRF-TOKEN': token } : {})
                    },
                    body: JSON.stringify({ slug })
                }).catch(() => {});
            } catch (e) {
                // silently ignore
            }
        };
    });
