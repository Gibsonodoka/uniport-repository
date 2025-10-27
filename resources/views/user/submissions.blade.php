<x-user-layout>
    <main class="p-6 space-y-6 bg-gray-50 min-h-screen">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">My Submissions</h1>
        </div>

        {{-- Submissions Table --}}
        <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-blue-900 text-white text-xs uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold">Title</th>
                        <th class="px-5 py-3 text-left font-semibold">Year</th>
                        <th class="px-5 py-3 text-left font-semibold">Status</th>
                        <th class="px-5 py-3 text-left font-semibold">Date Submitted</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($items as $item)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-900">
                                <a href="{{ route('items.show', $item->id) }}" target="_blank" class="hover:underline">
                                    {{ Str::limit($item->title, 40) }}
                                </a>
                            </td>
                            <td class="px-5 py-3">{{ $item->year ?? '—' }}</td>
                            <td class="px-5 py-3">
                                @if($item->status === 'approved')
                                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-medium">
                                        Approved
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full text-xs font-medium">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3">{{ $item->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-6 text-center text-gray-500">
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
</x-user-layout>
