@extends('admin.layout')

@section('content')

<div x-data="returnReasonsModal()" x-init="initAddButton()">
    @if(session('status'))
        <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded">{{ session('status') }}</div>
    @endif

    <x-datatable id="return-reasons"
        title="Return Reasons"
        searchPlaceholder="Search reason"
        :addRoute="route('admin.return-reasons.index')"
        buttonIcon="bi bi-plus-lg"
        addText="New Reason"
        :export="false"
        customPagination="true"
        :options="['ordering' => false]">
            <thead>
                <tr>
                    <th class="py-3">Name</th>
                    <th class="py-3">Active</th>
                    <th class="py-3">Order</th>
                    <th class="py-3">Created By</th>
                    <th class="py-3 flex justify-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($reasons as $reason)
                <tr class="border-t">
                    <td class="py-3">{{ $reason->name }}</td>
                    <td class="py-3">{{ $reason->active ? 'Yes' : 'No' }}</td>
                    <td class="py-3">{{ $reason->sort_order }}</td>
                    <td class="py-3">{{ $reason->created_by_user->name ?? 'Admin' }}</td>
                    <td class="py-3 flex justify-end gap-x-2">
                        <button type="button" class="btn btn-sm btn-primary js-edit-reason"
                            data-id="{{ $reason->id }}"
                            data-name="{{ $reason->name }}"
                            data-active="{{ $reason->active ? '1' : '0' }}"
                            data-sort-order="{{ (int) $reason->sort_order }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <form action="{{ route('admin.return-reasons.destroy', $reason) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this reason?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="py-4 text-gray-600">No reasons found.</td></tr>
            @endforelse
            </tbody>
    </x-datatable>

    

    <!-- Create Modal -->
    <div x-show="showCreate" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50" @click="closeCreate()"></div>
        <div class="relative bg-white border rounded-lg p-6 w-full max-w-md shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">New Return Reason</h3>
                <button class="text-gray-500 hover:text-gray-700" @click="closeCreate()"><i class="bi bi-x-lg"></i></button>
            </div>
            <form action="{{ route('admin.return-reasons.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" required />
                </div>
                <div class="flex items-center space-x-3">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="active" value="1" checked class="mr-2" /> Active
                    </label>
                    <div>
                        <label class="block text-gray-700 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="0" class="border rounded px-3 py-2 w-28" />
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" class="btn" @click="closeCreate()">Cancel</button>
                    <button class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="showEdit" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50" @click="closeEdit()"></div>
        <div class="relative bg-white border rounded-lg p-6 w-full max-w-md shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Edit Return Reason</h3>
                <button class="text-gray-500 hover:text-gray-700" @click="closeEdit()"><i class="bi bi-x-lg"></i></button>
            </div>
            <form x-bind:action="'/admin/return-reasons/' + edit.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" x-bind:value="edit.name" class="w-full border rounded px-3 py-2" required />
                </div>
                <div class="flex items-center space-x-3">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="active" value="1" x-bind:checked="edit.active" class="mr-2" /> Active
                    </label>
                    <div>
                        <label class="block text-gray-700 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" x-bind:value="edit.sort_order" class="border rounded px-3 py-2 w-28" />
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" class="btn" @click="closeEdit()">Cancel</button>
                    <button class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function returnReasonsModal() {
    return {
        showCreate: false,
        showEdit: false,
        edit: { id: null, name: '', active: true, sort_order: 0 },
        openEdit(data) { this.edit = Object.assign({}, data); this.showEdit = true; },
        closeEdit() { this.showEdit = false; },
        closeCreate() { this.showCreate = false; },
        initAddButton() {
            // Hook the Datatable header add button to open the create modal
            const table = document.getElementById('return-reasons');
            if (!table) return;
            const card = table.closest('.card');
            const addBtn = card?.querySelector('.card-header .btn');
            if (addBtn) {
                addBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.showCreate = true;
                });
            }

            // Delegated handler for edit buttons to survive DataTables redraws
            document.addEventListener('click', (e) => {
                const btn = e.target.closest('.js-edit-reason');
                if (!btn) return;
                e.preventDefault();
                const data = {
                    id: parseInt(btn.dataset.id, 10),
                    name: btn.dataset.name,
                    active: btn.dataset.active === '1' || btn.dataset.active === 'true',
                    sort_order: parseInt(btn.dataset.sortOrder || btn.dataset.sortOrder || btn.getAttribute('data-sort-order') || '0', 10)
                };
                this.openEdit(data);
            });
        }
    }
}
</script>

@endsection
