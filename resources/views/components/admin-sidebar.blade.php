<aside class="w-64 bg-blue-900 text-white flex flex-col justify-between min-h-screen">
    <!-- Top Section -->
    <div>
        <div class="p-6 border-b border-blue-800 text-center">
            <h2 class="text-2xl font-bold tracking-wide">UNIPORT</h2>
            <p class="text-xs text-blue-200 mt-1">Faculty Repository Admin</p>
        </div>

        <nav class="mt-6">
            <ul class="space-y-1">
                {{-- Dashboard --}}
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-2 px-6 py-2 text-sm font-medium rounded-md transition
                              {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white text-blue-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m4 0h2a2 2 0 002-2V10a2 2 0 00-.586-1.414l-7-7a2 2 0 00-2.828 0l-7 7A2 2 0 002 10v10a2 2 0 002 2h2" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                {{-- Submissions --}}
                <li>
                    <a href="{{ route('admin.submissions') }}"
                       class="flex items-center gap-2 px-6 py-2 text-sm font-medium rounded-md transition
                              {{ request()->routeIs('admin.submissions') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white text-blue-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M7 8h10M7 12h8m-8 4h6M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Submissions
                    </a>
                </li>

                {{-- ✅ Create Submission --}}
                <li>
                    <a href="{{ route('admin.items.create') }}"
                       class="flex items-center gap-2 px-6 py-2 text-sm font-medium rounded-md transition
                              {{ request()->routeIs('admin.items.create') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white text-blue-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4v16m8-8H4" />
                        </svg>
                        Create Submission
                    </a>
                </li>

                {{-- Categories --}}
                <li>
                    <a href="{{ route('admin.categories') }}"
                       class="flex items-center gap-2 px-6 py-2 text-sm font-medium rounded-md transition
                              {{ request()->routeIs('admin.categories') ? 'bg-blue-800 text-white' : 'hover:bg-blue-800 hover:text-white text-blue-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        Categories
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Footer Section -->
    <div class="p-4 text-center border-t border-blue-800 text-xs text-blue-300">
        © {{ date('Y') }} UNIPORT Repository<br>
        <span class="text-blue-200">Admin Portal</span>
    </div>
</aside>
