@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Create Product</h2>

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-4 max-w-2xl">
    @csrf
    <div>
        <label class="block text-sm">Name</label>
        <input name="name" type="text" value="{{ old('name') }}" class="form-control mt-1 w-full" required />
        @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
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
        <label class="block text-sm">Upload gallery images (multiple)</label>
        <input name="product_galleries_files[]" type="file" multiple accept="image/*" class="form-control mt-1 w-full" />
        @error('product_galleries_files.*')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        <p class="text-xs text-gray-500 mt-1">Each selected gallery image gets its own caption field.</p>
        <div id="preview-gallery-images" class="flex flex-wrap gap-3 mt-3"></div>
        <div id="preview-gallery-images-count" class="mt-3 px-3 py-2 bg-blue-50 text-gray-700 rounded hidden">0 image(s) in total</div>
    </div>
    <div>
        <label class="block text-sm">Slug</label>
        <input name="slug" type="text" value="{{ old('slug') }}" class="form-control mt-1 w-full" required />
        @error('slug')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm">Serial</label>
        <input name="serial" type="text" value="{{ old('serial') }}" class="form-control mt-1 w-full" required />
        @error('serial')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
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
});
</script>
@endpush
@endsection
