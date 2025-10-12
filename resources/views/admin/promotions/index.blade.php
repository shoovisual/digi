@extends('admin.layout')

@section('content')

    @if(session('status'))
        <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded">
            {{ session('status') }}
        </div>
    @endif

    @if($promotions->count() === 0)
        <p class="text-gray-600">No promotions found.</p>
    @else
        <x-datatable id="admin-promotions-table"
            title="Promotions"
            searchPlaceholder="Search promotions…"
            :addRoute="route('admin.promotions.create')"
            buttonIcon="bi bi-plus-lg"
            addText="New Promotion"
            :export="false"
            :options="['ordering' => true]">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Name</th>
                    <th>Products</th>
                    <th>Views</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promotions as $promotion)
                <tr>
                    <td>
                        <img src="{{ $promotion->cover ? asset('img/'.$promotion->cover) : asset('img/digi-logo.svg') }}" alt="{{ $promotion->name }}" class="w-12 h-12 object-cover rounded border" />
                    </td>
                    <td>
                        <div class="text-sm font-medium text-gray-900">{{ $promotion->name }}</div>
                        <div class="text-xs text-gray-500">Created {{ $promotion->created_at->diffForHumans() }}</div>
                    </td>
                    <td>{{ $promotion->products_count }}</td>
                    <td>{{ (int) ($promotion->views_sum ?? 0) }}</td>
                    <td>{{ optional($promotion->start_date)->format('Y-m-d') ?? '—' }}</td>
                    <td>{{ optional($promotion->end_date)->format('Y-m-d') ?? '—' }}</td>
                    <td>
                        @php($status = $promotion->status_label)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs
                            {{ $status === 'Active' ? 'bg-green-100 text-green-800' : ($status === 'Scheduled' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                            {{ $status }}
                        </span>
                    </td>
                    <td>
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
        </x-datatable>
    @endif
@endsection
