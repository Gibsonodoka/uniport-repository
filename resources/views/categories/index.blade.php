<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">History & Diplomatic Studies Repository</h1>

        <form action="{{ route('items.search') }}" class="mb-6 flex gap-2">
            <input name="q" class="border rounded px-3 py-2 w-full" placeholder="Search by title, keyword, course code..." />
            <button class="bg-gray-900 text-white px-4 rounded">Search</button>
        </form>

        @foreach($roots as $root)
            <div class="mb-8">
                <h2 class="text-xl font-semibold">{{ $root->name }}</h2>
                <ul class="mt-2 space-y-1">
                    @foreach($root->children as $c1)
                        <li>
                            <a class="text-blue-700 underline" href="{{ route('categories.show',$c1->slug) }}">{{ $c1->name }}</a>
                            @if($c1->children->count())
                                <ul class="ml-5 list-disc">
                                    @foreach($c1->children as $c2)
                                        <li><a class="underline" href="{{ route('categories.show',$c2->slug) }}">{{ $c2->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</x-app-layout>
