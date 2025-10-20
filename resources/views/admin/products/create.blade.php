@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Create Product</h2>

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
        <label class="block text-sm">Name</label>
        <input name="name" type="text" value="{{ old('name') }}" class="form-control mt-1 w-full" required id="product-name-input" />
        @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm">Product Short</label>
        <input name="product_short" type="text" value="{{ old('product_short') }}" class="form-control mt-1 w-full" id="product-short-input" />
        <p class="text-xs text-gray-500 mt-1">Auto-generated from product name (text before first dash). You can override this manually.</p>
        @error('product_short')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm">Upload main image</label>
            <input name="image_file" type="file" accept="image/*" class="form-control mt-1 w-full" />
            @error('image_file')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-500 mt-1">Accepts jpg, jpeg, png, webp, avif. Max 5MB.</p>
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
        </div>
    </div>
    <div>
        <label class="block text-sm">Product Gallery</label>
        <p class="text-xs text-gray-500 mt-1">Add items with caption; each row is one gallery image.</p>
        <div id="gallery-list" class="space-y-4 mt-2">
            <div class="gallery-row border rounded p-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                    <div>
                        <label class="block text-sm">Caption *</label>
                        <input name="product_galleries_captions[]" type="text" class="form-control mt-1 w-full" placeholder="Enter caption" required />
                    </div>
                    <div>
                        <label class="block text-sm">Gallery Image *</label>
                        <input id="gallery-file-1" name="product_galleries_files[]" type="file" accept="image/*" class="hidden" />
                        <label for="gallery-file-1" class="btn btn-primary w-full mt-1">Choose Image</label>
                        <div class="text-xs text-gray-500 mt-1 gallery-file-name">No image selected</div>
                        @error('product_galleries_files.0')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mt-3 flex justify-end">
                    <button type="button" class="btn btn-outline-danger gallery-remove"><i class="bi bi-trash"></i> Remove</button>
                </div>
            </div>
        </div>
        <button type="button" id="add-gallery-row" class="btn btn-outline-secondary mt-3"><i class="bi bi-plus-lg"></i> Add Another Gallery</button>
    </div>
    <div>
        <label class="block text-sm">Slug</label>
        <div class="flex items-center gap-3 mt-1">
            <input name="slug" type="text" value="{{ old('slug') }}" class="form-control flex-1" id="product-slug-input" disabled />
            <label class="inline-flex items-center gap-2 text-xs">
                <input type="checkbox" name="manual_slug" id="product-slug-manual" class="form-checkbox" {{ old('manual_slug') ? 'checked' : '' }} />
                <span>Edit slug secara manual</span>
            </label>
        </div>
        <p class="text-xs text-gray-500 mt-1">Default: slug dibuat otomatis dari nama produk. Centang untuk mengisi/ubah secara manual.</p>
        @error('slug')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm">Serial</label>
        <input name="serial" type="text" value="{{ old('serial') }}" class="form-control mt-1 w-full" required />
        @error('serial')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm">Price</label>
        <input name="price" type="number" step="0.01" min="0" value="{{ old('price') }}" class="form-control mt-1 w-full" />
        @error('price')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm">Category</label>
        <select name="category_id" class="form-select mt-1 w-full" required>
            <option value="">Select category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id')==$cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
        @error('category_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm">Image path (optional)</label>
        <input name="image" type="text" value="{{ old('image') }}" class="form-control mt-1 w-full" />
        @error('image')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm">Description</label>
        <textarea name="description" rows="4" class="form-control mt-1 w-full">{{ old('description') }}</textarea>
        @error('description')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm">Features</label>
        <div id="features-list" class="space-y-2">
            <div class="flex gap-2">
                <input name="features[]" type="text" value="{{ old('features.0') }}" class="form-control flex-1" placeholder="Enter a feature" />
                <button type="button" class="btn btn-outline-secondary" onclick="addFeatureRow()">Add</button>
            </div>
            @if(old('features'))
                @foreach(array_slice(old('features'), 1) as $f)
                    <div class="flex gap-2">
                        <input name="features[]" type="text" value="{{ $f }}" class="form-control flex-1" placeholder="Enter a feature" />
                        <button type="button" class="btn btn-outline-secondary" onclick="removeRow(this)">Remove</button>
                    </div>
                @endforeach
            @endif
        </div>
        <p class="text-xs text-gray-500 mt-1">Add multiple product features. Empty rows are ignored.</p>
    </div>
    <div>
        <label class="block text-sm">Specifications</label>
        <div id="specs-list" class="space-y-2">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <input name="spec_keys[]" type="text" value="{{ old('spec_keys.0') }}" class="form-control" placeholder="Key (e.g., screen_size)" />
                <input name="spec_values[]" type="text" value="{{ old('spec_values.0') }}" class="form-control" placeholder="Value (e.g., 55 inches)" />
                <div class="flex gap-2">
                    <button type="button" class="btn btn-outline-secondary" onclick="addSpecRow()">Add</button>
                </div>
            </div>
            @if(old('spec_keys'))
                @foreach(array_slice(old('spec_keys'), 1) as $i => $k)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <input name="spec_keys[]" type="text" value="{{ $k }}" class="form-control" placeholder="Key" />
                        <input name="spec_values[]" type="text" value="{{ old('spec_values.' . ($i+1)) }}" class="form-control" placeholder="Value" />
                        <div class="flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" onclick="removeRow(this)"><i class="bi bi-x"></i></button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <p class="text-xs text-gray-500 mt-1">Add key/value specifications. Only pairs with both fields filled are saved.</p>
    </div>
    <div class="flex gap-2">
        <button type="submit" class="btn btn-primary">Save</button>
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

// Gallery preview with per-item caption inputs
function setupGalleryPreviewWithCaptions(inputEl, listEl, countEl) {
    if (!inputEl) return;
    let dt = new DataTransfer();
    let captions = [];

    function render() {
        listEl.innerHTML = '';
        const files = Array.from(dt.files);
        files.forEach((file, idx) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'relative w-28';
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.alt = 'Preview';
            img.className = 'w-24 h-24 object-cover rounded border';
            const caption = document.createElement('input');
            caption.type = 'text';
            caption.name = 'product_galleries_captions[]';
            caption.placeholder = 'Caption';
            caption.value = captions[idx] || '';
            caption.className = 'form-control mt-1 w-24 text-xs';
            caption.addEventListener('input', () => { captions[idx] = caption.value; });
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full';
            btn.textContent = '×';
            btn.addEventListener('click', () => {
                const newDt = new DataTransfer();
                Array.from(dt.files).forEach((f, i) => { if (i !== idx) newDt.items.add(f); });
                dt = newDt;
                captions.splice(idx, 1);
                inputEl.files = dt.files;
                render();
            });
            wrapper.appendChild(img);
            wrapper.appendChild(btn);
            wrapper.appendChild(caption);
            listEl.appendChild(wrapper);
        });
        if (countEl) {
            countEl.textContent = `${files.length} image(s) in total`;
            countEl.classList.toggle('hidden', files.length === 0);
        }
    }

    inputEl.addEventListener('change', () => {
        Array.from(inputEl.files).forEach(file => { dt.items.add(file); captions.push(''); });
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

    // Live slug generation from product name
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
        // Initialize on load if not manual
        updateSlugPreview();
    }

    // Auto-generate product_short from product name
    const productShortInput = document.getElementById('product-short-input');
    function generateProductShort(name) {
        if (!name) return '';
        // Check for em dash first, then regular dash
        if (name.includes('–')) {
            return name.split('–')[0].trim();
        } else if (name.includes('-')) {
            return name.split('-')[0].trim();
        }
        return name;
    }
    function updateProductShort() {
        if (!productShortInput || !nameInput) return;
        // Only auto-generate if the field is empty or hasn't been manually edited
        if (productShortInput.value === '' || !productShortInput.dataset.manuallyEdited) {
            productShortInput.value = generateProductShort(nameInput.value);
        }
    }
    if (nameInput && productShortInput) {
        nameInput.addEventListener('input', updateProductShort);
        nameInput.addEventListener('change', updateProductShort);
        // Mark as manually edited when user types in product_short field
        productShortInput.addEventListener('input', function() {
            productShortInput.dataset.manuallyEdited = 'true';
        });
        // Initialize on load
        updateProductShort();
    }
});
</script>
@endpush
@endsection
