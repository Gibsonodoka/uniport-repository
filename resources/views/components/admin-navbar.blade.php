<nav class="bg-white shadow px-6 py-3 flex justify-between items-center border-b border-gray-200">
    <!-- Left Section -->
    <div class="flex items-center gap-2">
        <h1 class="text-xl font-semibold text-blue-700">Admin Dashboard</h1>
    </div>

    <!-- Right Section -->
    <div class="flex items-center gap-5">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-gray-700 text-sm font-medium">{{ Auth::user()->name ?? 'Admin' }}</span>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 text-sm font-medium px-3 py-1 rounded-md transition">
                Logout
            </button>
        </form>
    </div>
</nav>
