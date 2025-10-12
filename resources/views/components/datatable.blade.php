@props([
    'id' => 'datatable',
    'title' => 'Products List',
    'searchPlaceholder' => 'Search…',
    'addRoute' => null,
    'buttonIcon' => null,
    'addText' => 'Add Product',
    'export' => false,
    'search' => true,
    'pageLength' => 10,
    'ordering' => false,
    'lengthChange' => false,
    'responsive' => true,
    'options' => [], // extra DataTables options (associative array)
])

<div class="card">
    <div class="card-header flex items-center justify-between px-4 py-3 border-b">
        <div>
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="flex items-center">
            @if($addRoute)
                <a href="{{ $addRoute }}" class="btn btn-md bg-black text-white"><i class="{{ $buttonIcon }} mr-1"></i> {{ $addText }}</a>
            @endif
        </div>
    </div>

    <div class="p-4">
        @if($search)
            <div class="flex items-center justify-end mb-3">
                <div class="flex items-center gap-2 relative">
                    <input id="{{ $id }}-search" type="text" placeholder="{{ $searchPlaceholder }}" class="w-64 pl-8 placeholder:text-sm py-2 border rounded text-sm" />
                    <i class="bi bi-search absolute left-2 text-gray-400"></i>
                </div>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table id="{{ $id }}" class="stripe-2 table-component row-border hover w-full text-sm">
                {{ $slot }}
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableEl = document.getElementById(@json($id));
    if (!tableEl) return;

    const baseOptions = {
        responsive: @json($responsive),
        pageLength: @json($pageLength),
        lengthChange: @json($lengthChange),
        ordering: @json($ordering),
        searching: false,
        paging: true,
        info: true,
        dom: 'frtip'
    };

    const extraOptions = @json($options);

    // Enable export buttons when requested
    if (@json($export)) {
        baseOptions.dom = 'Bfrtip';
        baseOptions.buttons = ['copy', 'csv', 'excel', 'print'];
    }

    const table = $(tableEl).DataTable(Object.assign({}, baseOptions, extraOptions));

    if (@json($search)) {
        const searchEl = document.getElementById(@json($id . '-search'));
        if (searchEl) {
            searchEl.addEventListener('keyup', function() {
                table.search(this.value).draw();
            });
        }
    }

    // Component now supports optional export buttons and configurable options
});
</script>
