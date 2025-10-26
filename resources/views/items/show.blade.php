<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <!-- Title -->
        <h1 class="text-2xl font-bold mb-2 text-gray-800">{{ $item->title }}</h1>

        <!-- Meta info -->
        <div class="text-sm text-gray-600 mb-4">
            {{ $item->year ?? 'N/A' }} · {{ Str::headline(str_replace('_', ' ', $item->type)) }}
            @if($item->course_code)
                · {{ $item->course_code }}
            @endif
            @if($item->category)
                · In 
                <a class="underline text-blue-700 hover:text-blue-900" href="{{ route('categories.show', $item->category->slug) }}">
                    {{ $item->category->name }}
                </a>
            @endif
        </div>

        <!-- Contributors -->
        @if($item->people->count())
            <div class="text-sm mb-5">
                <strong>Contributors:</strong>
                {{ $item->people->map(fn($p) => $p->name . ' (' . $p->pivot->role . ')')->join(', ') }}
            </div>
        @endif

        <!-- Abstract -->
        @if($item->abstract)
            <div class="mb-6 leading-relaxed text-gray-800">
                <h2 class="text-lg font-semibold mb-2">Abstract</h2>
                <p>{{ $item->abstract }}</p>
            </div>
        @endif

        <!-- Files Section -->
        <div class="mt-8">
            <h2 class="font-semibold text-lg mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a1 1 0 00-1 1v2H6a2 2 0 00-2 2v9a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2V3a1 1 0 00-1-1H9z" />
                </svg>
                Files
            </h2>

            @if($item->media->count())
                <ul class="space-y-2">
                    @foreach($item->media as $file)
                        <li class="flex items-center justify-between border rounded px-3 py-2 hover:bg-gray-50">
                            <div>
                                <a class="text-blue-700 underline hover:text-blue-900" href="{{ $file->url }}" target="_blank">
                                    {{ basename($file->path) }}
                                </a>
                                <span class="text-xs text-gray-500">({{ strtoupper($file->kind) }})</span>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ number_format(($file->size_bytes ?? 0)/1024, 1) }} KB
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 text-sm mt-2">No files have been uploaded for this item.</p>
            @endif
        </div>

        <!-- Back Link -->
        <div class="mt-8">
            <a href="{{ url()->previous() }}" class="text-blue-700 hover:text-blue-900 underline text-sm">← Back to Results</a>
        </div>
    </div>
</x-app-layout>
