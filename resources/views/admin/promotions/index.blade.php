@extends('admin.layout')

@section('content')
<div class="bg-white border rounded-lg p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Promotions</h2>
        <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary"><i class="mr-2 bi bi-plus-lg"></i>New Promotion</a>
    </div>

    @if(session('status'))
        <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded">
            {{ session('status') }}
        </div>
    @endif

    @if($promotions->count() === 0)
        <p class="text-gray-600">No promotions found.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($promotions as $promotion)
                        <tr>
                            <td class="px-4 py-2">
                                <img src="{{ $promotion->cover ? asset('img/'.$promotion->cover) : asset('img/digi-logo.svg') }}" alt="{{ $promotion->name }}" class="w-12 h-12 object-cover rounded border" />
                            </td>
                            <td class="px-4 py-2">
                                <div class="text-sm font-medium text-gray-900">{{ $promotion->name }}</div>
                                <div class="text-xs text-gray-500">Created {{ $promotion->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ $promotion->products_count }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ (int) ($promotion->views_sum ?? 0) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ optional($promotion->start_date)->format('Y-m-d') ?? '—' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ optional($promotion->end_date)->format('Y-m-d') ?? '—' }}</td>
                            <td class="px-4 py-2 text-sm">
                                @php($status = $promotion->status_label)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs
                                    {{ $status === 'Active' ? 'bg-green-100 text-green-800' : ($status === 'Scheduled' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.promotions.show', $promotion) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" onsubmit="return confirm('Delete this promotion?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $promotions->links() }}
        </div>
    @endif
@endsection
