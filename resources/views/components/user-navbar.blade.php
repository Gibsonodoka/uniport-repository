<nav class="bg-white shadow px-6 py-3 flex justify-between items-center">
    <h1 class="text-lg font-semibold text-blue-700">User Dashboard</h1>

    <div class="flex items-center gap-4">
        <span class="text-gray-600 text-sm">{{ Auth::user()->name }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="text-red-600 text-sm hover:text-red-800 font-medium transition">
                Logout
            </button>
        </form>
    </div>
</nav>
