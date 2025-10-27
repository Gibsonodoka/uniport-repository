<nav class="bg-white border-b border-gray-100 shadow-sm">
    <!-- Top Banner -->
    <div class="bg-blue-900 text-white text-sm text-center py-2">
        <span class="tracking-wide">📚 Explore academic works from the Faculty of History & Diplomatic Studies</span>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Left: Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/uniport.png') }}" alt="Logo" class="h-9 w-9 rounded-full object-cover">
                <span class="text-2xl font-bold text-gray-900">
                    <span class="text-blue-700">UNIPORT</span> Repository
                </span>
            </a>

            <!-- Center: Menu Links -->
            <div class="hidden md:flex items-center space-x-8 text-gray-700 font-medium">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-700 font-semibold' : 'hover:text-blue-700' }}">Home</a>
                <a href="{{ route('items.search') }}" class="{{ request()->routeIs('items.search') ? 'text-blue-700 font-semibold' : 'hover:text-blue-700' }}">Search</a>
                <a href="{{ route('categories.show', 'collections') }}" class="{{ request()->is('collections*') ? 'text-blue-700 font-semibold' : 'hover:text-blue-700' }}">Collections</a>
                <a href="#" class="hover:text-blue-700">About</a>
            </div>

            <!-- Right: Auth Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    @php
                        $dashboardRoute = Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard');
                    @endphp

                    <a href="{{ $dashboardRoute }}" class="text-blue-700 font-semibold hover:text-blue-900">
                        Hi, {{ Auth::user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm px-4 py-2 bg-red-100 text-red-600 rounded-full hover:bg-red-200 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-700 font-semibold hover:text-blue-900">Log In</a>
                    <a href="{{ route('items.create') }}" class="px-5 py-2 bg-blue-700 text-white rounded-full font-semibold hover:bg-blue-800 transition">
                        Submit Work
                    </a>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown -->
    <div id="mobile-menu" class="hidden bg-white border-t border-gray-100 md:hidden">
        <div class="px-6 py-4 space-y-2 text-gray-700 font-medium">
            <a href="{{ route('home') }}" class="block hover:text-blue-700">Home</a>
            <a href="{{ route('items.search') }}" class="block hover:text-blue-700">Search</a>
            <a href="{{ route('categories.show', 'collections') }}" class="block hover:text-blue-700">Collections</a>
            <a href="#" class="block hover:text-blue-700">About</a>

            <hr class="my-3 border-gray-200">

            @auth
                @php
                    $dashboardRoute = Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard');
                @endphp

                <a href="{{ $dashboardRoute }}" class="block text-blue-700 font-semibold hover:text-blue-900">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-center px-4 py-2 bg-red-100 text-red-600 rounded-full text-sm hover:bg-red-200 transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-blue-700 hover:text-blue-900">Log In</a>
                <a href="{{ route('items.create') }}" class="block mt-2 px-4 py-2 bg-blue-700 text-white rounded-full text-center hover:bg-blue-800 transition">
                    Submit Work
                </a>
            @endauth
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');
        toggleBtn.addEventListener('click', () => menu.classList.toggle('hidden'));
    </script>
</nav>
