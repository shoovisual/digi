@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Add Hero Slide</h2>

<form method="POST" action="{{ route('admin.hero-slides.store') }}" enctype="multipart/form-data" class="space-y-4 max-w-3xl">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm">Title</label>
            <input name="title" type="text" value="{{ old('title') }}" class="form-control mt-1 w-full" />
            @error('title')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm">Subtitle</label>
            <input name="subtitle" type="text" value="{{ old('subtitle') }}" class="form-control mt-1 w-full" />
            @error('subtitle')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm">Desktop Image</label>
            <input name="image_file" type="file" accept="image/*" class="form-control mt-1 w-full" />
            <p class="text-xs text-gray-500 mt-1">Or set path in `img/` folder</p>
            <input name="image" type="text" value="{{ old('image') }}" placeholder="hero/uploads/xxx.jpg" class="form-control mt-1 w-full" />
            @error('image_file')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm">Tablet Image</label>
            <input name="tablet_image_file" type="file" accept="image/*" class="form-control mt-1 w-full" />
            <input name="tablet_image" type="text" value="{{ old('tablet_image') }}" placeholder="hero/uploads/xxx.jpg" class="form-control mt-1 w-full" />
            @error('tablet_image_file')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm">Mobile Image</label>
            <input name="mobile_image_file" type="file" accept="image/*" class="form-control mt-1 w-full" />
            <input name="mobile_image" type="text" value="{{ old('mobile_image') }}" placeholder="hero/uploads/xxx.jpg" class="form-control mt-1 w-full" />
            @error('mobile_image_file')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm">Primary Button Label</label>
            <input name="primary_label" type="text" value="{{ old('primary_label') }}" class="form-control mt-1 w-full" />
            <label class="block text-sm mt-2">Primary Button URL</label>
            <input name="primary_url" type="text" value="{{ old('primary_url') }}" class="form-control mt-1 w-full" />
        </div>
        <div>
            <label class="block text-sm">Secondary Button Label</label>
            <input name="secondary_label" type="text" value="{{ old('secondary_label') }}" class="form-control mt-1 w-full" />
            <label class="block text-sm mt-2">Secondary Button URL</label>
            <input name="secondary_url" type="text" value="{{ old('secondary_url') }}" class="form-control mt-1 w-full" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm">Sort Order</label>
            <input name="sort_order" type="number" min="0" value="{{ old('sort_order', 0) }}" class="form-control mt-1 w-full" />
        </div>
        <div class="flex items-center gap-2 mt-6">
            <input name="is_active" type="checkbox" value="1" {{ old('is_active', '1') ? 'checked' : '' }} />
            <label class="text-sm">Active</label>
        </div>
    </div>

    <div class="flex gap-2">
        <button type="submit" class="btn btn-primary">Save Slide</button>
        <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form>
@endsection