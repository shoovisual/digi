<header class="sticky top-0 bg-white border-b border-gray-200 z-40 py-2">
    <div class="max-w-7xl mx-auto px-4 py-2 flex items-center gap-4">

        <!-- Search -->
        <div class="flex justify-end w-full items-center">
            <!-- Topbar actions -->
            <div class="flex items-center gap-2">
                 <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex text-left items-center space-x-4 text-gray-700 hover:text-gray-900 focus:outline-none">
                        <div class="h-9 w-9 rounded-full bg-digi-orange text-white flex items-center justify-center text-sm font-semibold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <i class="bi bi-chevron-down text-md"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="bi bi-person mr-2"></i>
                            Profile
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="bi bi-gear mr-2"></i>
                            Settings
                        </a>
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="bi bi-box-arrow-right mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
