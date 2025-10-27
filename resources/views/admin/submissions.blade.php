<x-admin-layout>
    <main class="p-6 space-y-6 bg-gray-50 min-h-screen">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">All Submissions</h1>

            {{-- Search Bar --}}
            <form method="GET" action="{{ route('admin.submissions') }}" class="flex items-center space-x-2">
                <input type="text" 
                       name="q" 
                       placeholder="Search title, course..."
                       value="{{ request('q') }}"
                       class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-blue-500 focus:border-blue-500">
                <button type="submit"
                        class="bg-blue-700 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-blue-800 transition">
                    Search
                </button>
            </form>
        </div>

        {{-- Submissions Table --}}
        <div class="overflow-x-auto bg-white shadow-sm rounded-lg border border-gray-100">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-blue-900 text-white uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Title</th>
                        <th class="px-6 py-3 font-semibold">Type</th>
                        <th class="px-6 py-3 font-semibold">Course Code</th>
                        <th class="px-6 py-3 font-semibold">Supervisor</th>
                        <th class="px-6 py-3 font-semibold">Submitted By</th>
                        <th class="px-6 py-3 text-center font-semibold">Status</th>
                        <th class="px-6 py-3 text-right font-semibold">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($items as $item)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-3 font-medium text-gray-900">
                                <a href="{{ route('items.show', $item->id) }}" target="_blank" class="hover:underline">
                                    {{ Str::limit($item->title, 40) }}
                                </a>
                            </td>
                            <td class="px-6 py-3 capitalize">{{ str_replace('_', ' ', $item->type) }}</td>
                            <td class="px-6 py-3">{{ $item->course_code ?? '—' }}</td>
                            <td class="px-6 py-3">{{ $item->supervisor ?? '—' }}</td>
                            <td class="px-6 py-3">
                                {{ $item->user?->name ?? 'System' }}
                                <div class="text-xs text-gray-400">
                                    {{ $item->user?->email ?? '' }}
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                @if ($item->status === 'approved')
                                    <span class="inline-block bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-medium">
                                        Approved
                                    </span>
                                @else
                                    <span class="inline-block bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full text-xs font-medium">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-right">
                                @if ($item->status === 'pending')
                                    <form method="POST" action="{{ route('admin.approve', $item->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="bg-green-600 text-white text-xs px-3 py-1.5 rounded-md hover:bg-green-700 transition">
                                            Approve
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 italic">No Action</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-400 text-sm">
                                No submissions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($items, 'links'))
            <div class="mt-6">
                {{ $items->links() }}
            </div>
        @endif

    </main>
</x-admin-layout>
