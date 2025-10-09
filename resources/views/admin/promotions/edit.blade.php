@extends('admin.layout')

@section('content')
<div class="bg-white border rounded-lg p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Edit Promotion</h2>
        <a href="{{ route('admin.promotions.index') }}" class="text-blue-600">Back to list</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded">
            <ul class="list-disc pl-6 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.promotions.update', $promotion) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $promotion->name) }}" class="mt-1 block w-full border rounded px-3 py-2" required />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <div class="flex items-center gap-3 mt-1">
                <input type="text" id="promotion-slug-input" name="slug" value="{{ old('slug', $promotion->slug) }}" class="border rounded px-3 py-2 flex-1" disabled />
                <label class="inline-flex items-center gap-2 text-xs">
                    <input type="checkbox" name="manual_slug" id="promotion-slug-manual" class="rounded" {{ old('manual_slug') ? 'checked' : '' }} />
                    <span>Edit slug secara manual</span>
                </label>
            </div>
            <p class="text-xs text-gray-500 mt-1">Default: slug tetap. Centang untuk mengubah slug secara manual.</p>
            @error('slug')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Describe what this promotion is about">{{ old('description', $promotion->description) }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Optional. Up to 2000 characters.</p>
        </div>

        <div>
            <label for="cover_file" class="block text-sm font-medium text-gray-700">Cover Image</label>
            <input type="file" id="cover_file" name="cover_file" accept="image/*" class="mt-1 block w-full border rounded px-3 py-2" />
            <p class="text-xs text-gray-500 mt-1">Accepted: jpg, jpeg, png, webp, avif. Max 5MB.</p>
            @if($promotion->cover)
                <div class="mt-2">
                    <div class="text-xs text-gray-500 mb-1">Current cover:</div>
                    <img src="{{ asset('img/'.$promotion->cover) }}" alt="{{ $promotion->name }}" class="w-32 h-20 object-cover rounded border" />
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', optional($promotion->start_date)->format('Y-m-d')) }}" min="{{ now()->toDateString() }}" required class="mt-1 block w-full border rounded px-3 py-2" />
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date', optional($promotion->end_date)->format('Y-m-d')) }}" min="{{ old('start_date', optional($promotion->start_date)->format('Y-m-d') ?? now()->toDateString()) }}" required class="mt-1 block w-full border rounded px-3 py-2" />
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Products in Promotion</label>
            <div class="max-h-64 overflow-y-auto border rounded p-3">
                @php($selected = $promotion->products->pluck('id'))
                @forelse($products as $product)
                    <label class="flex items-center gap-2 py-1">
                        <input type="checkbox" name="products[]" value="{{ $product->id }}" class="rounded"
                               @checked(collect(old('products', $selected))->contains($product->id)) />
                        <span class="text-sm text-gray-900">{{ $product->name }}</span>
                        @if($product->category)
                            <span class="text-xs text-gray-500">({{ $product->category->name }})</span>
                        @endif
                    </label>
                @empty
                    <p class="text-sm text-gray-600">No products available.</p>
                @endforelse
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Save Changes</button>
        </div>
    </form>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cb = document.getElementById('promotion-slug-manual');
    const input = document.getElementById('promotion-slug-input');
    function sync() {
        const en = !!(cb && cb.checked);
        if (input) {
            input.disabled = !en;
            input.classList.toggle('opacity-60', !en);
        }
    }
    if (cb) {
        cb.addEventListener('change', sync);
        sync();
    }
});
</script>
@endpush
@endsection
