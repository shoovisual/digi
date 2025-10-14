@extends('admin.layout')

@section('content')
<div class="bg-white border rounded-lg p-6 max-w-xl">
    <h3 class="text-lg font-semibold mb-4">Edit Return Reason</h3>
    <form action="{{ route('admin.return-reasons.update', $reason) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $reason->name) }}" class="w-full border rounded px-3 py-2" required />
        </div>
        <div class="flex items-center space-x-3">
            <label class="inline-flex items-center">
                <input type="checkbox" name="active" value="1" {{ $reason->active ? 'checked' : '' }} class="mr-2" /> Active
            </label>
            <div>
                <label class="block text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $reason->sort_order) }}" class="border rounded px-3 py-2 w-28" />
            </div>
        </div>
        <button class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection