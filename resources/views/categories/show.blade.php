<x-app-layout>
    <div class="max-w-6xl mx-auto p-6" x-data="{ view: localStorage.getItem('collectionView') || 'list' }" x-init="$watch('view', v => localStorage.setItem('collectionView', v))">
        {{-- Breadcrumb --}}
        <nav class="text-sm mb-3 text-gray-600">
            <a href="{{ route('home') }}" class="underline hover:text-blue-700">Collections</a>
            @if($category->parent)
                › <a href="{{ route('categories.show', $category->parent->slug) }}" class="underline hover:text-blue-700">{{ $category->parent->name }}</a>
            @endif
            › <span class="font-semibold text-gray-800">{{ $category->name }}</span>
        </nav>

        {{-- Title + View Toggle --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">{{ $category->name }}</h1>

            <div class="flex items-center gap-2">
                <button @click="view = 'list'"
                        :class="view === 'list' ? 'bg-blue-700 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-3 py-1.5 text-xs font-medium rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    List
                </button>

                <button @click="view = 'grid'"
                        :class="view === 'grid' ? 'bg-blue-700 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-3 py-1.5 text-xs font-medium rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h4v4H4V6zm6 0h4v4h-4V6zm6 0h4v4h-4V6zM4 12h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4zM4 18h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z"/>
                    </svg>
                    Grid
                </button>
            </div>
        </div>

        {{-- Subcategories --}}
        @if($category->children->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3 mb-8">
                @foreach($category->children as $child)
                    <a href="{{ route('categories.show', $child->slug) }}"
                       class="border rounded p-4 hover:bg-gray-50 transition">
                        <div class="font-semibold text-gray-900">{{ $child->name }}</div>
                        <div class="text-sm text-gray-600">{{ Str::limit($child->description, 100) }}</div>
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Items Section --}}
        <h2 class="text-lg font-semibold text-gray-800 mb-3">Items</h2>

        {{-- List View --}}
        <div x-show="view === 'list'" x-cloak class="space-y-3">
            @forelse($category->items as $item)
                <a href="{{ route('items.show', $item) }}"
                   class="block border rounded p-4 hover:bg-gray-50 transition">
                    <div class="font-semibold text-gray-900">{{ $item->title }}</div>
                    <div class="text-sm text-gray-600">
                        {{ $item->year }} · {{ Str::headline(str_replace('_', ' ', $item->type)) }} · {{ $item->course_code }}
                    </div>
                    <div class="text-sm text-gray-700">{{ Str::limit($item->abstract, 160) }}</div>
                </a>
            @empty
                <p class="text-gray-600">No items yet.</p>
            @endforelse
        </div>

        {{-- Grid View --}}
        <div x-show="view === 'grid'" x-cloak
             class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
            @forelse($category->items as $item)
                <a href="{{ route('items.show', $item) }}"
                   class="block border rounded-lg p-4 bg-white hover:shadow-md transition">
                    <h3 class="font-semibold text-gray-900 mb-1">
                        {{ Str::limit($item->title, 60) }}
                    </h3>
                    <p class="text-xs text-gray-500 mb-2">
                        {{ $item->year }} · {{ Str::headline(str_replace('_', ' ', $item->type)) }}
                    </p>
                    <p class="text-sm text-gray-700">{{ Str::limit($item->abstract, 120) }}</p>
                </a>
            @empty
                <p class="text-gray-600">No items yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
