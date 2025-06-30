{{-- resources/views/partials/help-section.blade.php --}}
@php
    $helpCards = [
        [
            'title'       => 'Product Repairing',
            'description' => 'Request a repair for your DIGI product easily and quickly.',
            'link'        => '#',
            // replace with real icons or SVGs
            'icon'        => 'img/icons/icon_request-a-repair_60x60.svg',
        ],
        [
            'title'       => 'Product Support',
            'description' => 'Find Manual, troubleshoot and warranty of your DIGI product.',
            'link'        => '#',
            'icon'        => 'img/icons/icon_product_48.svg',
        ],
        [
            'title'       => 'Chat WhatsApp',
            'description' => 'Chat with our support team on WhatsApp for quick assistance.',
            'link'        => '#',
            'icon'        => 'img/icons/icon_whatsapp_60x60.svg',
        ],
        [
            'title'       => 'Order Support',
            'description' => 'Track your order, request a return or exchange, and more.',
            'link'        => '#',
            'icon'        => 'img/icons/icon_order_48.svg',
        ],
    ];
@endphp

<section class="bg-[#F2F0EC] py-16">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Section heading -->
        <div class="mb-10">
            <h2 class="text-3xl sm:text-4xl font-bold mb-2 text-black">Need help?</h2>
            <p class="text-lg text-gray-700 font-medium">We’re here to provide all the help you need.</p>
        </div>

        <!-- Cards grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($helpCards as $card)
                <a href="{{ $card['link'] }}" class="group relative block bg-white group rounded-xl p-6 hover:-translate-y-1 hover:shadow-lg transition ease-in-out duration-300">
                    <div class="card-content h-[320px] relative mb-5">
                        <!-- icon -->
                        <div class="flex justify-end mb-6"><img src="{{ $card['icon'] }}" alt="{{ $card['title'] }} Icon" class="w-15 h-15 object-contain"></div>
                        <div class="text">
                            <h3 class="text-4xl font-medium text-black mb-3">{{ $card['title'] }}</h3>
                            <p class="text-lg font-medium text-gray-600 mb-8 leading-relaxed">{{ $card['description'] }}</p>
                        </div>
                    </div>

                    <!-- arrow button -->
                    <span class="inline-flex items-center absolute bottom-6 justify-center w-15 h-15 border rounded-full group-hover:bg-digi-orange group-hover:text-white group-hover:scale-110 transition">
                        <svg width="32" class="group-hover:fill-white -rotate-45 fill-current" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M25.3012 15.2813L15.3322 5.00068L16.3641 4L28.0005 16L16.3641 28L15.3322 26.9993L25.3012 16.7187H4V15.2813H25.3012Z"/>
                        </svg>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
