<script>
  function openBuyModal(name, image, slug) {
    const modal = document.getElementById(`buyModal-${slug}`);

    // Show modal
    modal.classList.remove("hidden");
    modal.classList.add("flex");

    // Set product details
    document.getElementById(`modalProductName-${slug}`).textContent = name;
    document.getElementById(`modalProductImage-${slug}`).src = image;
    document.getElementById(`modalProductImage-${slug}`).alt = name;

    // Load map
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        showMapWithStores(position, slug);
      }, function () {
        alert("Location blocked or not available.");
      });
    } else {
      alert("Geolocation not supported by your browser.");
    }
  }

  function showMapWithStores(position, slug) {
    const userLat = position.coords.latitude;
    const userLng = position.coords.longitude;

    const userLatLng = [userLat, userLng];

    const map = L.map(`map-${slug}`).setView(userLatLng, 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker(userLatLng).addTo(map).bindPopup("You are here").openPopup();

    const stores = [
      {
        name: 'Jaden Home Store',
        lat: -6.7740129,
        lng: 39.1966954,
        address: 'Rose Garden Rd., Mikocheni',
        phone: '0768285151',
      },
      {
        name: 'DIGI Store',
        lat: -6.8147387,
        lng: 39.2879986,
        address: 'Maktaba Square, Posta',
        phone: '0793 333 444',
        email: 'info@digiappliances.com',
      },
      {
        name: 'Mashariki Electronics',
        lat: -6.786251,
        lng: 39.2153335,
        address: 'Kariakoo, Dar es Salaam',
        phone: '0793 333 444',
        email: 'info@digiappliances.com',
      },
    ];

    stores.forEach(store => {
      L.marker([store.lat, store.lng])
        .addTo(map)
        .bindPopup(`<strong>${store.name}</strong><br>${store.address || ''}<br>Phone: ${store.phone || 'N/A'}<br>Email: ${store.email || 'N/A'}`);
    });

    // ESC or click outside to close
    window.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') document.getElementById(`buyModal-${slug}`).classList.add("hidden");
    });

    document.getElementById(`buyModal-${slug}`).addEventListener('click', function (e) {
      if (e.target.id === `buyModal-${slug}`) this.classList.add("hidden");
    });

    document.getElementById(`storeList-${slug}`).innerHTML = stores.map(store =>
      `<div class="mb-2"><strong>${store.name}</strong><br><span>${store.address}</span></div>`
    ).join('');
  }
</script>
