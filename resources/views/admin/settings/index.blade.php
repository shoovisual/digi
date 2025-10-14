@extends('admin.layout')

@section('content')
<div class="space-y-6">
    <div class="bg-white border rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-2">Settings</h3>
        <p class="text-sm text-gray-600">Configure global options and quick-access management links.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white border rounded-lg p-6">
            <div class="flex items-center justify-between mb-2">
                <h4 class="font-semibold">Return Reasons</h4>
                <a href="{{ route('admin.return-reasons.index') }}" class="btn btn-primary">Manage</a>
            </div>
            <p class="text-sm text-gray-600">Create and organize reasons customers can select when returning or cancelling an order.</p>
        </div>
        <!-- Add more settings cards here as needed -->
    </div>
</div>
@endsection