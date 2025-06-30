<!-- Rating and Actions -->

    @php
    // Generate once for this product card
    $rating       = rand(3, 5);      // ★★★☆☆ … ★★★★★
    $ratingsCount = rand(14, 52);   // 14‑52 reviews
@endphp

<div class="flex items-center gap-2">
    {{-- Stars --}}
    <div class="flex text-orange-400 text-sm">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $rating)
                {{-- Filled star --}}
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path d="M12 .587l3.668 7.568L24 9.75l-6 5.823L19.335 24 12 19.897 4.665 24 6 15.573 0 9.75l8.332-1.595z"/>
                </svg>
            @else
                {{-- Empty star --}}
                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 .587l3.668 7.568L24 9.75l-6 5.823L19.335 24 12 19.897 4.665 24 6 15.573 0 9.75l8.332-1.595z"/>
                </svg>
            @endif
        @endfor
    </div>

    {{-- Ratings count --}}
    <span class="text-sm text-blue-600 hover:underline cursor-pointer">
        {{ $ratingsCount }} Ratings
    </span>
</div>

