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
                if (!mapElement) return;
                
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
                const map = L.map(mapElement.id).setView(center, 12);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);
                
                // Add user marker
                L.marker(center).addTo(map).bindPopup("You are here").openPopup();
                
                // Add store markers
                this.places = [
                    {
                        name: 'Jaden Home Store',
                        address: 'Rose Garden Rd., Mikocheni',
                        phone: '0768285151',
                        lat: -6.7740129,
                        lng: 39.1966954,
                    },
                    {
                        name: 'DIGI Store',
                        address: 'Maktaba Square, Posta',
                        phone: '0793 333 444',
                        email: 'info@digiappliances.com',
                        lat: -6.8147387,
                        lng: 39.2879986,
                    },
                    {
                        name: 'Mashariki Electronics',
                        address: 'Kariakoo, Dar es Salaam',
                        phone: '0793 333 444',
                        email: 'info@digiappliances.com',
                        lat: -6.786251,
                        lng: 39.2153335,
                    }
                ];
                
                // Add markers for each store
                this.places.forEach(store => {
                    L.marker([store.lat, store.lng])
                        .addTo(map)
                        .bindPopup(`<strong>${store.name}</strong><br>${store.address || ''}<br>Phone: ${store.phone || 'N/A'}<br>Email: ${store.email || 'N/A'}`);
                });
                
                // Update store list
                const storeListElement = document.getElementById(`storeList-${slug}`);
                if (storeListElement) {
                    storeListElement.innerHTML = this.places.map(store =>
                        `<div class="mb-2"><strong>${store.name}</strong><br><span>${store.address}</span></div>`
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
        const originalOpenBuyModal = window.openBuyModal;
        window.openBuyModal = function(name, image, slug) {
            // Dispatch a custom event that Alpine.js can listen for
            window.dispatchEvent(new CustomEvent('openBuyModalEvent', {
                detail: { name, image, slug }
            }));
            
            // Also call the original function for backward compatibility
            if (typeof originalOpenBuyModal === 'function') {
                originalOpenBuyModal(name, image, slug);
            }
        };
    });