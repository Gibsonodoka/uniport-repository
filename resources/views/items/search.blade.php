<x-app-layout>
    <div class="max-w-6xl mx-auto p-6"
         x-data="{ view: localStorage.getItem('searchView') || 'grid' }"
         x-init="$watch('view', v => localStorage.setItem('searchView', v))">

        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">
                Search Results
            </h1>

            {{-- View Toggle --}}
            <div class="flex items-center gap-2">
                <button @click="view = 'list'"
                        :class="view === 'list' ? 'bg-blue-700 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-3 py-1.5 text-xs font-medium rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    List
                </button>

                <button @click="view = 'grid'"
                        :class="view === 'grid' ? 'bg-blue-700 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-3 py-1.5 text-xs font-medium rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h4v4H4V6zm6 0h4v4h-4V6zm6 0h4v4h-4V6zM4 12h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4zM4 18h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z"/>
                    </svg>
                    Grid
                </button>
            </div>
        </div>

        {{-- Search Form --}}
        <form action="{{ route('items.search') }}" method="GET" class="mb-6 flex gap-2">
            <input 
                type="text" 
                name="q" 
                value="{{ request('q') }}" 
                class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500" 
                placeholder="Search by title, keyword, or course code..." 
            />
            <button class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                Search
            </button>
        </form>

        @if($items->count())
            {{-- GRID VIEW --}}
            <div x-show="view === 'grid'" x-cloak class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($items as $item)
                    <a href="{{ route('items.show', $item) }}" 
                       class="block border rounded-lg p-4 bg-white hover:shadow-md transition">
                        <h2 class="font-semibold text-gray-900 mb-1 text-lg">
                            {{ Str::limit($item->title, 70) }}
                        </h2>
                        <p class="text-xs text-gray-500 mb-2">
                            {{ $item->year ?? 'N/A' }} · {{ Str::headline(str_replace('_',' ', $item->type)) }}
                        </p>
                        @if($item->course_code)
                            <p class="text-sm text-gray-600 mb-2">
                                <span class="font-semibold">Course:</span> {{ $item->course_code }}
                            </p>
                        @endif
                        <p class="text-sm text-gray-700 leading-snug">
                            {{ Str::limit($item->abstract, 120) }}
                        </p>
                        @if($item->category)
                            <p class="text-xs text-gray-500 mt-3">
                                In: {{ $item->category->name }}
                            </p>
                        @endif
                    </a>
                @endforeach
            </div>

            {{-- LIST VIEW --}}
            <div x-show="view === 'list'" x-cloak class="space-y-4">
                @foreach($items as $item)
                    <a href="{{ route('items.show', $item) }}" 
                       class="block border rounded-lg p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                            <div>
                                <h2 class="font-semibold text-lg text-gray-800">{{ $item->title }}</h2>
                                <div class="text-sm text-gray-600 mb-1">
                                    {{ $item->year ?? 'N/A' }} · {{ Str::headline(str_replace('_',' ', $item->type)) }}
                                </div>
                                @if($item->course_code)
                                    <div class="text-sm text-gray-600">
                                        Course: {{ $item->course_code }}
                                    </div>
                                @endif
                            </div>
                            <div class="text-right md:w-1/3">
                                <p class="text-sm text-gray-700 leading-snug mb-1">
                                    {{ Str::limit($item->abstract, 140) }}
                                </p>
                                @if($item->category)
                                    <div class="text-xs text-gray-500">
                                        In: {{ $item->category->name }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $items->links() }}
            </div>
        @else
            <div class="text-gray-600 mt-12 text-center">
                <p class="mb-2">No results found for “{{ request('q') }}”.</p>
                <a href="{{ route('home') }}" class="text-blue-700 underline hover:text-blue-900">
                    Back to collections
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
