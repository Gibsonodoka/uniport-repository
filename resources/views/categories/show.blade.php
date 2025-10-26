<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <nav class="text-sm mb-2">
            <a href="{{ route('home') }}" class="underline">Collections</a>
            @if($category->parent) › <a class="underline" href="{{ route('categories.show',$category->parent->slug) }}">{{ $category->parent->name }}</a>@endif
            › <span class="font-semibold">{{ $category->name }}</span>
        </nav>

        <h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>

        @if($category->children->count())
            <div class="grid sm:grid-cols-2 gap-3 mb-6">
                @foreach($category->children as $child)
                    <a href="{{ route('categories.show',$child->slug) }}" class="border rounded p-4 hover:bg-gray-50">
                        <div class="font-semibold">{{ $child->name }}</div>
                        <div class="text-sm text-gray-600">{{ Str::limit($child->description, 100) }}</div>
                    </a>
                @endforeach
            </div>
        @endif

        <h2 class="text-lg font-semibold mb-2">Items</h2>
        <div class="space-y-3">
            @forelse($category->items as $item)
                <a href="{{ route('items.show',$item) }}" class="block border rounded p-4 hover:bg-gray-50">
                    <div class="font-semibold">{{ $item->title }}</div>
                    <div class="text-sm text-gray-600">{{ $item->year }} · {{ Str::headline(str_replace('_',' ',$item->type)) }} · {{ $item->course_code }}</div>
                    <div class="text-sm">{{ Str::limit($item->abstract, 160) }}</div>
                </a>
            @empty
                <p class="text-gray-600">No items yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
