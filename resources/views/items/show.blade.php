<x-app-layout>
    <div class="max-w-5xl mx-auto p-6"
         x-data="{
            filter: 'all',
            open: false,
            activeFile: null,
            openModal(file) { this.activeFile = file; this.open = true; },
            closeModal() { this.open = false; this.activeFile = null; }
         }">

        {{-- Title --}}
        <h1 class="text-2xl font-bold mb-2 text-gray-900">{{ $item->title }}</h1>

        {{-- Meta Info --}}
        <div class="text-sm text-gray-600 mb-4">
            {{ $item->year ?? 'N/A' }} · {{ Str::headline(str_replace('_', ' ', $item->type)) }}
            @if($item->course_code)
                · {{ $item->course_code }}
            @endif
            @if($item->category)
                · In
                <a class="underline text-blue-700 hover:text-blue-900"
                   href="{{ route('categories.show', $item->category->slug) }}">
                    {{ $item->category->name }}
                </a>
            @endif
        </div>

        {{-- Contributors --}}
        @if($item->people->count())
            <div class="text-sm mb-5">
                <strong>Contributors:</strong>
                {{ $item->people->map(fn($p) => $p->name . ' (' . $p->pivot->role . ')')->join(', ') }}
            </div>
        @endif

        {{-- Abstract --}}
        @if($item->abstract)
            <div class="mb-6 leading-relaxed text-gray-800">
                <h2 class="text-lg font-semibold mb-2">Abstract</h2>
                <p>{{ $item->abstract }}</p>
            </div>
        @endif

        {{-- Files Section --}}
        <div class="mt-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-3">
                <h2 class="font-semibold text-lg text-gray-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700"
                         viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 00-1 1v2H6a2 2 0 00-2 2v9a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2V3a1 1 0 00-1-1H9z" />
                    </svg>
                    Files
                </h2>

                {{-- Filter --}}
                <select x-model="filter"
                        class="border border-gray-300 rounded px-2 py-1 text-sm text-gray-700 focus:ring-blue-500 focus:border-blue-500">
                    <option value="all">All Types</option>
                    <option value="pdf">PDF</option>
                    <option value="audio">Audio</option>
                    <option value="video">Video</option>
                    <option value="image">Image</option>
                    <option value="other">Other</option>
                </select>
            </div>

            @if($item->media->count())
                <div class="space-y-3 mt-4">
                    @foreach($item->media as $file)
                        <template x-if="filter==='all' || filter==='{{ $file->kind }}'">
                            <div class="flex items-center justify-between border rounded px-3 py-3 bg-white hover:bg-gray-50 transition">
                                <div class="flex-1">
                                    {{-- File name hidden --}}
                                </div>

                                <div class="text-right">
                                    @auth
                                        <a href="{{ asset('storage/' . $file->path) }}"
                                           target="_blank"
                                           class="bg-blue-700 hover:bg-blue-800 text-white text-xs font-medium px-3 py-1.5 rounded transition">
                                           Open File
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">
                                            <a href="{{ route('login') }}" class="underline text-blue-700 hover:text-blue-900">
                                                Login
                                            </a>
                                            to view
                                        </span>
                                    @endauth
                                </div>
                            </div>
                        </template>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-sm mt-2">No files uploaded for this item.</p>
            @endif
        </div>

        {{-- PDF Reader Modal (desktop only) --}}
        <div x-show="open && window.innerWidth >= 768"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
             @keydown.escape.window="closeModal()">
            <div class="bg-white w-full max-w-4xl rounded-lg shadow-xl overflow-hidden">
                <div class="flex justify-between items-center border-b px-4 py-3 bg-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Document Reader</h3>
                    <button @click="closeModal" class="text-gray-600 hover:text-gray-900">
                        ✕
                    </button>
                </div>

                <div class="p-4 bg-gray-50" x-show="activeFile">
                    <iframe :src="activeFile" class="w-full h-[75vh] border rounded" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        {{-- Back Link --}}
        <div class="mt-8">
            <a href="{{ url()->previous() }}"
               class="text-blue-700 hover:text-blue-900 underline text-sm">
               ← Back to Results
            </a>
        </div>
    </div>
</x-app-layout>
