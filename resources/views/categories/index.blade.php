<x-app-layout>
    <div class="max-w-6xl mx-auto p-6"
         x-data="{ view: localStorage.getItem('indexView') || 'list' }"
         x-init="$watch('view', v => localStorage.setItem('indexView', v))">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">
                History & Diplomatic Studies Repository
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

        {{-- Search Bar --}}
        <form action="{{ route('items.search') }}" class="mb-8 flex gap-2">
            <input name="q"
                   class="border border-gray-300 rounded px-3 py-2 w-full focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Search by title, keyword, or course code..." />
            <button class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                Search
            </button>
        </form>

        {{-- LIST VIEW --}}
        <div x-show="view === 'list'" x-cloak>
            @foreach($roots as $root)
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $root->name }}</h2>
                    <ul class="mt-2 space-y-1">
                        @foreach($root->children as $c1)
                            <li>
                                <a href="{{ route('categories.show', $c1->slug) }}"
                                   class="text-blue-700 underline hover:text-blue-900">
                                    {{ $c1->name }}
                                </a>

                                @if($c1->children->count())
                                    <ul class="ml-5 list-disc text-gray-700">
                                        @foreach($c1->children as $c2)
                                            <li>
                                                <a href="{{ route('categories.show', $c2->slug) }}"
                                                   class="underline hover:text-blue-700">
                                                    {{ $c2->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        {{-- GRID VIEW --}}
        @php
            $categories = [
                'final-year-projects' => \App\Models\Category::where('name', 'like', '%Final Year%')->first(),
                'term-papers-seminars' => \App\Models\Category::where('name', 'like', '%Term%')
                    ->orWhere('name', 'like', '%Seminar%')->first(),
                'audio-video' => \App\Models\Category::where('name', 'like', '%Audio%')
                    ->orWhere('name', 'like', '%Video%')->first(),
                'transcripts-pdfs' => \App\Models\Category::where('name', 'like', '%Transcript%')->first(),
                'articles-journals' => \App\Models\Category::where('name', 'like', '%Article%')
                    ->orWhere('name', 'like', '%Journal%')->first(),
                'conference-papers' => \App\Models\Category::where('name', 'like', '%Conference%')->first(),
                'photo-gallery' => \App\Models\Category::where('name', 'like', '%Photo%')->first(),
                'event-programs' => \App\Models\Category::where('name', 'like', '%Event%')->first(),
                'speeches-announcements' => \App\Models\Category::where('name', 'like', '%Speech%')
                    ->orWhere('name', 'like', '%Announcement%')->first(),
            ];
        @endphp

        <div x-show="view === 'grid'" x-cloak class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">

            {{-- Card 1 --}}
            <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Student Research Works</h2>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>
                        @if($categories['final-year-projects'])
                            <a href="{{ route('categories.show', $categories['final-year-projects']->slug) }}"
                               class="underline hover:text-blue-700">
                                Final Year Projects
                            </a>
                        @else
                            <span class="text-gray-400">Final Year Projects (missing)</span>
                        @endif
                    </li>
                    <li>
                        @if($categories['term-papers-seminars'])
                            <a href="{{ route('categories.show', $categories['term-papers-seminars']->slug) }}"
                               class="underline hover:text-blue-700">
                                Term Papers & Seminar Papers
                            </a>
                        @else
                            <span class="text-gray-400">Term Papers & Seminar Papers (missing)</span>
                        @endif
                    </li>
                </ul>
            </div>

            {{-- Card 2 --}}
            <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Oral Histories & Fieldwork</h2>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>
                        @if($categories['audio-video'])
                            <a href="{{ route('categories.show', $categories['audio-video']->slug) }}"
                               class="underline hover:text-blue-700">
                                Audio / Video
                            </a>
                        @else
                            <span class="text-gray-400">Audio / Video (missing)</span>
                        @endif
                    </li>
                    <li>
                        @if($categories['transcripts-pdfs'])
                            <a href="{{ route('categories.show', $categories['transcripts-pdfs']->slug) }}"
                               class="underline hover:text-blue-700">
                                Transcripts (PDFs)
                            </a>
                        @else
                            <span class="text-gray-400">Transcripts (missing)</span>
                        @endif
                    </li>
                </ul>
            </div>

            {{-- Card 3 --}}
            <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Faculty & Departmental Publications</h2>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>
                        @if($categories['articles-journals'])
                            <a href="{{ route('categories.show', $categories['articles-journals']->slug) }}"
                               class="underline hover:text-blue-700">
                                Articles & Journals
                            </a>
                        @else
                            <span class="text-gray-400">Articles & Journals (missing)</span>
                        @endif
                    </li>
                    <li>
                        @if($categories['conference-papers'])
                            <a href="{{ route('categories.show', $categories['conference-papers']->slug) }}"
                               class="underline hover:text-blue-700">
                                Conference Papers
                            </a>
                        @else
                            <span class="text-gray-400">Conference Papers (missing)</span>
                        @endif
                    </li>
                </ul>
            </div>

            {{-- Card 4 --}}
            <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Departmental Records & Memory</h2>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>
                        @if($categories['photo-gallery'])
                            <a href="{{ route('categories.show', $categories['photo-gallery']->slug) }}"
                               class="underline hover:text-blue-700">
                                Photo Gallery
                            </a>
                        @else
                            <span class="text-gray-400">Photo Gallery (missing)</span>
                        @endif
                    </li>
                    <li>
                        @if($categories['event-programs'])
                            <a href="{{ route('categories.show', $categories['event-programs']->slug) }}"
                               class="underline hover:text-blue-700">
                                Event Programs
                            </a>
                        @else
                            <span class="text-gray-400">Event Programs (missing)</span>
                        @endif
                    </li>
                    <li>
                        @if($categories['speeches-announcements'])
                            <a href="{{ route('categories.show', $categories['speeches-announcements']->slug) }}"
                               class="underline hover:text-blue-700">
                                Speeches & Announcements
                            </a>
                        @else
                            <span class="text-gray-400">Speeches & Announcements (missing)</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
