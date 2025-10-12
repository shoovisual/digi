@extends('admin.layout')

@section('content')

<x-datatable id="admin-categories-table"
    title="Categories"
    searchPlaceholder="Search categories…"
    :addRoute="route('admin.categories.create')"
    buttonIcon="bi bi-plus-lg"
    addText="Add Category"
    :export="false"
    :options="['ordering' => false]"
    >
    <thead>
        <tr>
            <th>SN</th>
            <th>Cover</th>
            <th>Name</th>
            <th>Icon</th>
            <th>Slug</th>
            <th>Created</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td style="width: 120px;">
                @php $img = $category->cover_image ? asset('img/' . $category->cover_image) : asset('img/categories/default.jpg'); @endphp
                <img src="{{ $img }}" alt="{{ $category->name }}" class="w-20 h-14 object-cover rounded border border-gray-200" />
            </td>
            <td>{{ $category->name }}</td>
            <td style="width: 100px;">
                @if($category->icon)
                    <img src="{{ asset('img/' . $category->icon) }}" alt="{{ $category->name }} icon" class="w-8 h-8 object-contain rounded border border-gray-200" />
                @else
                    <span class="text-xs text-gray-500">—</span>
                @endif
            </td>
            <td>{{ $category->slug }}</td>
            <td class="text-nowrap">{{ $category->created_at?->format('M d, Y') }}</td>
            <td class="text-right text-nowrap">
                <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Delete this category?');">
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
