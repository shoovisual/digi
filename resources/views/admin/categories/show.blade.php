@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold">Category Details</h2>
    <div class="flex gap-2">
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-1 card p-4">
        <div class="mb-3">
            <div class="text-sm text-gray-600">Cover</div>
            @php $img = $category->cover_image ? asset('img/' . $category->cover_image) : asset('img/categories/default.jpg'); @endphp
            <img src="{{ $img }}" alt="{{ $category->name }}" class="w-full h-40 object-cover rounded border" />
        </div>
        <div>
            <div class="text-sm text-gray-600">Basic Info</div>
            <div class="mt-2 space-y-1">
                <div><span class="font-medium">Name:</span> {{ $category->name }}</div>
                <div><span class="font-medium">Icon:</span>
                    @if($category->icon)
                        <img src="{{ asset('img/' . $category->icon) }}" alt="{{ $category->name }} icon" class="inline-block align-middle w-8 h-8 object-contain rounded border border-gray-200 ml-2" />
                    @else
                        <span class="text-xs text-gray-500">—</span>
                    @endif
                </div>
                <div><span class="font-medium">Slug:</span> {{ $category->slug }}</div>
            </div>
            @if($category->description)
                <div class="mt-3">
                    <div class="text-sm text-gray-600">Description</div>
                    <div class="text-sm">{{ $category->description }}</div>
                </div>
            @endif
        </div>
    </div>

    <div class="md:col-span-2 card p-4">
        <h3 class="text-lg font-semibold mb-3">Products in this Category</h3>
        @if(($products ?? collect())->count() === 0)
            <p class="text-gray-600">No products found in this category.</p>
        @else
            <x-datatable id="admin-category-products"
                title=""
                searchPlaceholder="Search products…"
                :addRoute="null"
                :export="false"
                :options="['ordering' => false]">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Serial</th>
                        <th>Views</th>
                        <th>Added</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                        <tr>
                            <td class="text-wrap">{{ $p->name }}</td>
                            <td class="text-nowrap">{{ $p->serial }}</td>
                            <td class="text-nowrap">{{ number_format($p->view_count ?? 0) }}</td>
                            <td class="text-nowrap">{{ optional($p->created_at)->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </x-datatable>
        @endif
    </div>
</div>
@endsection
