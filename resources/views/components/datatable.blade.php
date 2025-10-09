@props([
    'id' => 'datatable',
    'title' => 'Products List',
    'searchPlaceholder' => 'Search…',
    'addRoute' => null,
    'addText' => 'Add Product',
    'export' => false,
])

<div class="card">
    <div class="card-header flex items-center justify-between px-4 py-3 border-b">
        <div>
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="flex items-center">
            @if($addRoute)
                <a href="{{ $addRoute }}" class="btn btn-md bg-black text-white">{{ $addText }}</a>
            @endif
        </div>
    </div>

    <div class="p-4">
        <div class="flex items-center justify-end mb-3">
            <div class="flex items-center gap-2">
                <input id="{{ $id }}-search" type="text" placeholder="{{ $searchPlaceholder }}" class="w-64 pl-12 placeholder:text-sm py-2 border rounded text-sm" />
                <i class="bi bi-search absolute ml-4 text-gray-400"></i>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="{{ $id }}" class="stripe hover w-full text-sm">
                {{ $slot }}
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableEl = document.getElementById(@json($id));
    if (!tableEl) return;

    const table = $(tableEl).DataTable({
        responsive: true,
        pageLength: 10,
        lengthChange: false,
        ordering: false,
        searching: false,
        paging: true,
        info: true,
        dom: 'frtip'
    });

    const searchEl = document.getElementById(@json($id . '-search'));
    if (searchEl) {
        searchEl.addEventListener('keyup', function() {
            table.search(this.value).draw();
        });
    }

    // Export buttons and triggers removed per requirement
});
</script>
