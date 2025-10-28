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
                <div class="space-y-2 mt-4">
                    @foreach($item->media as $file)
                        <template x-if="filter==='all' || filter==='{{ $file->kind }}'">
                            <div class="flex items-center justify-between border rounded px-3 py-2 bg-white hover:bg-gray-50 transition">
                                <div>
                                    <p class="font-medium text-gray-800 text-sm">{{ basename($file->path) }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ strtoupper($file->kind) }} · {{ number_format(($file->size_bytes ?? 0)/1024,1) }} KB
                                    </p>
                                </div>

                                <div class="text-right">
                                    @auth
                                        @if($file->kind === 'pdf')
                                            <button @click="openModal('{{ asset('storage/' . $file->path) }}')"
                                                    class="text-blue-700 hover:text-blue-900 underline text-xs">
                                                Read
                                            </button>
                                        @else
                                            <a href="{{ asset('storage/' . $file->path) }}" target="_blank"
                                               class="text-blue-700 hover:text-blue-900 underline text-xs">
                                                View / Download
                                            </a>
                                        @endif
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

        {{-- PDF Reader Modal --}}
        <div x-show="open"
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
