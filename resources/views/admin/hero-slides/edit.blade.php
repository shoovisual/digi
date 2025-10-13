@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Hero Slide</h2>

<form method="POST" action="{{ route('admin.hero-slides.update', $slide) }}" enctype="multipart/form-data" class="space-y-4 max-w-3xl">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm">Title</label>
            <input name="title" type="text" value="{{ old('title', $slide->title) }}" class="form-control mt-1 w-full" />
            @error('title')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm">Subtitle</label>
            <input name="subtitle" type="text" value="{{ old('subtitle', $slide->subtitle) }}" class="form-control mt-1 w-full" />
            @error('subtitle')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm">Desktop Image</label>
            <input name="image_file" type="file" accept="image/*" class="form-control mt-1 w-full" />
            <input name="image" type="hidden" value="{{ old('image', $slide->image) }}" />
            <div class="mt-2">
                @php $img = $slide->image ? asset('img/' . $slide->image) : null; @endphp
                @if($img)
                    <img src="{{ $img }}" alt="Current Desktop" class="w-32 h-20 object-cover rounded border" />
                @endif
            </div>
        </div>
        <div>
            <label class="block text-sm">Tablet Image</label>
            <input name="tablet_image_file" type="file" accept="image/*" class="form-control mt-1 w-full" />
            <input name="tablet_image" type="hidden" value="{{ old('tablet_image', $slide->tablet_image) }}" />
            <div class="mt-2">
                @php $timg = $slide->tablet_image ? asset('img/' . $slide->tablet_image) : null; @endphp
                @if($timg)
                    <img src="{{ $timg }}" alt="Current Tablet" class="w-32 h-20 object-cover rounded border" />
                @endif
            </div>
        </div>
        <div>
            <label class="block text-sm">Mobile Image</label>
            <input name="mobile_image_file" type="file" accept="image/*" class="form-control mt-1 w-full" />
            <input name="mobile_image" type="hidden" value="{{ old('mobile_image', $slide->mobile_image) }}" />
            <div class="mt-2">
                @php $mimg = $slide->mobile_image ? asset('img/' . $slide->mobile_image) : null; @endphp
                @if($mimg)
                    <img src="{{ $mimg }}" alt="Current Mobile" class="w-32 h-20 object-cover rounded border" />
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm">Primary Button Label</label>
            <input name="primary_label" type="text" value="{{ old('primary_label', $slide->primary_label) }}" class="form-control mt-1 w-full" />
            <label class="block text-sm mt-2">Primary Button URL</label>
            <input name="primary_url" type="text" value="{{ old('primary_url', $slide->primary_url) }}" class="form-control mt-1 w-full" />
        </div>
        <div>
            <label class="block text-sm">Secondary Button Label</label>
            <input name="secondary_label" type="text" value="{{ old('secondary_label', $slide->secondary_label) }}" class="form-control mt-1 w-full" />
            <label class="block text-sm mt-2">Secondary Button URL</label>
            <input name="secondary_url" type="text" value="{{ old('secondary_url', $slide->secondary_url) }}" class="form-control mt-1 w-full" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm">Sort Order</label>
            <input name="sort_order" type="number" min="0" value="{{ old('sort_order', $slide->sort_order) }}" class="form-control mt-1 w-full" />
        </div>
        <div class="flex items-center gap-2 mt-6">
            <input name="is_active" type="checkbox" value="1" {{ old('is_active', $slide->is_active) ? 'checked' : '' }} />
            <label class="text-sm">Active</label>
        </div>
    </div>

    <div class="flex gap-2">
        <button type="submit" class="btn btn-primary">Update Slide</button>
        <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form>
@endsection