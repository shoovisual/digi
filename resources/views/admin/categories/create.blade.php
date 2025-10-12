@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold">Add Category</h2>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Back</a>
}</div>

@if($errors->any())
    <div class="mb-3 p-3 bg-red-50 text-red-700 border border-red-200 rounded">
        <ul class="mb-0">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data" class="card p-4 space-y-4">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required />
        </div>
        <div>
            <label class="block text-sm">Icon (CSS class)</label>
            <input type="text" name="icon" value="{{ old('icon') }}" class="form-control" placeholder="e.g., bi bi-tv" />
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
        <div>
            <label class="block text-sm">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}" id="category-slug-input" class="form-control opacity-60" disabled />
            <div class="form-check mt-1">
                <input type="checkbox" name="manual_slug" id="category-slug-manual" class="form-check-input" {{ old('manual_slug') ? 'checked' : '' }} />
                <label for="category-slug-manual" class="form-check-label text-sm">Edit slug manually</label>
            </div>
        </div>
        <div>
            <label class="block text-sm">Cover Image</label>
            <input type="file" name="cover_file" accept="image/*" class="form-control" />
        </div>
    </div>

    <div class="flex justify-end gap-2">
        <button type="submit" class="btn btn-primary">Create Category</button>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const manualCb = document.getElementById('category-slug-manual');
    const slugInput = document.getElementById('category-slug-input');
    const nameInput = document.querySelector('input[name="name"]');
    function syncSlugState() {
        const enabled = !!(manualCb && manualCb.checked);
        if (slugInput) {
            slugInput.disabled = !enabled;
            slugInput.classList.toggle('opacity-60', !enabled);
        }
    }
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
            return (str || '').toLowerCase().replace(/[^a-z0-9\s-]/g, '').trim().replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');
        }
    }
    function updateSlugPreview() {
        if (!manualCb || !slugInput || !nameInput) return;
        if (!manualCb.checked) {
            slugInput.value = slugify(nameInput.value);
        }
    }
    if (manualCb) {
        manualCb.addEventListener('change', syncSlugState);
        syncSlugState();
    }
    if (nameInput) {
        nameInput.addEventListener('input', updateSlugPreview);
        nameInput.addEventListener('change', updateSlugPreview);
        updateSlugPreview();
    }
});
</script>
@endpush
@endsection