@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Product</h2>

<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm">Name</label>
        <input name="name" type="text" value="{{ old('name', $product->name) }}" class="form-control mt-1 w-full" required />
        @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm">Upload main image</label>
            <input name="image_file" type="file" accept="image/*" class="form-control mt-1 w-full" />
            @error('image_file')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            @if($product->image)
                <p class="text-xs text-gray-500 mt-1">Current: <span class="underline">{{ $product->image }}</span></p>
                <div class="mt-2">
                    <img src="{{ asset('img/' . $product->image) }}" alt="Current main image" class="w-24 h-24 object-cover rounded border" />
                </div>
            @endif
            <div id="preview-main-image" class="mt-2 hidden">
                <div class="relative inline-block">
                    <img id="preview-main-image-img" src="" alt="Preview" class="w-24 h-24 object-cover rounded border" />
                    <button type="button" id="preview-main-image-clear" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full">×</button>
                </div>
            </div>
        </div>
        <div>
            <label class="block text-sm">Upload product images (multiple)</label>
            <input name="product_images_files[]" type="file" multiple accept="image/*" class="form-control mt-1 w-full" />
            @error('product_images_files.*')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            <div id="preview-product-images" class="flex flex-wrap gap-3 mt-3"></div>
            <div id="preview-product-images-count" class="mt-3 px-3 py-2 bg-blue-50 text-gray-700 rounded hidden">0 image(s) in total</div>
            @php
                $existingImages = is_array($product->product_images)
                    ? $product->product_images
                    : (json_decode($product->product_images ?? '[]', true) ?: []);
            @endphp
            @if(!empty($existingImages))
                <div class="mt-3">
                    <div class="text-xs text-gray-600 mb-2">Current Product Images</div>
                    <p class="text-xs text-gray-500 mb-2">Click the trash icon to remove instantly; new uploads are appended.</p>
                    <div id="existing-product-images-list" class="flex flex-wrap gap-3">
                        @foreach($existingImages as $path)
                            <div class="existing-image-item relative gap-3">
                                <img src="{{ asset('img/' . $path) }}" class="w-24 h-24 object-cover rounded border" alt="Product image" />
                                <button type="button" class="remove-product-image btn btn-sm btn-danger mt-2" data-path="{{ $path }}" title="Remove">
                                    <i class="bi bi-trash-fill mr-2"></i>Delete
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div>
        <label class="block text-sm">Product Gallery</label>
        <p class="text-xs text-gray-500 mt-1">Click the trash icon to remove instantly; new uploads are appended.</p>
        @php
            $existingGalleries = is_array($product->product_galleries)
                ? $product->product_galleries
                : (json_decode($product->product_galleries ?? '{}', true) ?: []);
        @endphp
        @if(!empty($existingGalleries))
            <div class="mt-3">
                <div class="text-xs text-gray-600 mb-2">Current Gallery</div>
                <div id="existing-gallery-list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($existingGalleries as $caption => $path)
                        <div class="existing-gallery-item relative border rounded p-3 flex items-start gap-3">
                            <img src="{{ asset('img/' . $path) }}" class="w-20 h-20 object-cover rounded border" alt="{{ $caption }}" />
                            <div>
                                <div class="font-medium">{{ $caption }}</div>
                                <div class="text-xs text-gray-500 break-all">{{ $path }}</div>
                            </div>
                            <button type="button" class="remove-gallery-image absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full" data-path="{{ $path }}" title="Remove">×</button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <div id="gallery-list" class="space-y-4 mt-2"></div>
        <button type="button" id="add-gallery-row" class="btn btn-outline-secondary mt-3"><i class="bi bi-plus-lg"></i> Add Another Gallery</button>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block text-sm">Slug</label>
            <div class="flex flex-col gap-3 mt-1">
                <input name="slug" type="text" value="{{ old('slug', $product->slug) }}" class="form-control flex-1" id="product-slug-input" disabled />
                <label class="inline-flex items-center gap-2 text-xs">
                    <input type="checkbox" name="manual_slug" id="product-slug-manual" class="form-checkbox" {{ old('manual_slug') ? 'checked' : '' }} />
                    <span>Edit slug</span>
                </label>
            </div>
            <p class="text-xs text-gray-500 mt-1">Default: slug tetap. Centang untuk mengubah slug secara manual.</p>
            @error('slug')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm">Serial</label>
            <input name="serial" type="text" value="{{ old('serial', $product->serial) }}" class="form-control mt-1 w-full" required />
            @error('serial')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm">Category</label>
            <select name="category_id" class="form-select mt-1 w-full" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id)==$cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>
    {{-- <div>
        <label class="block text-sm">Image path (optional)</label>
        <input name="image" type="text" value="{{ old('image', $product->image) }}" class="form-control mt-1 w-full" />
        @error('image')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div> --}}
    <div>
        <label class="block text-sm">Description</label>
        <textarea name="description" rows="4" class="form-control mt-1 w-full">{{ old('description', $product->description) }}</textarea>
        @error('description')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm">Features</label>
        <div id="features-list" class="space-y-2">
            @php
                $existingFeatures = is_array($product->features) ? $product->features : (json_decode($product->features ?? '[]', true) ?: []);
                $existingFeatures = old('features') ?? $existingFeatures;
            @endphp
            @if(!empty($existingFeatures))
                @foreach($existingFeatures as $f)
                    <div class="flex gap-2">
                        <input name="features[]" type="text" value="{{ $f }}" class="form-control flex-1" placeholder="Enter a feature" />
                        <button type="button" class="btn btn-outline-secondary" onclick="removeRow(this)">Remove</button>
                    </div>
                @endforeach
            @else
                <div class="flex gap-2">
                    <input name="features[]" type="text" class="form-control flex-1" placeholder="Enter a feature" />
                    <button type="button" class="btn btn-outline-secondary" onclick="addFeatureRow()">Add</button>
                </div>
            @endif
            <div class="mt-2">
                <button type="button" class="btn btn-outline-secondary" onclick="addFeatureRow()">Add Feature</button>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-1">Add multiple product features. Empty rows are ignored.</p>
    </div>
    <div>
        <label class="block text-sm">Specifications</label>
        @php
            $existingSpecs = is_array($product->specifications) ? $product->specifications : (json_decode($product->specifications ?? '{}', true) ?: []);
            $specKeysOld = old('spec_keys');
            $specValsOld = old('spec_values');
        @endphp
        <div id="specs-list" class="space-y-2">
            @if($specKeysOld)
                @foreach($specKeysOld as $i => $k)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <input name="spec_keys[]" type="text" value="{{ $k }}" class="form-control" placeholder="Key" />
                        <input name="spec_values[]" type="text" value="{{ $specValsOld[$i] ?? '' }}" class="form-control" placeholder="Value" />
                        <div class="flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" onclick="removeRow(this)">Remove</button>
                        </div>
                    </div>
                @endforeach
            @elseif(!empty($existingSpecs))
                @foreach($existingSpecs as $k => $v)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <input name="spec_keys[]" type="text" value="{{ $k }}" class="form-control" placeholder="Key" />
                        <input name="spec_values[]" type="text" value="{{ $v }}" class="form-control" placeholder="Value" />
                        <div class="flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" onclick="removeRow(this)">Remove</button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <input name="spec_keys[]" type="text" class="form-control" placeholder="Key (e.g., screen_size)" />
                    <input name="spec_values[]" type="text" class="form-control" placeholder="Value (e.g., 55 inches)" />
                    <div class="flex gap-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="addSpecRow()">Add</button>
                    </div>
                </div>
            @endif
            <div class="mt-2">
                <button type="button" class="btn btn-outline-secondary" onclick="addSpecRow()">Add Spec</button>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-1">Add key/value specifications. Only pairs with both fields filled are saved.</p>
    </div>
    <div class="flex gap-2">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form>

