@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold">Product Details</h2>
    <div class="flex gap-2">
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
    </div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-1 card p-4">
        <div class="mb-3">
            <div class="text-sm text-gray-600">Main Image</div>
            @php $img = $product->image ? asset('img/' . $product->image) : asset('img/products/default.jpg'); @endphp
            <img src="{{ $img }}" alt="{{ $product->name }}" class="w-full h-48 object-contain rounded border" />
        </div>
        <div>
            <div class="text-sm text-gray-600">Basic Info</div>
            <div class="mt-2 space-y-1">
                <div><span class="font-medium">Name:</span> {{ $product->name }}</div>
                <div><span class="font-medium">Serial:</span> {{ $product->serial }}</div>
                <div><span class="font-medium">Category:</span> {{ optional($product->categoryRelation)->name }}</div>
                <div><span class="font-medium">Slug:</span> {{ $product->slug }}</div>
            </div>
        </div>
    </div>

    <div class="md:col-span-2 card p-4">
        <div class="mb-4">
            <div class="text-sm text-gray-600">Description</div>
            <div class="mt-2">{!! nl2br(e($product->description)) !!}</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="text-sm text-gray-600">Product Images</div>
                <div class="mt-2 flex flex-wrap gap-3">
                    @php $pimgs = is_array($product->product_images) ? $product->product_images : (json_decode($product->product_images ?? '[]', true) ?: []); @endphp
                    @forelse($pimgs as $pi)
                        <img src="{{ asset('img/' . $pi) }}" class="w-24 h-24 object-cover rounded border" alt="Product image" />
                    @empty
                        <div class="text-sm text-gray-500">No product images</div>
                    @endforelse
                </div>
            </div>
            <div>
                <div class="text-sm text-gray-600">Gallery</div>
                <div class="mt-2 grid grid-cols-2 gap-3">
                    @php $gals = is_array($product->product_galleries) ? $product->product_galleries : (json_decode($product->product_galleries ?? '{}', true) ?: []); @endphp
                    @forelse($gals as $caption => $path)
                        <div class="border rounded p-2">
                            <img src="{{ asset('img/' . $path) }}" class="w-full h-24 object-cover rounded border" alt="Gallery image" />
                            <div class="mt-2 text-xs text-gray-700">{{ $caption }}</div>
                        </div>
                    @empty
                        <div class="text-sm text-gray-500">No gallery images</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div>
                <div class="text-sm text-gray-600">Features</div>
                @php $features = is_array($product->features) ? $product->features : (json_decode($product->features ?? '[]', true) ?: []); @endphp
                @if(!empty($features))
                    <ul class="mt-2 list-disc pl-5">
                        @foreach($features as $f)
                            <li>{{ $f }}</li>
                        @endforeach
                    </ul>
                @else
                    <div class="mt-2 text-sm text-gray-500">No features</div>
                @endif
            </div>
            <div>
                <div class="text-sm text-gray-600">Specifications</div>
                @php $specs = is_array($product->specifications) ? $product->specifications : (json_decode($product->specifications ?? '{}', true) ?: []); @endphp
                @if(!empty($specs))
                    <table class="mt-2 table table-sm">
                        <tbody>
                        @foreach($specs as $k => $v)
                            <tr>
                                <td class="font-medium w-40">{{ $k }}</td>
                                <td>{{ $v }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="mt-2 text-sm text-gray-500">No specifications</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection