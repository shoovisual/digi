@extends('admin.layout')

@section('content')
<div class="bg-white border rounded-lg p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">New Promotion</h2>
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

    <form action="{{ route('admin.promotions.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf



        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full border rounded px-3 py-2" required />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <div class="flex items-center gap-3 mt-1">
                <input type="text" id="promotion-slug-input" name="slug" value="{{ old('slug') }}" class="border rounded px-3 py-2 flex-1" disabled />
                <label class="inline-flex items-center gap-2 text-xs">
                    <input type="checkbox" name="manual_slug" id="promotion-slug-manual" class="rounded" {{ old('manual_slug') ? 'checked' : '' }} />
                    <span>Edit slug secara manual</span>
                </label>
            </div>
            <p class="text-xs text-gray-500 mt-1">Default: slug dibuat otomatis dari nama promosi. Centang untuk mengisi/ubah secara manual.</p>
            @error('slug')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Describe what this promotion is about">{{ old('description') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Optional. Up to 2000 characters.</p>
        </div>

        <div>
            <label for="cover_file" class="block text-sm font-medium text-gray-700">Cover Image</label>
            <input type="file" id="cover_file" name="cover_file" accept="image/*" class="mt-1 block w-full border rounded px-3 py-2" />
            <p class="text-xs text-gray-500 mt-1">Accepted: jpg, jpeg, png, webp, avif. Max 5MB.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" min="{{ now()->toDateString() }}" required class="mt-1 block w-full border rounded px-3 py-2" />
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" min="{{ old('start_date', now()->toDateString()) }}" required class="mt-1 block w-full border rounded px-3 py-2" />
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Products in Promotion</label>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($products as $product)
                            <div class="border rounded-lg overflow-hidden bg-white">
                                <input type="checkbox" name="products[]" value="{{ $product->id }}" class="product-checkbox hidden"
                                       @checked(collect(old('products', []))->contains($product->id)) />
                                <div class="p-3 flex items-center gap-3">
                                    @php $pimg = $product->image ? asset('img/' . $product->image) : asset('img/products/default.jpg'); @endphp
                                    <button type="button"
                                            class="add-to-promo-btn px-2 py-1 rounded text-white text-sm"
                                            data-product-id="{{ $product->id }}"
                                            data-product-name="{{ $product->name }}"
                                            data-product-image="{{ $pimg }}"
                                            data-product-category="{{ $product->category->name ?? '' }}">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                    <img src="{{ $pimg }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded border" />
                                    <div class="flex-1">
                                        <div class="font-medium text-sm text-gray-900">
                                            {{ Str::limit($product->name, 20) }}
                                        </div>
                                        @if($product->category)
                                            <div class="text-xs text-gray-500">{{ $product->category->name }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-600">No products available.</p>
                        @endforelse
                    </div>
                </div>
                <div>
                    <div class="border rounded-lg p-3 bg-gray-50">
                        <div class="text-sm font-medium mb-2">Selected Products</div>
                        <div id="selected-products-list" class="space-y-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Create Promotion</button>
        </div>
    </form>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Slug toggle
    const cb = document.getElementById('promotion-slug-manual');
    const input = document.getElementById('promotion-slug-input');
    function syncSlug() {
        const en = !!(cb && cb.checked);
        if (input) {
            input.disabled = !en;
            input.classList.toggle('opacity-60', !en);
        }
    }
    if (cb) {
        cb.addEventListener('change', syncSlug);
        syncSlug();
    }

    // Product selection UI
    const selectedList = document.getElementById('selected-products-list');
    const buttons = document.querySelectorAll('.add-to-promo-btn');

    function checkboxFor(id) {
        return document.querySelector(`input.product-checkbox[value="${id}"]`);
    }

    function updateButton(btn, checked) {
        btn.innerHTML = checked ? '<i class="bi bi-trash"></i>' : '<i class="bi bi-plus"></i>';
        btn.classList.toggle('bg-red-600', checked);
        btn.classList.toggle('hover:bg-red-700', checked);
        btn.classList.toggle('bg-gray-300', !checked);
        btn.classList.toggle('text-gray-800', !checked);
    }

    function renderSelected() {
        if (!selectedList) return;
        const selected = Array.from(document.querySelectorAll('input.product-checkbox:checked'));
        if (selected.length === 0) {
            selectedList.innerHTML = '<p class="text-xs text-gray-500">No products selected.</p>';
            return;
        }
        const items = selected.map(cb => {
            const btn = document.querySelector(`.add-to-promo-btn[data-product-id="${cb.value}"]`);
            const name = btn?.dataset.productName || 'Unknown';
            const img = btn?.dataset.productImage || '';
            const cat = btn?.dataset.productCategory || '';
            return `
                <div class="flex flex-col gap-2">
                    <img src="${img}" alt="${name}" class="w-24 h-24 object-cover rounded border" />
                    <div>
                        <div class="text-sm font-medium text-gray-900">${name}</div>
                        ${cat ? `<div class=\"text-xs text-gray-500\">${cat}</div>` : ''}
                    </div>

                </div>`;
        });
        selectedList.innerHTML = items.join('');
    }

    buttons.forEach(btn => {
        const id = btn.dataset.productId;
        const cbx = checkboxFor(id);
        const checked = !!(cbx && cbx.checked);
        updateButton(btn, checked);
        btn.addEventListener('click', () => {
            if (!cbx) return;
            cbx.checked = !cbx.checked;
            updateButton(btn, cbx.checked);
            renderSelected();
        });
    });

    renderSelected();
});
</script>
@endpush
@endsection
