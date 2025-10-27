<aside class="w-64 bg-blue-900 text-white flex-shrink-0">
    <div class="p-5 text-center border-b border-blue-700">
        <h2 class="font-bold text-xl">UNIPORT</h2>
        <p class="text-xs text-blue-200">Repository</p>
    </div>

    <nav class="mt-6">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('user.dashboard') }}"
                   class="block px-5 py-2 hover:bg-blue-800 rounded-md {{ request()->routeIs('user.dashboard') ? 'bg-blue-800' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('items.create') }}"
                   class="block px-5 py-2 hover:bg-blue-800 rounded-md {{ request()->routeIs('items.create') ? 'bg-blue-800' : '' }}">
                    Submit Work
                </a>
            </li>
            <li>
                <a href="{{ route('user.submissions') }}"
                   class="block px-5 py-2 hover:bg-blue-800 rounded-md {{ request()->routeIs('user.submissions') ? 'bg-blue-800' : '' }}">
                    My Submissions
                </a>
            </li>
        </ul>
    </nav>
</aside>
