@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')
<div class="w-full bg-[#F2F0EC]">
    <div class="md:max-w-7xl w-full px-8 lg:px-0 md:mx-auto py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">My Wishlist</h1>

        <div id="full-wishlist" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            {{-- Wishlist items will be rendered here by JavaScript --}}
        </div>


        <div id="empty-wishlist-message" class="hidden bg-gray-100 p-6 rounded-lg text-center">
            <p class="text-gray-600 text-lg">Your wishlist is empty. Start adding products you love!</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-digi-orange hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">Browse Products</a>
        </div>
    </div>
</div>
@include('sections.need-help')
@endsection

@push('scripts')
<script>

</script>
@endpush
