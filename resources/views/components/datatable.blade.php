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
    'customPagination' => false,
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

        @if($customPagination)
            <div id="{{ $id }}-custom-pagination" class="mt-3 flex items-center justify-end gap-1"></div>
        @endif
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

    // Render custom pagination if enabled
    if (@json($customPagination)) {
        const container = document.getElementById(@json($id . '-custom-pagination'));
        const render = () => {
            if (!container) return;
            const info = table.page.info();
            const pages = info.pages;
            const current = info.page;
            const makeBtn = (label, disabled, onClick) => {
                const btn = document.createElement('button');
                btn.className = 'px-3 py-1 border rounded text-sm ' + (disabled ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-100');
                btn.textContent = label;
                if (!disabled) btn.addEventListener('click', onClick);
                return btn;
            };
            container.innerHTML = '';
            // Prev
            container.appendChild(makeBtn('Prev', current === 0, () => { table.page('previous').draw('page'); }));
            // Numbers (show up to 7 pages around current)
            const start = Math.max(0, current - 3);
            const end = Math.min(pages - 1, current + 3);
            for (let i = start; i <= end; i++) {
                const b = makeBtn(String(i + 1), false, () => { table.page(i).draw('page'); });
                if (i === current) b.classList.add('bg-black','text-white');
                container.appendChild(b);
            }
            // Next
            container.appendChild(makeBtn('Next', current >= pages - 1, () => { table.page('next').draw('page'); }));
        };
        render();
        table.on('draw', render);
    }

    // Component now supports optional export buttons and configurable options
});
</script>
