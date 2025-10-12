@extends('admin.layout')

@section('content')

@if(session('status'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
@endif

<x-datatable id="admin-hero-slides-table"
    title="Hero Slides"
    searchPlaceholder="Search slides…"
    :addRoute="route('admin.hero-slides.create')"
    buttonIcon="bi bi-plus-lg"
    addText="Add Slide"
    {{-- export="false" --}}
    >
    <thead>
        <tr class="text-uppercase text-nowrap">
            <th>SN</th>
            <th>Image</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Primary CTA</th>
            <th>Secondary CTA</th>
            <th>Order</th>
            <th>Status</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($slides as $slide)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td style="width: 140px;">
                @php $img = $slide->image ? asset('img/' . $slide->image) : asset('img/hero-slider-1.jpg'); @endphp
                <img src="{{ $img }}" alt="{{ $slide->title }}" class="w-32 h-20 object-cover rounded border border-gray-200" />
            </td>
            <td>{{ $slide->title }}</td>
            <td class="text-nowrap">{{ $slide->subtitle }}</td>
            <td>
                @if($slide->primary_label)
                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">{{ $slide->primary_label }}</span>
                @endif
            </td>
            <td>
                @if($slide->secondary_label)
                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700">{{ $slide->secondary_label }}</span>
                @endif
            </td>
            <td>{{ $slide->sort_order }}</td>
            <td>
                <span class="px-2 py-1 text-xs rounded-full {{ $slide->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                    {{ $slide->is_active ? 'Active' : 'Inactive' }}
                </span>
            </td>
            <td class="text-right flex items-center justify-end">
                <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="btn btn-sm btn-primary mr-2">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="inline" onsubmit="return confirm('Delete this slide?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</x-datatable>

@endsection
