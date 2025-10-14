@extends('admin.layout')

@section('content')


@if(session('status'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
@endif

<x-datatable id="admin-products-table"
    title="Products List"
    searchPlaceholder="Search products…"
    :addRoute="route('admin.products.create')"
    buttonIcon="bi bi-plus-lg"
    addText="Add Product"
    :export="true"
    :options="[
        'ordering' => true,
        'buttons' => [
            [
                'extend' => 'excel',
                'exportOptions' => ['columns' => [0,2,3,4,5,6,8]]
            ]
        ],
        'columnDefs' => [
            ['targets' => [8], 'visible' => false]
        ]
    ]"
    >
    <thead>
        <tr class="text-uppercase text-nowrap">
            <th>SN</th>
            <th>Image</th>
            <th>Products</th>
            <th>Category</th>
            <th>Serial</th>
            <th>Views</th>
            <th>Created At</th>
            <th class="text-right">Actions</th>
            <th>Frontend Link</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="w-20">
                @php $img = $product->image ? asset('img/' . $product->image) : asset('img/products/default.jpg'); @endphp
                <img src="{{ $img }}" alt="{{ $product->name }}" class="w-20 h-20 object-contain rounded border border-gray-200" />
            </td>
            <td>
                <div class="flex items-center gap-3">
                    <div>
                        <div class="font-medium">{{ $product->name }}</div>
                        <div class="text-xs text-gray-500">{{ $product->product_short }}</div>
                    </div>
                </div>
            </td>
            <td class="text-nowrap">{{ optional($product->categoryRelation)->name ?? '-' }}</td>
            <td class="text-nowrap">{{ $product->serial }}</td>
            <td>
                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">{{ number_format($product->view_count ?? 0) }}</span>
            </td>
            <td class="text-nowrap">{{ optional($product->created_at)->format('d M, Y') }}</td>
            <td class="text-right flex items-center justify-end">
                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-primary mr-1">
                    <i class="bi bi-eye-fill"></i>
                </a>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning mr-1">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </td>
            <td class="text-nowrap">{{ route('products.show', $product) }}</td>
        </tr>
        @endforeach
    </tbody>
</x-datatable>
@endsection