@push('scripts')
<script>
function addFeatureRow() {
    const container = document.getElementById('features-list');
    const row = document.createElement('div');
    row.className = 'flex gap-2 mt-2';
    row.innerHTML = `
        <input name="features[]" type="text" class="form-control flex-1" placeholder="Enter a feature" />
        <button type="button" class="btn btn-outline-secondary" onclick="removeRow(this)">Remove</button>
    `;
    container.appendChild(row);
}
function addSpecRow() {
    const container = document.getElementById('specs-list');
    const row = document.createElement('div');
    row.className = 'grid grid-cols-1 md:grid-cols-3 gap-2 mt-2';
    row.innerHTML = `
        <input name="spec_keys[]" type="text" class="form-control" placeholder="Key" />
        <input name="spec_values[]" type="text" class="form-control" placeholder="Value" />
        <div class="flex gap-2">
            <button type="button" class="btn btn-outline-secondary" onclick="removeRow(this)">Remove</button>
        </div>
    `;
    container.appendChild(row);
}
function removeRow(btn) {
    const row = btn.closest('.flex') || btn.closest('.grid');
    if (row) row.remove();
}

// Image preview utilities
function setupSinglePreview(inputEl, imgEl, wrapperEl, clearBtn) {
    if (!inputEl) return;
    inputEl.addEventListener('change', () => {
        const file = inputEl.files && inputEl.files[0];
        if (!file) { wrapperEl.classList.add('hidden'); return; }
        const url = URL.createObjectURL(file);
        imgEl.src = url;
        wrapperEl.classList.remove('hidden');
    });
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            inputEl.value = '';
            imgEl.src = '';
            wrapperEl.classList.add('hidden');
        });
    }
}

