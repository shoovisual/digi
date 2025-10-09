@extends('admin.layout')

@section('content')

<x-datatable id="admin-categories-table"
    title="Categories List"
    searchPlaceholder="Search categories…"
    :addRoute="null"
    addText="Add Category"
    export="false">
    <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>{{ $category->created_at?->format('d M, Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</x-datatable>

@endsection