<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Search Results</h1>

        <!-- Search Form -->
        <form action="{{ route('items.search') }}" method="GET" class="mb-6 flex gap-2">
            <input 
                type="text" 
                name="q" 
                value="{{ request('q') }}" 
                class="border rounded px-3 py-2 w-full" 
                placeholder="Search by title, keyword, or course code..." 
            />
            <button class="bg-gray-900 text-white px-4 py-2 rounded">Search</button>
        </form>

        @if($items->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($items as $item)
                    <a href="{{ route('items.show', $item) }}" class="block border rounded-lg p-4 hover:bg-gray-50">
                        <div class="font-semibold text-lg text-gray-800">
                            {{ $item->title }}
                        </div>
                        <div class="text-sm text-gray-600 mb-1">
                            {{ $item->year ?? 'N/A' }} · {{ Str::headline(str_replace('_',' ', $item->type)) }}
                        </div>
                        @if($item->course_code)
                            <div class="text-sm text-gray-600 mb-2">
                                Course: {{ $item->course_code }}
                            </div>
                        @endif
                        <p class="text-sm text-gray-700 leading-snug">
                            {{ Str::limit($item->abstract, 120) }}
                        </p>
                        @if($item->category)
                            <div class="text-xs text-gray-500 mt-2">
                                In: {{ $item->category->name }}
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $items->links() }}
            </div>
        @else
            <div class="text-gray-600 mt-8 text-center">
                <p>No results found for “{{ request('q') }}”.</p>
                <a href="{{ route('home') }}" class="text-blue-600 underline">Back to collections</a>
            </div>
        @endif
    </div>
</x-app-layout>