function setupMultiPreview(inputEl, listEl, countEl) {
    if (!inputEl) return;
    let dt = new DataTransfer();

    function render() {
        listEl.innerHTML = '';
        const files = Array.from(dt.files);
        files.forEach((file, idx) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'relative w-24 h-24';
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.alt = 'Preview';
            img.className = 'w-24 h-24 object-cover rounded border';
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full';
            btn.textContent = '×';
            btn.addEventListener('click', () => {
                const newDt = new DataTransfer();
                Array.from(dt.files).forEach((f, i) => { if (i !== idx) newDt.items.add(f); });
                dt = newDt;
                inputEl.files = dt.files;
                render();
            });
            wrapper.appendChild(img);
            wrapper.appendChild(btn);
            listEl.appendChild(wrapper);
        });
        if (countEl) {
            countEl.textContent = `${files.length} image(s) in total`;
            countEl.classList.toggle('hidden', files.length === 0);
        }
    }

    inputEl.addEventListener('change', () => {
        Array.from(inputEl.files).forEach(file => dt.items.add(file));
        inputEl.files = dt.files;
        render();
    });
}

// Repeatable gallery rows (caption + individual image chooser)
function initGalleryRows() {
    const list = document.getElementById('gallery-list');
    const addBtn = document.getElementById('add-gallery-row');
    if (!list || !addBtn) return;

    let counter = list.querySelectorAll('.gallery-row').length;

    function attachRowEvents(row) {
        const fileInput = row.querySelector('input[type="file"][name="product_galleries_files[]"]');
        const fileNameEl = row.querySelector('.gallery-file-name');
        const removeBtn = row.querySelector('.gallery-remove');
        if (fileInput) {
            fileInput.addEventListener('change', () => {
                const f = fileInput.files && fileInput.files[0];
                fileNameEl && (fileNameEl.textContent = f ? f.name : 'No image selected');
            });
        }
        if (removeBtn) {
            removeBtn.addEventListener('click', () => {
                row.remove();
            });
        }
    }

    list.querySelectorAll('.gallery-row').forEach(attachRowEvents);

    addBtn.addEventListener('click', () => {
        counter += 1;
        const row = document.createElement('div');
        row.className = 'gallery-row border rounded p-3';
        row.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                <div>
                    <label class="block text-sm">Caption *</label>
                    <input name="product_galleries_captions[]" type="text" class="form-control mt-1 w-full" placeholder="Enter caption" required />
                </div>
                <div>
                    <label class="block text-sm">Gallery Image *</label>
                    <input id="gallery-file-${counter}" name="product_galleries_files[]" type="file" accept="image/*" class="hidden" />
                    <label for="gallery-file-${counter}" class="btn btn-primary w-full mt-1">Choose Image</label>
                    <div class="text-xs text-gray-500 mt-1 gallery-file-name">No image selected</div>
                </div>
            </div>
            <div class="mt-3 flex justify-end">
                <button type="button" class="btn btn-outline-danger gallery-remove"><i class="bi bi-trash"></i> Remove</button>
            </div>
        `;
        list.appendChild(row);
        attachRowEvents(row);
    });
}

// Existing product images instant removal (adds hidden inputs)
function initExistingImageRemovals() {
    const list = document.getElementById('existing-product-images-list');
    const form = document.querySelector('form');
    if (!list || !form) return;
    list.querySelectorAll('.remove-product-image').forEach(btn => {
        btn.addEventListener('click', () => {
            const path = btn.getAttribute('data-path');
            if (!path) return;
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'remove_product_image_paths[]';
            hidden.value = path;
            form.appendChild(hidden);
            const item = btn.closest('.existing-image-item');
            if (item) item.remove();
        });
    });
}

// Existing gallery instant removal (adds hidden inputs)
function initExistingGalleryRemovals() {
    const list = document.getElementById('existing-gallery-list');
    const form = document.querySelector('form');
    if (!list || !form) return;
    list.querySelectorAll('.remove-gallery-image').forEach(btn => {
        btn.addEventListener('click', () => {
            const path = btn.getAttribute('data-path');
            if (!path) return;
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'remove_gallery_paths[]';
            hidden.value = path;
            form.appendChild(hidden);
            const item = btn.closest('.existing-gallery-item');
            if (item) item.remove();
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    setupSinglePreview(
        document.querySelector('input[name="image_file"]'),
        document.getElementById('preview-main-image-img'),
        document.getElementById('preview-main-image'),
        document.getElementById('preview-main-image-clear')
    );
    setupMultiPreview(
        document.querySelector('input[name="product_images_files[]"]'),
        document.getElementById('preview-product-images'),
        document.getElementById('preview-product-images-count')
    );
    initGalleryRows();
    initExistingImageRemovals();
    initExistingGalleryRemovals();
    // Slug manual toggle
    const manualCb = document.getElementById('product-slug-manual');
    const slugInput = document.getElementById('product-slug-input');
    const nameInput = document.querySelector('input[name="name"]');
    function syncSlugState() {
        const enabled = !!(manualCb && manualCb.checked);
        if (slugInput) {
            slugInput.disabled = !enabled;
            slugInput.classList.toggle('opacity-60', !enabled);
        }
    }
    if (manualCb) {
        manualCb.addEventListener('change', syncSlugState);
        syncSlugState();
    }
    // Live slug generation from product name (preview only when manual is off)
    function slugify(str) {
        try {
            return (str || '')
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        } catch (e) {
            return (str || '')
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    }
    function updateSlugPreview() {
        if (!manualCb || !slugInput || !nameInput) return;
        if (!manualCb.checked) {
            slugInput.value = slugify(nameInput.value);
        }
    }
    if (nameInput) {
        nameInput.addEventListener('input', updateSlugPreview);
        nameInput.addEventListener('change', updateSlugPreview);
        // Initialize on load
        updateSlugPreview();
    }
});
</script>
@endpush
@endsection
